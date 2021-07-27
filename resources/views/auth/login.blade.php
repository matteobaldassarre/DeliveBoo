@extends('layouts.app')

@section('page_title')Accedi @endsection

@section('page_content')
    <div class="access-page-container">
        {{-- Login Page Header --}}
        <header class="login-page">
            <div class="wrapper">
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
            </div>
        </header>
        {{-- End Login Page Header --}}

        {{-- Login Page Main --}}
        <div class="login-container">
            <div class="login-content">
                <div class="box">

                    <div class="title">
                        <h2>Accedi</h2>
                    </div>
                    

                    <div class="input-container">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="user-input">
                                <label for="email"></label>

                                <div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Inserisci il tuo indirizzo email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="user-input">
                                <label for="password"></label>

                                <div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Inserisci la password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="user-input">
                                <div class="check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>


                            <div class="button-container">
                                <button type="submit" class="click">
                                    ACCEDI
                                </button>

                                <h4>OPPURE</h4>

                                <a href="{{ url('/register') }}" class="click d-block" style="text-decoration: none">REGISTRATI</a>

                            </div>
                            
                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{-- End Login Page Main --}}
    </div>
@endsection
