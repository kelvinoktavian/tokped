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
            'total_carousel' => DB::table('carousels')->count('id'),
            'total_category' => DB::table('categories')->count('id'),
            'total_product' => DB::table('products')->count('id'),
            'total_order' => DB::table('orders')->count('id'),
            'total_order_status' => DB::table('order_statuses')->count('id'),
            'total_user' => DB::table('users')->count('id'),
        ]);
    }
}
