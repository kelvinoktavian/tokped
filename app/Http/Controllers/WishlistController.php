<?php

namespace App\Http\Controllers;

use App\Models\{Product, Wishlist};
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $wishlists_check = Wishlist::where('user_id', auth()->user()->id)->get();

        if (count($wishlists_check) == 0) {
            return back();
        }

        return view('wishlist.index', [
            'title' => 'Wishlist',
            'wishlists' => auth()
                ->user()
                ->wishlists()['default'][0],
            'check_wishlist' => Wishlist::where('user_id', auth()->user()->id)
                ->pluck('model_id')
                ->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $product = Product::firstWhere('slug', $request->input('slug'));

        $user->wish($product);

        return back()->with('success', $product->name . ' has been added to wishlist!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = auth()->user();
        $product = Product::firstWhere('slug', $request->input('slug'));

        $user->unwish($product);

        $wishlists = Wishlist::where('user_id', auth()->user()->id)->get();

        if (count($wishlists) == 0) {
            return redirect()
                ->route('product')
                ->with('success', $product->name . ' has been removed from wishlist!');
        }

        return back()
            ->with('success', $product->name . ' has been removed from wishlist!');
    }

    public function clear()
    {
        Wishlist::where('user_id', auth()->user()->id)->delete();

        return redirect()
            ->route('product')
            ->with('success', 'Wishlist has been cleared successfully');
    }
}
