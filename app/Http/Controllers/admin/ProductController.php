<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\{Product, Brand, Category};

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with([
            'brand', 'category'
        ])
            ->where([
                ['name', '!=', NULL],
                [function ($query) use ($request) {
                    if ($search = $request->search) {
                        $query
                            ->orWhere('name', 'LIKE', '%' . $search . '%')
                            ->get();
                    }
                }],
                [function ($query) use ($request) {
                    if ($brand = $request->brand) {
                        $query
                            ->orWhere('brand_id', $brand)
                            ->get();
                    }
                }],
                [function ($query) use ($request) {
                    if ($category = $request->category) {
                        $query
                            ->orWhere('category_id', $category)
                            ->get();
                    }
                }]
            ]);

        // Filter sort by
        if ($request->sortBy == 'latest') {
            $products = $products->orderBy('created_at', 'DESC');
        } elseif ($request->sortBy == 'highestPrice') {
            $products = $products->orderBy('price', 'DESC');
        } elseif ($request->sortBy == 'lowestPrice') {
            $products = $products->orderBy('price', 'ASC');
        } elseif ($request->sortBy == 'bestSeller') {
            $products = $products->orderBy('sold', 'DESC');
        } elseif ($request->sortBy == 'highestStock') {
            $products = $products->orderBy('qty', 'DESC');
        } elseif ($request->sortBy == 'lowestStock') {
            $products = $products->orderBy('qty', 'ASC');
        } else {
            $products = $products->orderBy('name', 'ASC');
        }

        $products = $products
            ->paginate(10)
            ->withQueryString();

        return view('admin.product.index', [
            'title' => 'Products',
            'products' => $products,
            'brands' => Brand::all(),
            'categories' => Category::all()
        ])
            ->with('no', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', [
            'title' => 'Add Product',
            'brands' => Brand::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // Kalo user upload image
        if ($request->hasFile('image_path')) {
            $fileNameToStore = Parent::storeImage($request, 'product', 1000, 1000);
        }
        // Kalo user ga upload file
        else {
            $fileNameToStore = 'default.png';
        }

        // If valid
        Product::create(
            [
                'brand_id' => $request->input('brand_id'),
                'category_id' => $request->input('category_id'),
                'slug' => Str::slug($request->input('name')),
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'voltage' => $request->input('voltage'),
                'capacity' => $request->input('capacity'),
                'weight' => $request->input('weight'),
                'description' => $request->input('description'),
                'qty' => $request->input('qty'),
                'image_path' => $fileNameToStore,
            ]
        );

        return redirect()
            ->route('product.index')
            ->with('success', 'Data has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::firstWhere('slug', $slug);

        if ($product == NULL) {
            return redirect()
                ->route('product.index')
                ->with('error', 'Data not found!');
        }

        return view('admin.product.show', [
            'title' => $product->name,
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::firstWhere('slug', $slug);

        if ($product == NULL) {
            return redirect()
                ->route('product.index')
                ->with('error', 'Data not found!');
        }

        return view('admin.product.edit', [
            'title' => 'Edit Product',
            'product' => $product,
            'brands' => Brand::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $product = Product::firstWhere('slug', $slug);

        if ($product == NULL) {
            return redirect()
                ->route('product.index')
                ->with('error', 'Data not found!');
        }

        if ($product->name == $request->name) {
            $rule_name = 'required';
        } else {
            $rule_name = 'required|unique:products';
        }

        $this->validate($request, [
            'brand_id' => 'required',
            'category_id' => 'required',
            'name' => $rule_name,
            'price' => 'required|integer|min:1',
            'voltage' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'weight' => 'nullable|integer|min:1',
            'qty' => 'required|integer|min:1',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $fileNameToStore = Parent::storeImage($request, 'product', 1000, 1000);

            // Delete old image
            if ($product->image_path != 'default.png') {
                unlink('images/product/' . $product->image_path);
            }

            // Update data
            $product->update(
                [
                    'brand_id' => $request->input('brand_id'),
                    'category_id' => $request->input('category_id'),
                    'slug' => Str::slug($request->input('name')),
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'voltage' => $request->input('voltage'),
                    'capacity' => $request->input('capacity'),
                    'weight' => $request->input('weight'),
                    'description' => $request->input('description'),
                    'qty' => $request->input('qty'),
                    'image_path' => $fileNameToStore,
                ]
            );
        } else {
            // Update data
            $product->update(
                [
                    'brand_id' => $request->input('brand_id'),
                    'category_id' => $request->input('category_id'),
                    'slug' => Str::slug($request->input('name')),
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'voltage' => $request->input('voltage'),
                    'capacity' => $request->input('capacity'),
                    'weight' => $request->input('weight'),
                    'description' => $request->input('description'),
                    'qty' => $request->input('qty')
                ]
            );
        }

        return redirect()
            ->route('product.index')
            ->with('success', 'Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product = Product::firstWhere('slug', $slug);

        if ($product == NULL) {
            return redirect()
                ->route('product.index')
                ->with('error', 'Data not found!');
        } else {
            if ($product->image_path != 'default.png') {
                unlink('images/product/' . $product->image_path);
            }

            $product->delete();
        }

        return redirect()
            ->route('product.index')
            ->with('success', 'Data has been deleted successfully');
    }
}
