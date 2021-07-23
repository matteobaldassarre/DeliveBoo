<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Plate;
use App\UserInfo;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user_id = Auth::id();

        $plates = Plate::all();

        $filtered_plates = [];

        foreach ($plates as $plate) {
           if ($plate->user_id == $current_user_id) {
               $filtered_plates[] = $plate;
           }
        }

        $pluralizations = [
            'Antipasto' => 'Antipasti',
            'Primo' => 'Primi',
            'Secondo' => 'Secondi',
            'Contorno' => 'Contorni',
            'Dolce' => 'Dolci',
        ];
        
        $existing_types = array_unique(array_map(fn ($plate) => $pluralizations[$plate->type], $filtered_plates));

        $data = [
            'plates' => $filtered_plates,
            'existing_types' => $existing_types
        ];
        
        return view('admin.plates.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->userInfo) {
            return view('admin.plates.create');
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->formValidation($request);
        
        $form_data = $request->all();

        // Image Upload
        if (isset($form_data['image'])) {
            $img_path = Storage::put('plates-img', $form_data['image']);

            if ($img_path) {
                $form_data['image'] = $img_path;
            }
        }

        // Slug Management
        $new_slug = Str::slug($form_data['name'], '-');
        $base_slug = $new_slug;
        $existing_plate_with_slug = Plate::where('slug', '=', $new_slug)->first();
        $counter = 1;

        while ($existing_plate_with_slug) {
            $new_slug = $base_slug . '-' . $counter;
            $counter++;
            $existing_plate_with_slug = Plate::where('slug', '=', $new_slug)->first();
        }

        $form_data['slug'] = $new_slug;

        $plate = new Plate();

        $plate->user_id = Auth::id();

        $plate->fill($form_data);
        $plate->save();

        return redirect()->route('admin.plates.index');
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
        return view('admin.plates.edit', $data);
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
        $this->formValidation($request);

        $form_data = $request->all();

        $plate = Plate::findOrFail($id);

        if ($form_data['name'] != $plate->name){
            // Slug Management
            $new_slug = Str::slug($form_data['name'], '-');
            $base_slug = $new_slug;
            $existing_plate_with_slug = Plate::where('slug', '=', $new_slug)->first();
            $counter = 1;

            while ($existing_plate_with_slug) {
                $new_slug = $base_slug . '-' . $counter;
                $counter++;
                $existing_plate_with_slug = Plate::where('slug', '=', $new_slug)->first();
            }    

            $plate->slug = $new_slug;
        }

        // Image Upload
        if (isset($form_data['image'])) {
            $img_path = Storage::put('plates-img', $form_data['image']);

            if ($img_path) {
                $form_data['image'] = $img_path;
            }
        }

        $plate->update($form_data);

        return redirect()->route('admin.plates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plate = Plate::findOrFail($id);
        $plate->delete();

        return redirect()->route('admin.plates.index');
    }

    // Form Validation Function
    private function formValidation($request) {
        $request->validate([
            'name' => 'required|min:5|max:80',
            'image' => 'nullable|image',
            'ingredients' => 'required|min:5|max:500',
            'price' => 'required|numeric|gte:1|lte:500'
        ]);
    }
}
