@extends('layouts.app')

@section('page_title')Create Restaurant @endsection

@section('content')
    <div class="container">
        <h1>Create Your Restaurant</h1>

        {{-- Bootstrap Validation Error Box --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- End Bootstrap Validation Error Box --}}


        {{-- Add Your Restaurant Form --}}
        <form action="{{ route('admin-info.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="restaurant_name">Restaurant Name</label>
                    <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" placeholder="Enter your restaurant name" value="{{ old('restaurant_name') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="cover">Restaurant Cover</label>
                    <input type="file" id="cover" name="cover" placeholder="Enter your Restaurant Cover" value="{{ old('cover') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter your restaurant address" value="{{ old('address') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-3 col-lg-3">
                    <label for="VAT">VAT Number</label>
                    <input type="text" class="form-control" id="VAT" name="VAT" placeholder="Enter your VAT Number" value="{{ old('VAT') }}">
                </div>
            </div> 
            
            <div class="form-group">
                <h5>Select Restaurant types</h5>
                
                @foreach ($types as $type)
                    <div class="form-check mb-3 mt-3">
                        <input class="form-check-input" name="types[]" type="checkbox" id="type-{{ $type->id }}" value="{{ $type->id }}">
                        <label class="form-check-label" for="type-{{ $type->id }}">{{ $type->type_name }}</label>
                    </div>
                @endforeach

            </div>


            <button type="submit" class="btn btn-primary">Done</button>
        </form>
    </div>
@endsection