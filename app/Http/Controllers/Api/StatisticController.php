<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class StatisticController extends Controller
{
    public function getStats($id) {
        $restaurant_id = $id;

        $all_orders = Order::all();

        $filtered_orders = [];

        foreach ($all_orders as $order) {
            dd($order);
        }
    }
}
