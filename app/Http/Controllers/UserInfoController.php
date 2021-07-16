<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInfo;

class UserInfoController extends Controller
{
    public function show($slug)
    {
        $restaurant = UserInfo::where('slug', '=', $slug)->first();

        if(!$restaurant) {
            abort('404');
        }

        $data = [
            'restaurant' => $restaurant,
        ];

        return view('customer.show', $data);
    }
}
