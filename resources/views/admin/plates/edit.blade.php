@extends('layouts.app')

@section('page_title')Modifica Piatto @endsection

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


    <div class="container edit-plate-container">
        <div class="row col-md-12 col-lg-7 margin_auto pb-2 pt-2">
            <h1>Modifica Piatto</h1>
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
        {{-- End Bootstrap Validation Error Box--}}

        {{-- Edit New Plate Form --}}
        <form action="{{ route('admin.plates.update', ['plate' => $plate->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                    <label for="restaurant_name">Plate Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci nome del piatto" value="{{ old('name', $plate->name) }}">
                </div>
            </div>

            {{-- Plate Ingredients Field --}}
            <div class="form-group">
                <div class="row col-md-12 col-lg-7 margin_auto">
                    <label for="ingredients">Ingredients</label>
                    <input type="text" class="form-control" id="ingredients" name="ingredients" placeholder="Inserisci gli ingredienti" value="{{ old('ingredients', $plate->ingredients) }}">
                </div>
            </div>

            {{-- Plate Price Field --}}
            <div class="form-group">
                <div class="row col-md-12 col-lg-7 margin_auto">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Inserisci il prezzo" value="{{ old('price', $plate->price) }}">
                </div>
            </div> 

            {{-- Plate Visibility Field --}}
            <div class="select">
                <div class="row col-md-12 col-lg-7 margin_auto">
                    <label for="visible">Seleziona Visibilit?? Piatto: </label>
                    <select name="visible" id="visible">
                        <option value="1" {{ old('visisble', $plate->visible) == '1' ? 'selected' : ''}}>Visibile</option>
                        <option value="0" {{ old('visisble', $plate->visible) == '0' ? 'selected' : ''}}>Invisibile</option>
                    </select>
                </div>
            </div>

            {{-- Plate Type Field --}}
            <div class="select">
                <div class="row col-md-12 col-lg-7 margin_auto">
                    <label for="type">Select Plate Type: </label>
                    <select name="type" id="type">
                        <option value="Antipasto" {{ old('type', $plate->type) == 'Antipasto' ? 'selected' : ''}}>Antipasto</option>
                        <option value="Primo" {{ old('type', $plate->type) == 'Primo' ? 'selected' : ''}}>Primo</option>
                        <option value="Secondo" {{ old('type', $plate->type) == 'Secondo' ? 'selected' : ''}}>Secondo</option>
                        <option value="Contorno" {{ old('type', $plate->type) == 'Contorno' ? 'selected' : ''}}>Contorno</option>
                        <option value="Dolce"{{ old('type', $plate->type) == 'Dolce' ? 'selected' : ''}}>Dolce</option>
                    </select>
                </div>
            </div>

            {{-- Done Button --}}
            <div class="row col-md-12 col-lg-7 margin_auto">
                <button type="submit" class="btn btn-primary">Modifica</button>
            </div>
        </form>
        {{-- End Edit New Plate Form --}}
    </div>
@endsection