@extends('layouts.app')

@section('page_title')Crea Ristorante @endsection

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

    <div class="container create-restaurant-container">
        <div class="row col-md-6 col-lg-7 margin_auto pb-2 pt-2">
            <h1>Aggiungi Ristorante</h1>
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


        {{-- Add Your Restaurant Form --}}
        <form action="{{ route('admin-info.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                <div class="row col-md-6 col-lg-7 margin_auto">
                    <label for="cover">Immagine Ristorante</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" id="cover" name="cover">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-6 col-lg-7 margin_auto">
                    <label for="restaurant_name">Nome Ristorante</label>
                    <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" placeholder="Inserisci il nome del ristorante" value="{{ old('restaurant_name') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-6 col-lg-7 margin_auto">
                    <label for="address">Indirizzo</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Inserisci l'indirizzo del ristorante" value="{{ old('address') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-6 col-lg-7 margin_auto">
                    <label for="VAT">Nº Partita IVA</label>
                    <input type="text" class="form-control" id="VAT" name="VAT" placeholder="Inserisci il numero di partita IVA" value="{{ old('VAT') }}">
                </div>
            </div> 
            
            <div class="form-group">
                <div class="input-group row col-md-6 col-lg-7 margin_auto">
                    <label>Seleziona Tipo</label>
                </div>

                <div class="restaurant-type">            
                    @foreach ($types as $type)
                        <div class="form-check mb-3 mt-3">
                            <input class="form-check-input" name="types[]" type="checkbox" id="type-{{ $type->id }}" value="{{ $type->id }}" {{ in_array($type->id, old('types', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="type-{{ $type->id }}">{{ $type->type_name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-6 col-lg-7 margin_auto">
                    <button type="submit" class="btn btn-primary">Aggiungi</button>
                </div>
            </div>
        </form>
    </div>
@endsection