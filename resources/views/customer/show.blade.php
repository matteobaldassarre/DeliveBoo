@extends('layouts.app')

@section('page_title'){{ $restaurant->restaurant_name }} @endsection

@section('page_content')
    <div class="restaurant-menu-page-show">
        {{-- Restaurant Jumbtron --}}
        <div class="menu-jumbotron" style="background-image: url('https://just-eat-prod-eu-res.cloudinary.com/image/upload/c_fill,f_auto,q_auto,w_1600,h_350,d_it:cuisines:hamburger-8.jpg/v1/it/restaurants/233148.jpg')">
            <div class="container-flex">
                {{-- DeliveBoo Logo --}}
                <div class="deliveboo-logo">
                    <a href="{{ route('customer.home') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="102" height="38.833" viewBox="0 0 102 38.833">
                            <g id="Raggruppa_3" data-name="Raggruppa 3" transform="translate(-127 -74.167)">
                                <text id="DeliveBoo" transform="translate(127 106)" fill="#fff" font-size="25" font-family="PTSans-BoldItalic, PT Sans" font-weight="700" font-style="italic"><tspan x="0" y="0">DeliveBoo</tspan></text>
                                <path id="hamburger-solid" d="M17.219,39.917H1.781a1.7,1.7,0,1,0,0,3.393H17.219a1.7,1.7,0,1,0,0-3.393Zm.594,4.524H1.188a.58.58,0,0,0-.594.565v.565a2.321,2.321,0,0,0,2.375,2.262H16.031a2.321,2.321,0,0,0,2.375-2.262v-.565A.58.58,0,0,0,17.813,44.44ZM2.176,38.786H16.824A1.712,1.712,0,0,0,18.116,36.1C16.625,33.81,13.343,32,9.5,32S2.375,33.81.884,36.1A1.712,1.712,0,0,0,2.176,38.786ZM14.25,34.827a.566.566,0,1,1-.594.565A.58.58,0,0,1,14.25,34.827ZM9.5,33.7a.566.566,0,1,1-.594.565A.58.58,0,0,1,9.5,33.7ZM4.75,34.827a.566.566,0,1,1-.594.565A.58.58,0,0,1,4.75,34.827Z" transform="translate(210 42.167)" fill="#fff"/>
                            </g>
                        </svg>
                    </a>
                </div>

                {{-- DeliveBoo Cart --}}
                <div class="cart">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>

            {{-- Restaurant Info Card --}}
            <div class="menu-info-card">
                <h4>{{ $restaurant->restaurant_name }}</h4>

                <p>
                    @foreach ($restaurant_types as $type)
                        {{ $type->type_name }} {{ $loop->last ? '' : '-' }}
                    @endforeach
                </p>


                <span>{{ $restaurant->address }}</span>
            </div>
        </div>
        {{-- End Restaurant Jumbotron --}}


        {{-- Menu Sections NavBar --}}
        <nav>
            <ul class="menu-sections-navbar">
                <li>
                    <a href="#">Antipasti</a>
                </li>
                <li>
                    <a href="#">Primi</a>
                </li>
                <li>
                    <a href="#">Secondi</a>
                </li>
                <li>
                    <a href="#">Contorni</a>
                </li>
                <li>
                    <a href="#">Dolci</a>
                </li>
            </ul>
        </nav>
        {{-- End Menu Sections NavBar --}}

        
        {{-- Menu Sections --}}
        <div class="menu-sections">
            {{-- Antipasti --}}
            <div class="antipasti">
                <h2>Antipasti</h2>
                <div class="container-flex">
                    @foreach ($plates as $plate)
                        @if ($plate->type == 'Antipasto' )
                            <div class="food-card">
                                <div class="food-card-image">
                                    <img src="{{asset('storage/' . $plate->image)}}" alt="food-image">
                                </div>

                                <div class="food-card-info">
                                    <h4 class="food-card-title">{{ $plate->name }}</h4>
                                    <p class="food-card-ingredients">Ingredienti: {{ $plate->ingredients }}</p>

                                    <div class="food-card-price-button">
                                        <span class="food-card-price">{{ $plate->price }}€</span>
                                        <button class="food-card-button">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Primi --}}
            <div class="primi">
                <h2>Primi</h2>
                @foreach ($plates as $plate)
                    @if ($plate->type == 'Primo' )
                        <div class="container-flex">
                            <div class="food-card">
                                <div class="food-card-image">
                                    <img src="{{asset('storage/' . $plate->image)}}" alt="food-image">
                                </div>

                                <div class="food-card-info">
                                    <h4 class="food-card-title">{{ $plate->name }}</h4>
                                    <p class="food-card-ingredients">Ingredienti: {{ $plate->ingredients }}</p>

                                    <div class="food-card-price-button">
                                        <span class="food-card-price">{{ $plate->price }}€</span>
                                        <button class="food-card-button">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Secondi --}}
            <div class="secondi">
                <h2>Secondi</h2>
                @foreach ($plates as $plate)
                    @if ($plate->type == 'Secondo' )
                        <div class="container-flex">
                            <div class="food-card">
                                <div class="food-card-image">
                                    <img src="{{asset('storage/' . $plate->image)}}" alt="food-image">
                                </div>

                                <div class="food-card-info">
                                    <h4 class="food-card-title">{{ $plate->name }}</h4>
                                    <p class="food-card-ingredients">Ingredienti: {{ $plate->ingredients }}</p>

                                    <div class="food-card-price-button">
                                        <span class="food-card-price">{{ $plate->price }}€</span>
                                        <button class="food-card-button">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Contorni --}}
            <div class="contorni">
                <h2>Contorni</h2>
                @foreach ($plates as $plate)
                    @if ($plate->type == 'Contorno' )
                        <div class="container-flex">
                            <div class="food-card">
                                <div class="food-card-image">
                                    <img src="{{asset('storage/' . $plate->image)}}" alt="food-image">
                                </div>

                                <div class="food-card-info">
                                    <h4 class="food-card-title">{{ $plate->name }}</h4>
                                    <p class="food-card-ingredients">Ingredienti: {{ $plate->ingredients }}</p>

                                    <div class="food-card-price-button">
                                        <span class="food-card-price">{{ $plate->price }}€</span>
                                        <button class="food-card-button">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Dolci --}}
            <div class="dolci">
                <h2>Dolci</h2>
                @foreach ($plates as $plate)
                    @if ($plate->type == 'Dolce' )
                        <div class="container-flex">
                            <div class="food-card">
                                <div class="food-card-image">
                                    <img src="{{asset('storage/' . $plate->image)}}" alt="food-image">
                                </div>

                                <div class="food-card-info">
                                    <h4 class="food-card-title">{{ $plate->name }}</h4>
                                    <p class="food-card-ingredients">Ingredienti: {{ $plate->ingredients }}</p>

                                    <div class="food-card-price-button">
                                        <span class="food-card-price">{{ $plate->price }}€</span>
                                        <button class="food-card-button">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        {{-- End Menu Sections --}}
    </div>
@endsection