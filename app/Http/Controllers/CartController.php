<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Product};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Cart::with(['product'])
            ->where('user_id', auth()->user()->id);

        $carts = $query
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('cart.index', [
            'title' => 'Shopping Cart',
            'carts' => $carts,
            'subtotal' => $query->sum('total_price'),
            'total_item' => $carts->sum('qty'),
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

        $carts = Cart::where('user_id', $user->id)
            ->pluck('product_id')
            ->toArray();

        $slug = $request->input('slug');
        $product = Product::firstWhere('slug', $slug);

        if ($product->qty == 0) {
            return back()->with('error', 'Product is out of stock!');
        }

        if (in_array($product->id, $carts)) {
            // kalo product sudah ditambahkan ke dalam cart
            $cart = Cart::where('product_id', $product->id)
                ->where('user_id', $user->id);

            $check_cart = $cart->first();

            if ($check_cart->qty === $product->qty) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', 'Maximum total product!');
            } else {
                $cart->update(
                    [
                        'qty' => DB::raw('qty + 1'),
                    ]
                );
            }
        } else {
            Cart::create(
                [
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'qty' => 1,
                ]
            );
        }

        $price = $product->price;

        $cart = Cart::where('product_id', $product->id)
            ->where('user_id', $user->id)
            ->update(
                [
                    'total_price' => DB::raw("qty * '$price'"),
                ]
            );

        return back()
            ->with('success', 'Product has been added to cart!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::firstWhere('id', $id);

        $cart->update([
            'qty' => $request->qty,
            'total_price' => $request->total_price
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($cart == NULL) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Data not found!');
        } else {
            $cart->delete();
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Cart has been deleted successfully');
    }

    public function clear()
    {
        $carts = auth()
            ->user()
            ->carts()
            ->delete();

        return redirect()
            ->route('cart.index')
            ->with('success', 'Cart has been cleared successfully');
    }

    public function checkout()
    {
        $user = auth()->user();
        $carts = $user->carts;
        $total_item = $carts->sum('qty');

        // kalo has_address = 0, user belom pernah isi address
        if ($user->has_address == 0) {
            return redirect()
                ->route('address.create')
                ->with('error', 'Please complete your address before checkout');
        } elseif ($user->phone == NULL) {
            return redirect()
                ->route('profile.index')
                ->with('error', 'Please input your phone number before checkout');
        } elseif ($total_item == 0) {
            return back()
                ->with('error', 'Your cart is empty!');
        } else {
            return view('checkout.index', [
                'title' => 'Checkout',

                'user' => $user,
                'subtotal' => $carts->sum('total_price'),
                'carts' => $carts
            ]);
        }
    }
}
