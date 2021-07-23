@extends('layouts.app')

@section('page_title')Edit Restaurant @endsection

@section('page_content')
    {{-- Admin Dashboard Header --}}
    <header class="admin-dashboard-header">
        <div class="wrapper">
             {{-- DeliveBoo Logo --}}
            <div class="deliveboo-logo">
                <a href="{{ url('/') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="102" height="38.833" viewBox="0 0 102 38.833">
                        <g id="Raggruppa_3" data-name="Raggruppa 3" transform="translate(-127 -74.167)">
                            <text id="DeliveBoo" transform="translate(127 106)" fill="#fff" font-size="25" font-family="PTSans-BoldItalic, PT Sans" font-weight="700" font-style="italic"><tspan x="0" y="0">DeliveBoo</tspan></text>
                            <path id="hamburger-solid" d="M17.219,39.917H1.781a1.7,1.7,0,1,0,0,3.393H17.219a1.7,1.7,0,1,0,0-3.393Zm.594,4.524H1.188a.58.58,0,0,0-.594.565v.565a2.321,2.321,0,0,0,2.375,2.262H16.031a2.321,2.321,0,0,0,2.375-2.262v-.565A.58.58,0,0,0,17.813,44.44ZM2.176,38.786H16.824A1.712,1.712,0,0,0,18.116,36.1C16.625,33.81,13.343,32,9.5,32S2.375,33.81.884,36.1A1.712,1.712,0,0,0,2.176,38.786ZM14.25,34.827a.566.566,0,1,1-.594.565A.58.58,0,0,1,14.25,34.827ZM9.5,33.7a.566.566,0,1,1-.594.565A.58.58,0,0,1,9.5,33.7ZM4.75,34.827a.566.566,0,1,1-.594.565A.58.58,0,0,1,4.75,34.827Z" transform="translate(210 42.167)" fill="#fff"/>
                        </g>
                    </svg>
                </a>
            </div>
        </div>
    </header>
    {{-- End Admin Dashboard Header --}}

    <div class="container">
        <div class="restaurant-form">
            <div class="row col-md-4 col-lg-6 margin_auto pb-2 pt-2">
                <h1>Edit Your Restaurant</h1>
            </div>

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
                    <div class="row col-md-4 col-lg-6 margin_auto">
                        <h5 for="restaurant_name">Restaurant Name</h5>
                        <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="{{ $user_info->restaurant_name }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-md-4 col-lg-6 margin_auto">
                        <h5 for="cover">Restaurant Cover</h5>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile02">
                                <label id="cover" class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-md-4 col-lg-6 margin_auto">
                        <h5 for="address">Address</h5>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter your restaurant address" value="{{ $user_info->address }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-md-3 col-lg-6 margin_auto">
                        <h5 for="VAT">VAT Number</h5>
                        <input type="text" class="form-control" id="VAT" name="VAT" placeholder="Enter your VAT Number" value="{{ $user_info->VAT }}">
                    </div>
                </div> 

                <div class="form-group">
                    <div class="input-group row col-md-4 col-lg-6 margin_auto">
                        <h5 for="visibility">Select Restaurant types</h5>
                    </div>

                    <div class="restaurant-type">
                        @foreach ($types as $type)
                            <div class="form-check mb-3 mt-3 space_inline">
                                @if ($errors->any())
                                    <input class="form-check-input" name="types[]" type="checkbox" id="type-{{ $type->id }}" value="{{ $type->id }}" {{ in_array($type->id, old('types', [])) ? 'checked' : '' }}>
                                @else
                                    <input class="form-check-input" name="types[]" type="checkbox" id="type-{{ $type->id }}" value="{{ $type->id }}" {{ $user_types->contains($type->id) ? 'checked' : '' }}>
                                @endif
                                <label class="form-check-label" for="type-{{ $type->id }}">{{ $type->type_name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Done</button>
            </form>
        </div>
    </div>
@endsection