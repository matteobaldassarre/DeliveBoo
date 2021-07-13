@extends('layouts.app')

@section('page_title')Add Plate @endsection

@section('content')
    <div class="container">
        <h1>Add New Plate</h1>
        {{-- Add New Plate --}}
        <form action="{{ route('restaurant.plates.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            {{-- Plate Name Field --}}
            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="restaurant_name">Plate Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
                </div>
            </div>

            {{-- Plate Image Field --}}
            <div class="form-group">
                <div class="row col-md-3 col-lg-3">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" placeholder="Enter image">
                </div>
            </div> 

            {{-- Plate Ingredients Field --}}
            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="address">Ingredients</label>
                    <input type="text" class="form-control" id="ingredients" name="ingredients" placeholder="Enter ingredients" value="{{ old('ingredients') }}">
                </div>
            </div>

            {{-- Plate Price Field --}}
            <div class="form-group">
                <div class="row col-md-3 col-lg-3">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="{{ old('price') }}">
                </div>
            </div> 

            {{-- Plate Visibility Field --}}
            <div class="select">
                <label for="visible">Select Plate Visibility to the customers: </label>
                <select name="visible" id="visible">
                    <option value="1">Visible</option>
                    <option value="0">Invisible</option>
                </select>
            </div>

            {{-- Plate Type Field --}}
            <div class="select">
                <label for="type">Select Plate Type: </label>
                <select name="type" id="type">
                    <option value="Primo">Primo</option>
                    <option value="Secondo">Secondo</option>
                    <option value="Contorno">Contorno</option>
                    <option value="Dolce">Dolce</option>
                    <option value="Antipasto">Antipasto</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Done</button>
        </form>
    </div>
@endsection