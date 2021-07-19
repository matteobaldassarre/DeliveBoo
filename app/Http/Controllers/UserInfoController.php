<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInfo;
use App\User;
use App\Plate;

class UserInfoController extends Controller
{
    public function show($slug)
    {
        $restaurant = UserInfo::where('slug', '=', $slug)->first();

        $restaurant_plates = Plate::where('user_id', '=', $restaurant->user_id)->get();

        if(!$restaurant) {
            abort('404');
        }

        $data = [
            'restaurant' => $restaurant,
            'restaurant_types' => User::find($restaurant->user_id)->types,
            'plates' => $restaurant_plates
        ];

        return view('customer.show', $data);
    }
}
