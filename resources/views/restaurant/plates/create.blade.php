@extends('layouts.app')

@section('content')
    <h1>Add New Plate</h1>
    {{-- Add New Plate --}}
    <form action="{{ route('restaurant.plates.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-group">
            <div class="row col-md-4 col-lg-3">
                <label for="restaurant_name">Plate Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="row col-md-4 col-lg-3">
                <label for="address">Ingredients</label>
                <input type="text" class="form-control" id="ingredients" name="ingredients" placeholder="Enter ingredients" value="{{ old('ingredients') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="row col-md-3 col-lg-3">
                <label for="VAT">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="{{ old('price') }}">
            </div>
        </div> 

        <div class="form-group">
            <label for="visible">select plate visibility to the customers</label>
            <select multiple class="form-control" name="visible" id="visible">
            <option>visible</option>
            <option>invisible</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Done</button>
    </form>
@endsection