<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserInfo;

class UserInfoController extends Controller
{
    public function index()
    {
        $restaurants = UserInfo::all();

        $filtered_restaurants = [];

        foreach ($restaurants as $restaurant) {

            $filtered_restaurants[] = [
                'name' => $restaurant->restaurant_name,
                'address' => $restaurant->address,
                'VAT' => $restaurant->VAT,
                'cover' => $restaurant->cover,
                'restaurateur' => User::find($restaurant->user_id)->name
            ];

        }

        $result = [
            'restaurants' => $filtered_restaurants,
            'succes' => true
        ];

        return response()->json($result);
    }
}
