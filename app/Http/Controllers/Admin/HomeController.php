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
        $restaurant_id = Auth::id();

        $restaurant_orders = DB::table('orders')
        ->selectRaw('orders.id, MONTH(orders.created_at) as mese')
        ->distinct()
        ->leftJoin('order_plate', 'orders.id', '=', 'order_plate.order_id')
        ->join('plates', 'plate_id', '=', 'plates.id')
        ->where('user_id', '=', $restaurant_id)
        ->get();

        $total_restaurant_orders = count($restaurant_orders);

        
        $data = [
            'user' => $current_user,
            'user_info' => $current_user->userInfo,
            'total_orders' => $total_restaurant_orders,
            'orders' => $restaurant_orders
        ];

        return view('admin.home', $data);
    }
}
