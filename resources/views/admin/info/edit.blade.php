@extends('layouts.app')

@section('page_title')Edit Restaurant @endsection

@section('content')
    <div class="container">
        <h1>Edit Your Restaurant</h1>

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


        {{-- Edit Your Restaurant Form --}}
        <form action="{{ route('admin-info.update', ['slug' => $user_info->slug]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="restaurant_name">Restaurant Name</label>
                    <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="{{ $user_info->restaurant_name }}">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter your restaurant address" value="{{ $user_info->address }}">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-3 col-lg-3">
                    <label for="VAT">VAT Number</label>
                    <input type="text" class="form-control" id="VAT" name="VAT" placeholder="Enter your VAT Number" value="{{ $user_info->VAT }}">
                </div>
            </div> 

            <button type="submit" class="btn btn-primary">Done</button>
        </form>
    </div>
@endsection