@extends('layouts.app')

@section('page_title')DeliveBoo Home @endsection

@section('specific-cdns')
    <!-- Axios CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
@endsection

@section('page_content')
        {{-- VueJS Container --}}
        <div id="root">
            {{-- HomePage NavBar & Types Component --}}
            <div class="homepage-component" v-if="restaurantChosen == false">
                {{-- HomePage NavBar --}}
                <nav class="homepage-navbar">
                    <div class="wrapper">
                        <div class="container-flex">
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

                            {{-- Search Restaurant --}}
                            <div class="search-bar">
                                <input type="text" placeholder="Search Restaurant" v-model="searchedRestaurant" v-on:keyup="searchRestaurantByName(searchedRestaurant)">
                            </div>

                            @guest {{-- If the user is a Guest the following will be desplayed --}}

                                {{-- Login & Register Buttons --}}
                                <div class="login-register">
                                    <a href="{{ url('/login') }}" class="access-buttons">Login</a>
                                    <a href="{{ url('/register') }}" class="access-buttons">Register</a>
                                </div>

                            @else {{-- If the user is an Admin the following will be desplayed --}}

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

                            @endguest

                            {{-- Responsive Burger Menu --}}
                            <div class="burger-menu">
                                <i class="fa fa-bars"></i>
                            </div>

                        </div>
                    </div>
                </nav>

                {{-- HomePage Types Buttons --}}
                <div class="container">
                    {{-- Types Buttons --}}
                    <div class="wrapper text-center horizontal-scroll-container">
                        <a v-for="type in restaurantsTypes" class="button" v-on:click="searchRestaurantByType(type.id)">@{{ type.name }}</a>
                    </div>

                    <div class="jumbotron-container" v-if="filteredRestaurantsByType == 0">
                        <img src="https://wallpaperaccess.com/full/767277.jpg" alt="slider-image">
                    </div>

                    <div v-else>
                        <div class="row">
                            {{-- Bootstrap Plate Card --}}
                            <div class="col-lg-3 mb-4" v-for="restaurant in filteredRestaurantsByType">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- Restaurant Name --}}
                                        <h4 class="card-title">@{{ restaurant.restaurant_name }}</h4>

                                        {{-- Restaurant Address --}}
                                        <p class="card-text">Indirizzo: @{{ restaurant.address }}</p>

                                        <span class="btn btn-primary" v-on:click="getRestaurantInfo(restaurant.user_id)">Vai Al Menu</span>
                                    </div>
                                </div>
                            </div>
                            {{-- End Bootstrap Plate Card --}}
                        </div>
                    </div>

                    <div class="infos">
                        <div class="why-deliveboo">
                            <div class="title">Why DeliveBoo?</div>
                            DeliveBoo is a modern web application that allows you to order from all the best restaurants in town.
                        </div>
                        <div class="about-us">
                            <div class="title">About Us</div>
                            DeliveBoo is developed by a team of young and smart developer, here their contacts...
                        </div>
                    </div>

                </div>
            </div>
            {{-- End HomePage NavBar & Types Component --}}


            {{-- Single Restaurant Menu Component --}}
            <div class="restaurant-menu-page-show" v-if="restaurantChosen">
                {{-- Restaurant Jumbtron --}}
                <div class="menu-jumbotron" style="background-image: url('https://just-eat-prod-eu-res.cloudinary.com/image/upload/c_fill,f_auto,q_auto,w_1600,h_350,d_it:cuisines:hamburger-8.jpg/v1/it/restaurants/233148.jpg')">
                    <div class="container-flex">
                        {{-- DeliveBoo Logo --}}
                        <div class="deliveboo-logo">
                            <a style="cursor: pointer" v-on:click="restaurantChosen = false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="102" height="38.833" viewBox="0 0 102 38.833">
                                    <g id="Raggruppa_3" data-name="Raggruppa 3" transform="translate(-127 -74.167)">
                                        <text id="DeliveBoo" transform="translate(127 106)" fill="#fff" font-size="25" font-family="PTSans-BoldItalic, PT Sans" font-weight="700" font-style="italic"><tspan x="0" y="0">DeliveBoo</tspan></text>
                                        <path id="hamburger-solid" d="M17.219,39.917H1.781a1.7,1.7,0,1,0,0,3.393H17.219a1.7,1.7,0,1,0,0-3.393Zm.594,4.524H1.188a.58.58,0,0,0-.594.565v.565a2.321,2.321,0,0,0,2.375,2.262H16.031a2.321,2.321,0,0,0,2.375-2.262v-.565A.58.58,0,0,0,17.813,44.44ZM2.176,38.786H16.824A1.712,1.712,0,0,0,18.116,36.1C16.625,33.81,13.343,32,9.5,32S2.375,33.81.884,36.1A1.712,1.712,0,0,0,2.176,38.786ZM14.25,34.827a.566.566,0,1,1-.594.565A.58.58,0,0,1,14.25,34.827ZM9.5,33.7a.566.566,0,1,1-.594.565A.58.58,0,0,1,9.5,33.7ZM4.75,34.827a.566.566,0,1,1-.594.565A.58.58,0,0,1,4.75,34.827Z" transform="translate(210 42.167)" fill="#fff"/>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Restaurant Info Card --}}
                    <div class="menu-info-card" v-for="restaurantInfo in currentRestaurantInfo">
                        <h4>@{{ restaurantInfo.restaurant_name }}</h4>

                        <p>
                            <span v-for="type in restaurantInfo.types">
                                @{{ type.type_name }}
                                <span v-if="restaurantInfo.types.indexOf(type) < restaurantInfo.types.length - 1"> - </span> 
                            </span>
                        </p>

                        <span>@{{ restaurantInfo.address }}</span>
                    </div>

                    {{-- Restaurant Shopping Cart --}}
                    <div :class="totalPrice == 0 ? 'd-none' : ''">
                        <div class="cart">
                            <h2>Carrello</h2>
                            <ul>
                                <li v-for="product in shoppingCart">
                                    <span>@{{ product.name }}</span>
                                    <button v-on:click="removeQuantity(product)"> - </button>
                                    <span>@{{ product.quantity }}</span>
                                    <button v-on:click="addQuantity(product)"> + </button>
                                </li>
                            </ul>
                            <h3>Totale: @{{ totalPrice }}€</h3>

                            {{-- Form  --}}
                            <form action="{{ route('order-create') }}" method="get">
                                @csrf
                                @method('GET')
                                <input type="number" name="total" :value="totalPrice" class="d-none">
                                <div v-for="plate in shoppingCart">
                                    <input type="text" name="shoppingCart[]" :value="plate.id" class="d-none">
                                    <input type="text" name="shoppingCart[]" :value="plate.quantity" class="d-none">
                                </div>
                                
                                <input type="submit" value="Vai al checkout" class="btn btn-warning">
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Restaurant Jumbotron --}}
                

                {{-- Menu Sections --}}
                <div class="menu-sections">
                    {{-- Section --}}
                    <div v-for="type in platesTypes">
                        <h2>@{{ type }}</h2>
                        <div class="container-flex">
                            {{-- Food Card --}}
                            <div class="food-card" v-for="(plate, index) in currentRestaurantPlates" v-if="plate.type.replace(/.$/,'i') == type">
                                {{-- Food Image --}}
                                <div class="food-card-image">
                                    <img :src="'storage/' + plate.image" alt="plate-image">
                                </div>

                                {{-- Food Info --}}
                                <div class="food-card-info">
                                    <h4 class="food-card-title">@{{ plate.name }}</h4>
                                    <p class="food-card-ingredients">Ingredienti: @{{ plate.ingredients }}</p>

                                    <div class="food-card-price-button">
                                        <span class="food-card-price">@{{ plate.price }} €</span>
                                        <button class="food-card-button" v-on:click="addPlateToCart(plate, index)">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Menu Sections --}}
            </div>
            {{-- End Single Restaurant Menu Component --}}
        </div>
        {{-- End VueJS Container --}}
@endsection

@section('end_page_scripts')
    {{-- VueJS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    {{-- Script JS --}}
    <script src="{{ asset('js/home.js') }}"></script>
@endsection