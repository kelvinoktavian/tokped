<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Product, ProductImage};
use App\Http\Requests\StoreProductImageRequest;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $product = Product::select(
            'id',
            'slug',
        )->firstWhere('slug', $slug);

        if ($product == NULL) {
            return redirect()
                ->route('product.index')
                ->with('error', 'Data not found!');
        }

        return view('admin.product_image.index', [
            'title' => $product->name . ' Images',
            'product' => $product,
            'product_images' => $product->product_images
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $product = Product::firstWhere('slug', $slug);

        if ($product == NULL) {
            return redirect()
                ->route('product.index')
                ->with('error', 'Data not found!');
        }

        $product_images = $product->product_images;

        if ($product_images->count() == 5) {
            return back()->with('error', 'Maximum number of images!');
        }

        return view('admin.product_image.create', [
            'title' => 'Add Images',
            'product' => $product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductImageRequest $request)
    {
        $fileNameToStore = Parent::storeImage($request, 'product', 1000, 1000);

        ProductImage::create(
            [
                'product_id' => $request->input('product_id'),
                'image_path' => $fileNameToStore
            ]
        );

        return redirect('admin/product/' . $request->input('product_slug') . '/images')
            ->with('success', 'Images has been added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $product_image = ProductImage::firstWhere('id', $id);

        if ($product_image == NULL) {
            return redirect()
                ->route('product.index')
                ->with('error', 'Data not found!');
        }

        unlink('images/product/' . $product_image->image_path);

        $product_image->delete();

        return redirect('admin/product/' . $request->input('product_slug') . '/images')
            ->with('success', 'Image has been deleted successfully');
    }
}
