<?php

namespace App\Http\Controllers\admin;

use App\Models\OrderStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderStatusRequest;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order_statuses = OrderStatus::select(
            'id',
            'slug',
            'status'
        )->where([
            ['status', '!=', NULL],
            [function ($query) use ($request) {
                if ($search = $request->search) {
                    $query
                        ->orWhere('status', 'LIKE', '%' . $search . '%')
                        ->get();
                }
            }]
        ])
            ->orderBy('created_at', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('admin.order_status.index', [
            'title' => 'Order Statuses',
            'order_statuses' => $order_statuses
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
        return view('admin.order_status.create', [
            'title' => 'Add Order Status',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderStatusRequest $request)
    {
        OrderStatus::create(
            [
                'slug' => Str::slug($request->input('status')),
                'status' => $request->input('status'),
            ]
        );

        return redirect()
            ->route('order_status.index')
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
        $order_status = OrderStatus::select(
            'id',
            'slug',
            'status'
        )->firstWhere('slug', $slug);

        if ($order_status == NULL) {
            return redirect()
                ->route('order_status.index')
                ->with('error', 'Data not found!');
        }

        return view('admin.order_status.edit', [
            'title' => 'Edit Order Status',
            'order_status' => $order_status
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
        $order_status = OrderStatus::firstWhere('slug', $slug);

        if ($order_status == NULL) {
            return redirect()
                ->route('order_status.index')
                ->with('error', 'Data not found!');
        }

        if ($order_status->status == $request->status) {
            $rule_status = 'required';
        } else {
            $rule_status = 'required|unique:order_statuses';
        }

        $this->validate($request, [
            'status' => $rule_status
        ]);

        // Update data
        $order_status->update(
            [
                'slug' => Str::slug($request->input('status')),
                'status' => $request->input('status'),
            ]
        );

        return redirect()
            ->route('order_status.index')
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
        $order_status = OrderStatus::firstWhere('slug', $slug);

        if ($order_status == NULL) {
            return redirect()
                ->route('order_status.index')
                ->with('error', 'Data not found!');
        } else {
            $order_status->delete();
        }

        return redirect()
            ->route('order_status.index')
            ->with('success', 'Data has been deleted successfully');
    }
}
