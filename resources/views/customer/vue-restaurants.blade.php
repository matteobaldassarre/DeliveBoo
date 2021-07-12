@extends('layouts.app')

@section('axios-cdn')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
@endsection

@section('content')
    <div id="root">
        <div class="container">
            <h1>Vue Restaurants</h1>
            <div v-for="restaurant in restaurants">
                <h4>Restaurant Info:</h4>
                <ul>
                    <li>
                        @{{ restaurant.name }}
                    </li>
                    <li>
                        @{{ restaurant.address }}
                    </li>
                    <li>
                        @{{ restaurant.VAT }}
                    </li>
                    <li>
                        @{{ restaurant.restaurateur }}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- VueJS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    {{-- Script JS --}}
    <script src="{{ asset('js/vue-restaurants.js') }}"></script>
@endsection