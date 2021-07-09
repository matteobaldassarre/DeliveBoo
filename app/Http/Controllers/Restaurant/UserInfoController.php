<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\UserInfo;

class UserInfoController extends Controller
{

    // TODO ?
    // Possibilità di togliere questa funzione ed utilizzare direttamente la homepage privata
    // per mostrare tutte le info del ristorante subito nella dashboard
    public function index()
    {
        $current_user = Auth::user();

        $data = [
            'user' => $current_user,
            'user_info' => $current_user->userInfo
        ];

        return view('restaurant.info.index', $data);
    }


    public function create()
    {
        return view('restaurant.info.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'restaurant_name' => 'required|min:5',
            'address' => 'required|min:5|max:30',
            'VAT' => 'required|min:11|max:11',
        ]);

        $form_data = $request->all();

        $user_info = new UserInfo();

        $user_info->fill($form_data);
        $user_info->slug = Str::slug($form_data['restaurant_name'], '-');
        $user_info->user_id = Auth::id();
        $user_info->save();

        return redirect()->route('restaurant-info.index');
    }


    public function edit($slug)
    {
        $current_user = Auth::user();

        $data = [
            'user' => $current_user,
            'user_info' => $current_user->userInfo
        ];

        return view('restaurant.info.edit', $data);
    }


    public function update(Request $request, $slug)
    {
        $request->validate([
            'restaurant_name' => 'required|min:5',
            'address' => 'required|min:5|max:30',
            'VAT' => 'required|min:11|max:11',
        ]);

        $current_user = Auth::user();

        $form_data = $request->all();

        $user_to_edit = $current_user->userInfo;

        if ($form_data['restaurant_name'] != $user_to_edit->slug) {
            $user_to_edit->slug = Str::slug($form_data['restaurant_name'], '-');
        }

        $user_to_edit->update($form_data);

        return redirect()->route('restaurant-info.index');
    }


    public function destroy($id)
    {
        
    }
}
