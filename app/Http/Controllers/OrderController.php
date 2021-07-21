<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Braintree\Gateway as Gateway;

class OrderController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Gateway $gateway)
    {
        $order = new Order();

        $order->total = $request->total;
        $order->name = 'default';
        $order->address = 'default';
        $order->mail = 'default';
        $order->status= false;
        //$order = Order::find(1);

        $order->save();

        // test 
        // $user->roles()->attach($roleId, ['expires' => $expires]);
        $shoppingCart = $request->shoppingCart;
        for($i = 0; $i <= count($shoppingCart) - 1; $i += 2) {
                                    // id plate                        // quantity's id plate
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