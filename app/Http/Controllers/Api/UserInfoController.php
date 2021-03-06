<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserInfo;
use App\Type;
use App\Plate;

class UserInfoController extends Controller
{
    public function index()
    {
        $restaurants = UserInfo::all();

        $filtered_restaurants = [];

        foreach ($restaurants as $restaurant) {

            $filtered_restaurants[] = [
                'restaurant_name' => $restaurant->restaurant_name,
                'address' => $restaurant->address,
                'VAT' => $restaurant->VAT,
                'cover' => $restaurant->cover,
                'slug' => $restaurant->slug,
                'user_id' => $restaurant->user_id,
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


    // Getting all type to print types buttons in page
    public function types()
    {
        $restaurants_types = Type::all();
        
        $filtered_restaurants_types = [];

        foreach ($restaurants_types as $restaurant_type) {

            $filtered_restaurants_types[] = [
                'name' => $restaurant_type->type_name,
                'id' => $restaurant_type->id
            ];

        }

        $result = [
            'restaurants_types' => $filtered_restaurants_types,
            'success' => true
        ];

        return response()->json($result);
    }


    // Searching restaurants by type
    public function searchRestaurants($type)
    {
        $type_id = $type;

        $all_restaurants = User::all();

        // Creating an array to store all filtered restaurants by type
        $filtered_restaurants = [];

        // Looping through all restaurants and taking all info of each one
        foreach ($all_restaurants as $restaurant) {

            if ($restaurant->types->count() > 0) {

                foreach ($restaurant->types as $restaurant_type) {

                    if ($restaurant_type->id == $type_id) {
                        $filtered_restaurants[] = $restaurant->userInfo;
                    }
                    
                }

            }

        }

        $result = [
            'restaurants' => $filtered_restaurants,
            'success' => true
        ];

        return response()->json($result);
    }


    public function getRestaurantPlates($id)
    {
        $restaurant_plates = Plate::where('user_id', '=', $id)->get();

        $filtered_plates = [];

        foreach ($restaurant_plates as $plate) {
            $filtered_plates[] = [
                'id' => $plate->id,
                'name' => $plate->name,
                'ingredients' => $plate->ingredients,
                'type' => $plate->type,
                'quantity' => '0',
                'image' => $plate->image,
                'visibility' => $plate->visible,
                'price' => $plate->price,
                'user_id' => $plate->user_id
            ];
        }
        
        $result = [
            'plates' => $filtered_plates,
            'success' => true
        ];

        return response()->json($result);
    }

    
}