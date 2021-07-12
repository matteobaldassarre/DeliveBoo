<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Plate;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'plates' => Plate::all()
        ];
        return view('restaurant.plates.menu', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurant.plates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $form_data = $request->all();

        // Image Upload
        if (isset($form_data['image'])) {
            $img_path = Storage::put('plates-img', $form_data['image']);

            if ($img_path) {
                $form_data['image'] = $img_path;
            }
        }

        $plate = new Plate();

        // Slug Management
        $new_slug = Str::slug($plate->name, '-');
        $base_slug = $new_slug;
        $existing_plate_with_slug = Plate::where('slug', '=', $new_slug)->first();
        $counter = 1;

        while ($existing_plate_with_slug) {
            $new_slug = $base_slug . '-' . $counter;
            $counter++;
            $existing_plate_with_slug = Plate::where('slug', '=', $new_slug)->first();
        }    

        $plate->slug = $new_slug;

        $plate->user_id = Auth::id();

        $plate->fill($form_data);
        $plate->save();

        return redirect()->route('restaurant.plates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'plate' => Plate::findOrFail($id)
        ];
        return view('restaurant.plates.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
