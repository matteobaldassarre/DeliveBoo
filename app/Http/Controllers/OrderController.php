<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Plate;
use Braintree\Gateway as Gateway;

class OrderController extends Controller
{
    public function create(Request $request, Gateway $gateway)
    {
        $shoppingCart = $request->shoppingCart;

        $total = 0;
        $price = 0;
        $quantity = 0;

        for ($i = 0; $i <= count($shoppingCart) - 1; $i++) {

            if ($i % 2 == 0) {
                $price = Plate::find($shoppingCart[$i])->price;
            } else {
                $quantity = $shoppingCart[$i];
            }

            if ($price > 0 && $quantity > 0) {
                $partial_sum = $price * $quantity;
                $total += $partial_sum;
                $price = 0;
                $quantity = 0;
            }

        }

        $order = new Order();

        $order->total = $total;
        $order->name = 'Unfullfilled';
        $order->address = 'Unfullfilled';
        $order->mail = 'Unfullfilled';
        $order->status = false;

        $order->save();

        for($i = 0; $i <= count($shoppingCart) - 1; $i += 2) {
        //                             // id plate                       // quantity's id plate
            $order->plates()->attach($shoppingCart[$i], ['quantity' => $shoppingCart[$i + 1]]);
        }

        $token = $gateway->ClientToken()->generate();

        $data = [
            'token' => $token,
            'amount' => $order->total,
            'id_order' => $order->id
        ];

        return view('customer.checkout', $data);
    }
}
