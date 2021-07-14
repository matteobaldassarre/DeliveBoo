<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserInfo;
use App\Type;

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
                'restaurateur' => User::find($restaurant->user_id)->name,
                'types' => User::findOrFail($restaurant->user_id)->types
            ];

        }

        $result = [
            'restaurants' => $filtered_restaurants,
            'success' => true
        ];

        return response()->json($result);
    }


    public function types()
    {
        $restaurants_types = Type::all();
        
        $filtered_restaurants_types = [];

        foreach ($restaurants_types as $restaurant_type) {

            $filtered_restaurants_types[] = $restaurant_type->type_name;

        }

        $result = [
            'restaurants_types' => $filtered_restaurants_types,
            'success' => true
        ];

        return response()->json($result);
    }
}