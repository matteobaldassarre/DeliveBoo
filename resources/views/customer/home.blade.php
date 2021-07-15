@extends('layouts.app')

@section('axios-cdn')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
@endsection

@section('page_title')DeliveBoo Home @endsection

@section('content')
    <div id="root">
        <div class="container">
            <nav>
                <h1>Search a Restaurant</h1>
            </nav>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search a restaurant" v-model="searchedRestaurant" v-on:keyup="searchRestaurantByName(searchedRestaurant)">
            </div>

            <div class="d-flex justify-content-around mb-2">

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
                        </div>
                    </div>
                </div>
                {{-- End Bootstrap Plate Card --}}

            </div>
        </div>
    </div>

    {{-- VueJS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    {{-- Script JS --}}
    <script src="{{ asset('js/home.js') }}"></script>
@endsection