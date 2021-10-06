<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Order, Product, OrderStatus};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::with(
            [
                'product', 'order_status', 'province', 'city'
            ]
        )
            ->where('user_id', auth()->user()->id)
            ->where(function ($query) use ($request) {
                return $request->status ?
                    $query
                    ->from('orders')
                    ->where('order_status_id', $request->status) : '';
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(10)
            ->withQueryString();

        $outstanding_payment = DB::table('orders')
            ->where('user_id', auth()->user()->id)
            ->where('order_status_id', 1)
            ->sum('total_price');

        return view('order.index', [
            'orders' => $orders,
            'outstanding_payment' => $outstanding_payment,
            'order_statuses' => OrderStatus::all(),
            'check_orders' => auth()->user()->orders,
            'title' => 'Orders'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $user = auth()->user();

        $carts = $user->carts()
            ->orderBy('created_at', 'ASC')
            ->get();

        foreach ($carts as $cart) {
            $orders[] = [
                'user_id' => $user->id,
                'product_id' => $cart->product_id,
                'order_status_id' => 1,
                'province_id' => $user->address->province_id,
                'city_id' => $user->address->city_id,
                'qty' => $cart->qty,
                'total_price' => $cart->total_price,
                'street_name' => $user->address->street_name,
                'postal_code' => $user->address->postal_code,
                'created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')
            ];
        }

        Order::insert($orders);

        // decrement product stock
        foreach ($carts as $cart) {
            $product = Product::where('id', $cart->product_id)->first();

            $product->update(
                [
                    'qty' => DB::raw("qty - '$cart->qty'")
                ]
            );
        }

        // clear cart
        $carts = $user->carts()->delete();

        return redirect()
            ->route('user_order.index')
            ->with('success', 'Orders created successfully!');
    }
}
