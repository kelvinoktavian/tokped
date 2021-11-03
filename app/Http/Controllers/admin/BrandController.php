<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = Brand::select(
            'id',
            'slug',
            'name',
            'image_path'
        )->where([
            ['name', '!=', NULL],
            [function ($query) use ($request) {
                if ($search = $request->search) {
                    $query
                        ->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->get();
                }
            }]
        ])
            ->orderBy('created_at', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('admin.brand.index', [
            'title' => 'Brands',
            'brands' => $brands
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
        return view('admin.brand.create', [
            'title' => 'Add Brand',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        if ($request->hasFile('image_path')) {
            $fileNameToStore = Parent::storeImage($request, 'brand', 100, 100);
        }
        // Kalo user ga upload file
        else {
            $fileNameToStore = 'default.png';
        }

        // If valid
        Brand::create(
            [
                'slug' => Str::slug($request->input('name')),
                'name' => $request->input('name'),
                'image_path' => $fileNameToStore,
            ]
        );

        return redirect()
            ->route('brand.index')
            ->with('success', 'Data has been added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $brand = Brand::select(
            'id',
            'slug',
            'name',
            'image_path'
        )->firstWhere('slug', $slug);

        if ($brand == NULL) {
            return redirect()
                ->route('brand.index')
                ->with('error', 'Data not found!');
        }

        return view('admin.brand.edit', [
            'title' => 'Edit Brand',
            'brand' => $brand
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
        $brand = Brand::firstWhere('slug', $slug);

        if ($brand == NULL) {
            return redirect()
                ->route('brand.index')
                ->with('error', 'Data not found!');
        }

        if ($brand->name == $request->name) {
            $rule_name = 'required';
        } else {
            $rule_name = 'required|unique:brands';
        }

        $this->validate($request, [
            'name' => $rule_name,
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $fileNameToStore = Parent::storeImage($request, 'brand', 100, 100);

            // Delete old image
            if ($brand->image_path != 'default.png') {
                unlink('images/brand/' . $brand->image_path);
            }

            // Update data
            $brand->update(
                [
                    'slug' => Str::slug($request->input('name')),
                    'name' => $request->input('name'),
                    'image_path' => $fileNameToStore,
                ]
            );
        } else {
            // Update data
            $brand->update(
                [
                    'slug' => Str::slug($request->input('name')),
                    'name' => $request->input('name'),
                ]
            );
        }

        return redirect()
            ->route('brand.index')
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
        $brand = Brand::firstWhere('slug', $slug);

        if ($brand == NULL) {
            return redirect()
                ->route('brand.index')
                ->with('error', 'Data not found!');
        } else {
            if ($brand->image_path != 'default.png') {
                unlink('images/brand/' . $brand->image_path);
            }

            $brand->delete();
        }

        return redirect()
            ->route('brand.index')
            ->with('success', 'Data has been deleted successfully');
    }
}
