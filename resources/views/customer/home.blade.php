@extends('layouts.app')

@section('page_title')DeliveBoo Home @endsection

@section('specific-cdns')
    {{-- Axios CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    {{-- Swiper Slider CDN --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
    {{-- Swiper Slider CDN --}}
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
@endsection

@section('page_content')
        {{-- VueJS Container --}}
        <div id="root">
            {{-- HomePage NavBar & Types Component --}}
            <div class="homepage-component" v-if="restaurantChosen == false">

                {{-- Navbar --}}
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
                                <i v-on:click="burgerVisibility()" class="fa fa-bars"></i>
                            </div>    
                        </div>
                        <div class="burger" v-if="burgerVisible">
                            <div class="login-register">
                                <a href="{{ url('/login') }}" class="access-buttons">Login</a>
                                <a href="{{ url('/register') }}" class="access-buttons">Register</a>
                            </div>
                        </div>
                    </div>
                </nav>   

                {{-- HomePage Types Buttons --}}
                <div class="text-center horizontal-scroll-container">
                    <a v-for="type in restaurantsTypes" class="button" v-on:click="searchRestaurantByType(type.id)">@{{ type.name }}</a>
                </div>

                {{-- Food Swiper Slider --}}
                <div class="jumbotron-container" v-if="filteredRestaurantsByType.length == 0">
                    {{-- Slider Container --}}
                    <div class="swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide slider-pic-1"></div>
                            <div class="swiper-slide slider-pic-2"></div>
                            <div class="swiper-slide slider-pic-3"></div>
                            <div class="swiper-slide slider-pic-4"></div>
                        </div>
                    </div>
                    {{-- End Slider Container --}}
                </div>
                {{-- End Food Swiper Slider --}}

                {{-- Default Restaurants --}}
                <div class="default-restaurants container" v-if="filteredRestaurantsByType.length == 0">
                    <h2>Ristoranti Popolari</h2>
                    <div class="row">
                        {{-- Bootstrap Plate Card --}}
                        <div class="col-lg-3 mb-4 restaurant-bts-card" v-for="restaurant in defaultRestaurants" style="cursor: pointer">
                            <div class="card" v-on:click="getRestaurantInfo(restaurant.user_id)">
                                {{-- Restaurant Image --}}
                                <img class="card-img-top" :src="'storage/' + restaurant.cover" alt="restaurant-cover">

                                {{-- Restaurant Name --}}
                                <div class="card-body text-center">
                                    <h4 class="card-title user-select-none">@{{ restaurant.restaurant_name }}</h4>
                                </div>
                            </div>
                        </div>
                        {{-- End Bootstrap Plate Card --}}
                    </div>
                </div>
                {{-- End Default Restaurants --}}
                

                <div v-if="filteredRestaurantsByType.length > 0">
                    <div class="container">
                        <div class="row">
                            {{-- Bootstrap Plate Card --}}
                            <div class="col-lg-3 mb-4" v-for="restaurant in filteredRestaurantsByType" style="cursor: pointer">
                                <div class="card" v-on:click="getRestaurantInfo(restaurant.user_id)">
                                    {{-- Restaurant Image --}}
                                    <img class="card-img-top" :src="'storage/' + restaurant.cover" alt="restaurant-cover">

                                    {{-- Restaurant Name --}}
                                    <div class="card-body">
                                        <div class="card-body text-center">
                                            <h4 class="card-title user-select-none">@{{ restaurant.restaurant_name }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Bootstrap Plate Card --}}
                        </div>
                    </div>
                </div>

                <div class="infos" v-if="filteredRestaurantsByType.length == 0">
                    <div class="why-deliveboo">
                        <div class="title">Why DeliveBoo?</div>
                        DeliveBoo è un sito web moderno che ti permette di ordinare i tuoi cibi preferiti comodamente dal divano di casa tua!
                    </div>
                    <div class="about-us">
                        <div class="title">About Us</div>
                        DeliveBoo è sviluppato da un team di junior full-stack web developers che si sono formati presso l'accademia Boolean Careers
                    </div>
                </div>

                {{-- HomePage Footer --}}
                <footer class="homepage-footer">
                    <div class="container">
                        {{-- Contact Us --}}
                        <div class="contact-us">
                            <h3>Contatti</h3>
                            <ul>
                                <li>
                                    Telefono: +39 3391112400
                                </li>
                                <li>
                                    Email: deliveboo.business@gmail.com
                                </li>
                                <li>
                                    Indirizzo: Via Delivery 107, Roma
                                </li>
                            </ul>
                        </div>

                        {{-- Download the App --}}
                        <div class="download-app">
                            <h3>Scarica l'App</h3>
                            <img src="img/google-play.png" alt="">
                            <img src="img/app-store.png" alt="">
                        </div>

                        {{-- Legal Pages --}}
                        <div class="legal-pages">
                            <h3>Pagine Legali</h3>
                            <ul>
                                <li>
                                    <a href="#">Terms & Conditions</a>
                                </li>
                                <li>
                                    <a href="#">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#">Refund Policy</a>
                                </li>
                                <li>
                                    <a href="#">Notifce for Copyright</a>
                                </li>
                                <li>
                                    <a href="#">Comment Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </footer>

            </div>
            {{-- End HomePage NavBar & Types Component --}}


            {{-- Single Restaurant Menu Component --}}
            <div class="restaurant-menu-page-show" v-if="restaurantChosen">
                {{-- Restaurant Jumbtron --}}
                <div class="menu-jumbotron">
                    <img class="single-restaurant-cover" :src="'storage/' + currentRestaurantInfo[0].cover" alt="restaurant-cover">
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

                        {{-- DeliveBoo Cart Icon --}}
                        <div :class="[sidebareVisible ? 'active' : '']" class="sidebar">

                            {{-- Restaurant Shopping Cart --}}
                            <div v-if="totalPrice == 0">
                                <div class="cart">
                                    <h2 class="pt-2">Carrello</h2>
                                    <p class="pt-5">Il tuo carrello al momento risulta vuoto!</p>
                                </div>
                            </div>
                            <div v-else>
                                <div class="cart">
                                    <h2 class="pt-2">Carrello</h2>
                                    {{-- Cart Inside --}}
                                    <a v-on:click="emptyCart()">Svuota</a>
                                    <ul>
                                        <li v-for="product in shoppingCart">
                                            <span>@{{ product.name }}</span>
                                            <a v-on:click="removeQuantity(product), closeSidebare(totalPrice)"> - </a>
                                            <span>@{{ product.quantity }}</span>
                                            <a v-on:click="addQuantity(product)"> + </a>
                                        </li>
                                    </ul>
                                    <h3>Totale: @{{ totalPrice.toFixed(2) }}€</h3>
                                    {{-- End Cart Inside --}}

                                    {{-- Go to Checkout Form --}}
                                    <form action="{{ route('order-create') }}" method="get">
                                        @csrf
                                        @method('GET')
                                        <div v-for="plate in shoppingCart">
                                            <input type="hidden" name="shoppingCart[]" :value="plate.id">
                                            <input type="hidden" name="shoppingCart[]" :value="plate.quantity">
                                        </div>
                                        
                                        <input type="submit" value="Vai al checkout" class="btn btn-warning">
                                    </form>
                                    {{-- End Go to Checkout Form --}}
                                </div>
                            </div>
                            {{-- End Restaurant Shopping Cart --}}

                            <button class="sidebarBtn" v-on:click="sidebareVisibility()">
                                <i class="fas fa-shopping-cart"></i>
                            </button>

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
                    {{-- End Restaurant Info Card --}}

                    
                    
                </div>
                {{-- End Restaurant Jumbotron --}}


                {{-- Menu Sections --}}
                <div class="menu-sections">
                    {{-- Section --}}
                    <div v-for="type in platesTypes" v-if="currentRestaurantPlates.some((plate) => plate.type.replace(/.$/,'i') == type)">
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
                                        <span class="food-card-price">@{{ plate.price.toFixed(2) }} €</span>
                                        <button class="food-card-button" v-on:click="sidebareVisibility(), addPlateToCart(plate, index)">Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Menu Sections --}}

                
            </div>
            {{-- End Single Restaurant Menu Component --}}
            <div v-on:click="sidebareVisibility()" :class="[!sidebareVisible ? 'activeTwo' : '']" class="veil"></div>
            
        </div>
        {{-- End VueJS Container --}}
@endsection

@section('end_page_scripts')
    {{-- VueJS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    {{-- Script JS --}}
    <script src="{{ asset('js/home.js') }}"></script>

    {{-- Swiper Slider Script --}}
    <script>
        const swiper = new Swiper('.swiper-container', {
            direction: 'horizontal',
            loop: true,
            autoplay: {
                delay: 2500,
            },
        });
    </script>
@endsection