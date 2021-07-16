@extends('layouts.app')

@section('axios-cdn')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
@endsection

@section('page_title')DeliveBoo Home @endsection

@section('login-register')
    {{-- Login & Register Buttons --}}
    <div class="login-register">
        <a href="{{ url('/login') }}" class="access-buttons">Login</a>
        <a href="{{ url('/register') }}" class="access-buttons">Register</a>
    </div>
@endsection

@section('search-bar')
    {{-- SearchBar --}}
    <div class="search-bar">
        <input type="text" placeholder="Search Restaurant" v-model="searchedRestaurant" v-on:keyup="searchRestaurantByName(searchedRestaurant)">
    </div>
@endsection

@section('content')
    <div class="container">
        {{-- Types Buttons --}}
        <div class="wrapper text-center">
            <span v-for="type in restaurantsTypes">
                <a class="btn" v-on:click="searchRestaurantByType(type.id)">@{{ type.name }}</a>
            </span>
        </div>

        <div class="row">
            {{-- Bootstrap Plate Card --}}
            <div class="col-lg-3 mb-4" v-for="restaurant in filteredRestaurantsByType">
                <div class="card">
                    <div class="card-body">
                        {{-- Restaurant Name --}}
                        <h4 class="card-title">@{{ restaurant.restaurant_name }}</h4>

                        {{-- Restaurant Address --}}
                        <p class="card-text">Indirizzo: @{{ restaurant.address }}</p>

                        <a :href="'restaurant/' + restaurant.slug">Vai Al Menu</a>
                    </div>
                </div>
            </div>
            {{-- End Bootstrap Plate Card --}}
        </div>
    </div>
@endsection

@section('scripts')
    {{-- VueJS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    {{-- Script JS --}}
    <script src="{{ asset('js/home.js') }}"></script>
@endsection