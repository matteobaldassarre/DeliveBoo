@extends('layouts.app')

@section('page_title')Add Plate @endsection

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

            {{-- Options Dropdown --}}
            <div class="logout-dropdown">
                <div class="dropdown show">
                    <a class="btn dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <a href="{{ route('admin.home') }}" class="dropdown-item">Dashboard</a>
                    </div>
                </div>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </header>
    {{-- End Admin Dashboard Header --}}


    <div class="container create-plate-container">
        <div class="row col-md-12 col-lg-7 margin_auto pb-2 pt-2">
            <h1>Aggiungi Piatto</h1>
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
        
        {{-- Add New Plate --}}
        <form action="{{ route('admin.plates.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            {{-- Plate Image Field --}}
            <div class="form-group">
                <div class="row col-md-12 col-lg-7 margin_auto">
                    <h5>Immagine Piatto</h5>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" id="image" name="image">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Plate Name Field --}}
            <div class="form-group">
                <div class="row col-md-12 col-lg-7 margin_auto">
                    <label for="restaurant_name">Nome Piatto</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
                </div>
            </div>

            {{-- Plate Ingredients Field --}}
            <div class="form-group">
                <div class="row col-md-12 col-lg-7 margin_auto">
                    <label for="address">Ingredienti</label>
                    <input type="text" class="form-control" id="ingredients" name="ingredients" placeholder="Enter ingredients" value="{{ old('ingredients') }}">
                </div>
            </div>

            {{-- Plate Price Field --}}
            <div class="form-group">
                <div class="row col-md-12 col-lg-7 margin_auto">
                    <label for="price">Prezzo</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="{{ old('price') }}">
                </div>
            </div> 

            {{-- Plate Visibility Field --}}
            <div class="select">
                <div class="row col-md-12 col-lg-7 margin_auto">
                    <label for="visible">Seleziona Visibilità Piatto: </label>
                    <select name="visible" id="visible">
                        <option value="1" {{ old('visible') == '1' ? 'selected' : '' }}>Visibile</option>
                        <option value="0" {{ old('visible') == '0' ? 'selected' : '' }}>Invisibile</option>
                    </select>
                </div>
            </div>

            {{-- Plate Type Field --}}
            <div class="select">
                <div class="row col-md-12 col-lg-7 margin_auto">
                    <label for="type">Seleziona Tipo di Piatto: </label>
                    <select name="type" id="type">
                        <option value="Antipasto" {{ old('type') == 'Antipasto' ? 'selected' : '' }}>Antipasto</option>
                        <option value="Primo" {{ old('type') == 'Primo' ? 'selected' : '' }}>Primo</option>
                        <option value="Secondo" {{ old('type') == 'Secondo' ? 'selected' : '' }}>Secondo</option>
                        <option value="Contorno" {{ old('type') == 'Contorno' ? 'selected' : '' }}>Contorno</option>
                        <option value="Dolce" {{ old('type') == 'Dolce' ? 'selected' : '' }}>Dolce</option>
                    </select>
                </div>
            </div>

            {{-- Done Button --}}
            <div class="row col-md-12 col-lg-7 margin_auto">
                <button type="submit" class="btn btn-primary">Aggiungi</button>
            </div>
        </form>
    </div>
@endsection