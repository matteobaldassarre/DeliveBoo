@extends('layouts.app')

@section('page_title')Dashboard Ristorante @endsection

@section('specific-cdns')
    {{-- Axios CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    {{-- ChartJs CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('page_content')
    {{-- Admin Dashboard Header --}}
    <header class="admin-dashboard-header">
        <div class="wrapper">
            {{-- DeliveBoo Logo --}}
            <div class="deliveboo-logo">
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
                    </div>
                </div>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </header>
    {{-- End Admin Dashboard Header --}}

    <div class="container admin-dashboard-main">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Home Ristorante</div>
        
                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- Dashboard Welcome Message --}}
                        <h2>Benvenuto/a, {{ $user->name }}!</h2>
                        <p>
                            Qui puoi visualizzare le informazioni relative al tuo ristorante.
                        </p>

                        @if (!$user_info)
                            <h3>Primo Step</h3>
                            <a class="btn btn-primary" href="{{ route('admin-info.create') }}">Aggiungi Ristorante</a>
                        @else
                            @if ($user_info->cover)
                                <div class="flex-item">
                                    <img class="restaurant-cover" src="{{ asset('storage/' . $user_info->cover) }}" alt="{{ $user_info->restaurant_name  }}">
                                    <div class="restaurant-box">
                                        <ul>
                                            <li>
                                                Ristorante &#8594; {{ $user_info->restaurant_name }}
                                            </li>

                                            <li>
                                                Indirizzo Ristorante &#8594; {{ $user_info->address }}
                                            </li>
                                            <li>
                                                N?? Partita IVA &#8594; {{ $user_info->VAT }}
                                            </li>

                                            <li>
                                                Tipologia &#8594;
                                                @foreach ($user->types as $type)
                                                        {{$type->type_name}}{{ $loop->last ? '' : ', ' }}
                                                @endforeach
                                            </li>
                                        </ul>

                                        <div class="restaurant-actions">
                                            <a href="{{ route('admin-info.edit', ['slug' => $user_info->slug]) }}" class="btn btn-primary">Modifica Ristorante</a>
                                            <a href="{{ route('admin.plates.index') }}" class="btn btn-primary ml-3 mr-3">Visualizza Menu</a>
                                            <a href="{{ route('admin.plates.create') }}" class="btn btn-primary">Aggiungi Piatto</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="flex-item">
                                    <div class="restaurant-box">
                                        <ul>
                                            <li>
                                                Ristorante &#8594; {{ $user_info->restaurant_name }}
                                            </li>

                                            <li>
                                                Indirizzo Ristorante &#8594; {{ $user_info->address }}
                                            </li>
                                            <li>
                                                N?? Partita IVA &#8594; {{ $user_info->VAT }}
                                            </li>

                                            <li>
                                                Tipologia &#8594;
                                                @foreach ($user->types as $type)
                                                        {{$type->type_name}}{{ $loop->last ? '' : ', ' }}
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center pt-5 pb-5">
        <div class="chart-container" style="position: relative; height:30%; width:100%">
            <canvas id="myCanvas"></canvas>
        </div>
    </div>
@endsection

@section('end_page_scripts')
    <script>
        // Configurazione iniziale
        let myCanvas = document.getElementById("myCanvas").getContext('2d');

        // Array contenenti i dati per popolare il grafico
        let mesi = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
        let ordini = JSON.parse('{!! $orders !!}');
        
        let ordiniPerMese = new Array(12).fill(0);
        

        ordini.forEach((element) => {
            ordiniPerMese[element.mese - 1]++;
        });

        // Global options
        Chart.defaults.font.family = 'Lato';
        Chart.defaults.font.size = 18;
        Chart.defaults.font.color = '#000';

        let chart = new Chart(myCanvas, {
            // Serve a selezionare il tipo di grafico
            // Altri tipi sono: bar, line, radar, ciambella, polarArea, bolla, scatter,
            type: 'bar',
            data: {
                // array importati con i dati
                labels: mesi,
                datasets: [{
                    label: "Numero Ordini",
                    data: ordiniPerMese,
                    // colore delle colonne
                    backgroundColor: [
                        '#234620',
                        '#32632d',
                        '#488143',
                        '#60a65a',
                        '#78c471',
                        '#91da8a',
                        '#aaeca4',
                        '#c9f6c5',
                        '#d7f6d4',
                        '#d2e7d0'
                    ],
                    hoverBorderWidth: 1,
                    hoverBorderColor: '#000'
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Ordini Ricevuti',
                        fontSize: 25
                    },
                    legend: {
                        display: false,
                        position: 'bottom'
                    },
                    layout: {
                        padding: {
                            top: 50,
                            bottom: 0
                        }
                    }
                }
            }
        });
    </script>
@endsection
