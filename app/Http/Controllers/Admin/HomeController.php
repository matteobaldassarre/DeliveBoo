<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $current_user = Auth::user();

        // TODO PASS CHARTJS NUMBERS OF ORDERS
        // $restaurant_id = Auth::id();

        // $restaurant_orders = DB::table('order_plate')
        // ->join('plates', 'plate_id', '=', 'plates.id')
        // ->join('orders', 'order_id', '=', 'orders.id')
        // ->join('users', 'user_id', '=', 'users.id')
        // ->get();

        // $orders_list = collect($restaurant_orders->where('user_id', '=', $restaurant_id)->all());

        // $filtered_orders = [];

        // foreach ($orders_list as $order) {
        //     if ($order->user_id == $restaurant_id && $order->status == 1) {
        //         $filtered_orders[] = $order;
        //     }
        // }

        $data = [
            'user' => $current_user,
            'user_info' => $current_user->userInfo
        ];

        return view('admin.home', $data);
    }
}
