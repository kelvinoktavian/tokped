<?php

namespace App\Http\Controllers\admin;

use App\Models\{Order, Product, OrderStatus};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = DB::table('orders as orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->join('cities', 'cities.id', '=', 'orders.city_id')
            ->join('provinces', 'provinces.id', '=', 'orders.province_id')
            ->join('order_statuses', 'order_statuses.id', '=', 'orders.order_status_id')
            ->select(
                'orders.id',
                'orders.created_at',
                'orders.qty',
                'orders.total_price',
                'orders.street_name',
                'orders.postal_code',
                'orders.order_status_id',

                'users.name as user_name',
                'users.username',

                'products.slug',
                'products.name as product_name',

                'cities.city_name',
                'cities.type',

                'provinces.province',

                'order_statuses.status as order_status',
            )
            ->where([
                ['user_id', '!=', NULL]
            ]);

        // Filter username
        if ($request->search != NULL) {
            $orders = $orders->where('users.username', 'LIKE', '%' . $request->search . '%');
        }

        // Filter product
        if ($request->product != NULL) {
            $orders = $orders->where('product_id', '=', $request->product);
        }

        // Filter status
        if ($request->status != NULL) {
            $orders = $orders->where('order_status_id', '=', $request->status);
        }

        // Filter tanggal
        if ($request->startDate != NULL && $request->endDate != NULL) {
            $orders = $orders->whereBetween('orders.created_at', [$request->startDate, $request->endDate]);
        }

        // Filter sort by
        if ($request->sortBy == 'latest') {
            $orders = $orders->orderBy('orders.created_at', 'DESC');
        } elseif ($request->sortBy == 'oldest') {
            $orders = $orders->orderBy('orders.created_at', 'ASC');
        } elseif ($request->sortBy == 'highestTotalPrice') {
            $orders = $orders->orderBy('total_price', 'DESC');
        } elseif ($request->sortBy == 'lowestTotalPrice') {
            $orders = $orders->orderBy('total_price', 'ASC');
        } elseif ($request->sortBy == 'highestQuantity') {
            $orders = $orders->orderBy('qty', 'DESC');
        } elseif ($request->sortBy == 'lowestQuantity') {
            $orders = $orders->orderBy('qty', 'ASC');
        } else {
            $orders = $orders->orderBy('orders.created_at', 'DESC');
        }

        $orders = $orders
            ->paginate(30)
            ->withQueryString();

        return view('admin.order.index', [
            'title' => 'Orders',
            'orders' => $orders,
            'products' => Product::all(),
            'order_statuses' => OrderStatus::all()
        ])
            ->with('no', ($request->input('page', 1) - 1) * 30);
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
        $order = Order::firstWhere('id', $id);

        if ($order == NULL) {
            return redirect()
                ->route('order.index')
                ->with('error', 'Data not found!');
        }

        $product = $order->product;

        // kalo order dicancel
        if ($request->order_status_id == 6) {
            // balikin stock  product ke awal
            $product->update(
                [
                    'qty' => DB::raw("qty + '$order->qty'")
                ]
            );
        }
        // kalo order sudah sampai, tambahkan column sold sejumlah order qty
        elseif ($request->order_status_id == 5) {
            $product->update(
                [
                    'sold' => DB::raw("sold + '$order->qty'")
                ]
            );
        }
        // update status
        $order->update(
            [
                'order_status_id' => $request->input('order_status_id')
            ]
        );

        return redirect()
            ->route('order.index')
            ->with('success', 'Data has been updated successfully');
    }
}
