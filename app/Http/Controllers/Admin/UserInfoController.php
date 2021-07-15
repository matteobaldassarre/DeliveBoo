<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\UserInfo;
use App\Type;
use App\User;

class UserInfoController extends Controller
{
    public function create()
    {
        $types = Type::all();

        $data = [
            'types' => $types
        ];

        return view('admin.info.create', $data);
    }


    public function store(Request $request)
    {
        $this->formValidation($request);

        $form_data = $request->all();

        // Image Upload
        if (isset($form_data['cover'])) {
            $img_path = Storage::put('restaurants-img', $form_data['cover']);

            if ($img_path) {
                $form_data['cover'] = $img_path;
            }
        }

        $user = Auth::user();
        $user_info = new UserInfo();

        $user_info->fill($form_data);
        $user_info->slug = Str::slug($form_data['restaurant_name'], '-');
        $user_info->user_id = Auth::id();
        $user_info->save();

        if(isset($form_data['types']) && is_array($form_data['types'])) {
            $user->types()->sync($form_data['types']);
        }

        return redirect()->route('admin.home');
    }


    public function edit($slug)
    {
        $current_user = Auth::user();
        $types = Type::all();

        $data = [
            'user' => $current_user,
            'user_info' => $current_user->userInfo,
            'user_types' => $current_user->types,
            'types' => $types
        ];

        return view('admin.info.edit', $data);
    }


    public function update(Request $request, $slug)
    {
        $this->formValidation($request);

        $current_user = Auth::user();

        $form_data = $request->all();

        $user_to_edit = $current_user->userInfo;

        if ($form_data['restaurant_name'] != $user_to_edit->slug) {
            $user_to_edit->slug = Str::slug($form_data['restaurant_name'], '-');
        }  

        // Image Upload
        if (isset($form_data['cover'])) {
            $img_path = Storage::put('restaurants-img', $form_data['cover']);

            if ($img_path) {
                $form_data['cover'] = $img_path;
            }
        }

        $user_to_edit->update($form_data);

        //Sync tags
        if(isset($form_data['types']) && is_array($form_data['types'])) {
            $current_user->types()->sync($form_data['types']);
        } else {
            $current_user->types()->sync([]);
        }
        
        return redirect()->route('admin.home');
    }


    public function destroy($id)
    {
        
    }

    // Form Validation Function
    private function formValidation($request) 
    {
        $request->validate([
            'restaurant_name' => 'required|min:5',
            'address' => 'required|min:5|max:50',
            'VAT' => 'required|min:11|max:11',
            'types' => 'required|exists:types,id',
            'cover' => 'nullable|image'
        ]);
    }
}


