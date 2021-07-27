@extends('layouts.app')

@section('page_title')Ordine Effettuato @endsection

@section('specific-cdns')
    {{-- Sweet Alert CDN --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('page_content')
    <div class="order-success-page">
        <div class="wrapper">
            <div class="card text-center">
                <div class="card-header">
                    Riepilogo Ordine
                </div>
                <div class="card-body">
                    <h5 class="card-title">Ordine Nº {{ $order_number }}</h5>

                    <p class="card-text">
                        <h4>Hai ordinato da: {{ $restaurant_name }}</h4>
                        @foreach ($order_info as $info)
                            <div>
                                {{ $info['plate_name'] }} x {{ $info['plate_quantity'] }} - <span class="price">{{ $info['plate_price'] * $info['plate_quantity'] }}€</span>
                            </div>
                        @endforeach

                        Totale: <span class="price">{{ $order_total }}€</span>
                    </p>
                    
                    <a href="{{ route('customer.home') }}" class="btn btn-primary">Torna alla Home</a>
                </div>
                <div class="card-footer text-muted">
                    Grazie per aver ordinato su DeliveBoo, <br>
                    il tuo ordine arriverà a breve!
                </div>
            </div>
        </div>
    </div>
@endsection

@section('end_page_scripts')
    {{-- Sweet Alert Script --}}
    <script src="sweetalert2.all.min.js"></script>

    {{-- Clearing LocalStorage when an order is completed --}}
    <script>
        localStorage.clear();
    </script>

    <script>
        orderCard = document.querySelector('.order-success-page');

        Swal.fire({
            title: 'Fatto!',
            text: 'Pagamento avvenuto con successo!',
            icon: 'success',
            confirmButtonText: 'Vedi Riepilogo'
        }).then(() => {
            orderCard.style.opacity = 1;
        });
    </script>
@endsection