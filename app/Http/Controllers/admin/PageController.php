<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'title' => 'Dashboard',
            'total_brand' => DB::table('brands')->count(),
            'total_category' => DB::table('categories')->count(),
            'total_product' => DB::table('products')->count(),
            'total_order' => DB::table('orders')->count(),
            'total_order_status' => DB::table('order_statuses')->count(),
            'total_user' => DB::table('users')->count(),
        ]);
    }
}
