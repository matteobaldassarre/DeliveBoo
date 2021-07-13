@extends('layouts.app')

@section('axios-cdn')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
@endsection

@section('page_title')Vue-Restaurants @endsection

@section('content')
    <div id="root">
        <div class="container">
            <h1>Vue Restaurants</h1>
            <div class="row">
                {{-- Bootstrap Plate Card --}}
                <div class="col-lg-3 mb-4" v-for="restaurant in restaurants">
                    <div class="card">
                        <div class="card-body">
                            {{-- Restaurant Name --}}
                            <h4 class="card-title">@{{ restaurant.name }}</h4>

                            {{-- Restaurant Address --}}
                            <p class="card-text">@{{ restaurant.address }}</p>
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
    <script src="{{ asset('js/vue-restaurants.js') }}"></script>
@endsection