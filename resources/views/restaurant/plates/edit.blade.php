@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Plate</h1>

        {{-- Edit New Plate --}}
        <form action="{{ route('restaurant.plates.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            {{-- Plate Name Field --}}
            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="restaurant_name">Plate Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ $plate->name }}">
                </div>
            </div>

            {{-- Plate Image Field --}}
            <div class="form-group">
                <div class="row col-md-3 col-lg-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="Enter image">
                </div>
            </div> 

            {{-- Plate Name Field --}}
            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="address">Ingredients</label>
                    <input type="text" class="form-control" id="ingredients" name="ingredients" placeholder="Enter ingredients" value="{{ $plate->ingredients }}">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-3 col-lg-3">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="{{ $plate->price }}">
                </div>
            </div> 

            <div class="select">
                <label for="visible">select plate visibility to the customers: </label>
                <select name="visible" id="visible">
                <option value="1">visible</option>
                <option value="0">invisible</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Done</button>
        </form>
    </div>
@endsection