<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway as Gateway;

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
            return back()->with('success_message', 'Transaction Successful. Transaction ID:' . $transaction->id);

        } else {
            $errorString = "";

            foreach  ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('An error occurred with the message:  ' . $result->message);
        }
    }
}
