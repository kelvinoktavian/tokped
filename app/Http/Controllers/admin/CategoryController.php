<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::select(
            'id',
            'slug',
            'name'
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

        return view('admin.category.index', [
            'title' => 'Categories',
            'categories' => $categories
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
        return view('admin.category.create', [
            'title' => 'Add Category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create(
            [
                'slug' => Str::slug($request->input('name')),
                'name' => $request->input('name'),
            ]
        );

        return redirect()
            ->route('category.index')
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
        $category = Category::select(
            'id',
            'slug',
            'name'
        )->firstWhere('slug', $slug);

        if ($category == NULL) {
            return redirect()
                ->route('category.index')
                ->with('error', 'Data not found!');
        }

        $data = [
            'title' => 'Edit Category',
            'category' => $category
        ];

        return view('admin.category.edit', $data);
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
        $category = Category::firstWhere('slug', $slug);

        if ($category == NULL) {
            return redirect()
                ->route('category.index')
                ->with('error', 'Data not found!');
        }

        if ($category->name == $request->name) {
            $rule_name = 'required';
        } else {
            $rule_name = 'required|unique:categories';
        }

        $this->validate($request, [
            'name' => $rule_name
        ]);

        // Update data
        $category->update(
            [
                'slug' => Str::slug($request->input('name')),
                'name' => $request->input('name'),
            ]
        );

        return redirect()
            ->route('category.index')
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
        $category = Category::firstWhere('slug', $slug);

        if ($category == NULL) {
            return redirect()
                ->route('category.index')
                ->with('error', 'Data not found!');
        } else {
            $category->delete();
        }

        return redirect()
            ->route('category.index')
            ->with('success', 'Data has been deleted successfully');
    }
}
