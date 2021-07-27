@extends('layouts.app')

@section('page_title')Menu Ristorante @endsection

@section('page_content')
    {{-- Page Header --}}
    <header class="page-header">
        <div class="wrapper">
            <div class="menu-header">
                {{-- DeliveBoo Logo --}}
                <div class="logo">
                    <a style="cursor: pointer" href="{{ route('customer.home') }}">
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
        </div>
    </header>
    {{-- End Page Header --}}


    <div class="container admin-plates-index">

        {{-- Private Restaurant Menu Page --}}
        @if (count($plates) == 0)
        <div class="text-center mt-5">
            <h3 class="text-center">Il tuo Menu al momento è vuoto!</h3>
            <a class="btn btn-primary" href="{{ route('admin.plates.create') }}">Aggiungi Piatto</a>
        </div>
        @else

            @foreach ($types_ordered as $type => $plates_ordered)
                <h2>{{ $type }}</h2>
                <div class="row">
                    @foreach ($plates_ordered as $plate)
                        {{-- Bootstrap Plate Card --}}
                        <div class="col-lg-3 mb-4">
                            <div class="card">
                                {{-- Plate Image --}}
                                @if($plate->image)
                                    <img class="card-img-top" src="{{asset('storage/' . $plate->image)}}" alt="plate-image">
                                @endif

                                <div class="card-body">
                                    {{-- Plate Name --}}
                                    <h5 class="card-title">{{$plate->name}}</h5>

                                    {{-- Plate Ingredients --}}
                                    <div>Ingredienti:</div>
                                    <p class="card-text">{{$plate->ingredients}}</p>

                                    {{-- Plate Type --}}
                                    <div>Tipo:</div>
                                    <p class="card-text">{{$plate->type}}</p>

                                    {{-- Plate Price --}}
                                    <p class="card-text">Price: {{$plate->price}} €</p>


                                    {{-- Edit Plate Button --}}
                                    <a href="{{ route('admin.plates.edit', ['plate' => $plate->id]) }}" class="card-link"><i class="far fa-edit"></i></a>
                                    

                                    {{-- Delete Plate Button --}}
                                    <form action="{{ route('admin.plates.destroy', ['plate' => $plate->id ] )}}" method="post" class="d-inline-block" id="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-2" onclick="return confirm('Vuoi eliminare questo piatto?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                    {{-- End Delete Plate Button --}}
                                </div>
                            </div>
                        </div>
                        {{-- End Bootstrap Plate Card --}}
                    @endforeach
                </div>
            @endforeach

        @endif
        {{-- End Private Restaurant Menu Page --}}
    </div>
@endsection