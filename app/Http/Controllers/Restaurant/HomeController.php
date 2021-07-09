<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $current_user = Auth::user();

        $data = [
            'user' => $current_user,
            'user_info' => $current_user->userInfo
        ];

        return view('restaurant.home', $data);
    }
}
