<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway as Gateway;
use App\Order;
use App\User;
use App\Plate;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Gateway $gateway)
    {
        $token = $gateway->ClientToken()->generate();

        $data = [
            'token' => $token
        ];

        return view('customer.checkout', $data);
    }

    public function checkout(Gateway $gateway, Request $request)
    {
        $nonce = $request->payment_method_nonce;
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $address = $request->address;
        $postalCode = $request->postalcode;
        $order_id = $request->id;
        $mail = $request->mail;

        $order = Order::findOrFail($order_id);

        if ($order->status) {
            abort('404');
        }

        $amount = $order->total;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'billing' => [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'streetAddress' => $address,
                'postalCode' => $postalCode,
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {

            $transaction = $result->transaction;
            
            // Update Order 
            // $order = Order::findOrFail($order_id);

            $order->name = $firstName . ' ' . $lastName;
            $order->address = $address;
            $order->status = true;
            $order->mail = $mail;
            
            $order->update();

            $order_info_table = DB::table('order_plate')
            ->join('plates', 'plate_id', '=', 'plates.id')
            ->join('users', 'user_id', '=', 'users.id')
            ->join('orders', 'order_id', '=', 'orders.id')
            ->get();

            $this_order_info = [];
            $order_restaurant = '';
            $order_number = '';

            dd($order_info_table->last());

            foreach ($order_info_table as $order) {
                if ($order->order_id == $order_id) {
                    $this_order_info[] = [
                        'plate_name' => Plate::find($order->plate_id)->name,
                        'plate_quantity' => $order->quantity,
                        'plate_price' => $order->price,
                    ];

                    $order_restaurant = User::find($order->user_id)->userInfo->restaurant_name;
                    $order_number = $order->order_id;
                }
            }

            $data = [
                'restaurant_name' => $order_restaurant,
                'order_number' => $order_number,
                'order_info' => $this_order_info,
                'order' => $order,
                'order_name' => $order->name
            ];

            return view('customer.success', $data);

        } else {

            $errorString = "";

            foreach  ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('An error occurred with the message:  ' . $result->message);
        }
    }
}
