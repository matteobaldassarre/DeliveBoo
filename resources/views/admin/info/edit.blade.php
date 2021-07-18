@extends('layouts.app')

@section('page_title')Edit Restaurant @endsection

@section('page_content')
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
                    <h5 for="restaurant_name">Restaurant Name</h5>
                    <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="{{ $user_info->restaurant_name }}">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="cover">Restaurant Cover</label>
                    <input type="file" id="cover" name="cover" placeholder="Enter your Restaurant Cover">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <h5 for="address">Address</h5>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter your restaurant address" value="{{ $user_info->address }}">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-3 col-lg-3">
                    <h5 for="VAT">VAT Number</h5>
                    <input type="text" class="form-control" id="VAT" name="VAT" placeholder="Enter your VAT Number" value="{{ $user_info->VAT }}">
                </div>
            </div> 

            <div class="form-group">
                <h5>Select Restaurant types</h5>
                
                @foreach ($types as $type)
                    <div class="form-check mb-3 mt-3">
                        @if ($errors->any())
                            <input class="form-check-input" name="types[]" type="checkbox" id="type-{{ $type->id }}" value="{{ $type->id }}" {{ in_array($type->id, old('types', [])) ? 'checked' : '' }}>
                        @else
                            <input class="form-check-input" name="types[]" type="checkbox" id="type-{{ $type->id }}" value="{{ $type->id }}" {{ $user_types->contains($type->id) ? 'checked' : '' }}>
                        @endif
                        <label class="form-check-label" for="type-{{ $type->id }}">{{ $type->type_name }}</label>
                    </div>
                @endforeach

            </div>

            <button type="submit" class="btn btn-primary">Done</button>
        </form>
    </div>
@endsection