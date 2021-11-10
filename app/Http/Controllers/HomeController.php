<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\{Carousel, Review, Product, Category};
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index', [
            'title' => 'Home',
            'carousels' => Carousel::latest()->get([
                'title',
                'body',
                'image_path'
            ]),
            'products' => Product::with(['reviews'])
                ->orderBy('created_at', 'DESC')
                ->take(4)
                ->get()
        ]);
    }

    public function about()
    {
        return view('about', [
            'title' => 'About Us'
        ]);
    }

    public function product(Request $request)
    {
        $products = Product::with(['reviews'])
            ->where(function ($query) use ($request) {
                return $request->search ?
                    $query
                    ->from('products')
                    ->where('name', 'LIKE', '%' . $request->search . '%') : '';
            })
            ->where(function ($query) use ($request) {
                return $request->category ?
                    $query
                    ->from('products')
                    ->where('category_id', $request->category) : '';
            })
            ->where(function ($query) use ($request) {
                return $request->minPrice ?
                    $query
                    ->from('products')
                    ->where('price', '>=', $request->minPrice) : '';
            })
            ->where(function ($query) use ($request) {
                return $request->maxPrice ?
                    $query
                    ->from('products')
                    ->where('price', '<=', $request->maxPrice) : '';
            });

        // Filter sort by
        if ($request->sortBy == 'latest') {
            $products = $products->orderBy('created_at', 'DESC');
        } elseif ($request->sortBy == 'highestPrice') {
            $products = $products->orderBy('price', 'DESC');
        } elseif ($request->sortBy == 'lowestPrice') {
            $products = $products->orderBy('price', 'ASC');
        } elseif ($request->sortBy == 'bestSeller') {
            $products = $products->orderBy('sold', 'DESC');
        } else {
            $products = $products->orderBy('name', 'ASC');
        }

        $products = $products
            ->paginate(18)
            ->withQueryString();

        if (Auth::check()) {
            $check_wishlist = Wishlist::where('user_id', auth()->user()->id)
                ->pluck('model_id')
                ->toArray();
        } else {
            $check_wishlist = [];
        }

        return view('product.index', [
            'title' => 'Products',
            'categories' => Category::all(),
            'products' => $products,
            'check_wishlist' => $check_wishlist
        ]);
    }

    public function showProduct($slug)
    {
        $product = Product::with(['reviews'])
            ->where('slug', $slug)
            ->first();

        if ($product == NULL) {
            return redirect()
                ->route('product.index')
                ->with('error', 'Product not found!');
        }

        $reviews = Review::with(
            ['user', 'product']
        )
            ->where('product_id', $product->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $related_products = Product::inRandomOrder()
            ->where('id', '!=', $product->id)
            ->where('category_id', '=', $product->category_id)
            ->where('qty', '!=', 0)
            ->limit(4)
            ->get();

        if (Auth::check()) {
            $check_wishlist = Wishlist::where('user_id', auth()->user()->id)
                ->pluck('model_id')
                ->toArray();
        } else {
            $check_wishlist = [];
        }

        return view('product.show', [
            'title' => $product->name,
            'product' => $product,
            'product_images' => $product->product_images,
            'reviews' => $reviews,
            'related_products' => $related_products,
            'check_wishlist' => $check_wishlist
        ]);
    }
}
