<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway as Gateway;
use App\Order;

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
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $address = $request->address;
        $postalCode = $request->postalcode;
        $orderid = $request->id;
        $mail = $request->mail;

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
            
            // Update order 
            $order = Order::findOrFail($orderid);

            $order->name = $firstName . ' ' . $lastName;
            $order->address = $address;
            $order->status = true;
            $order->mail = $mail;
            
            $order->update();

            return view('customer.success');

        } else {

            $errorString = "";

            foreach  ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('An error occurred with the message:  ' . $result->message);
        }
    }
}
