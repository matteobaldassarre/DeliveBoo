@extends('layouts.app')

@section('page_title')Order Successful @endsection

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

                        Totale: <span class="price">{{ $order->total }}€</span>
                        
                        <h4 class="pt-4">Info Cliente</h4>
                        Nome: {{ $order_name }} <br>
                        Indirizzo: {{ $order->address }} <br>
                        Email: {{ $order->mail }}
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
    <script src="sweetalert2.all.min.js"></script>
    <script>
        localStorage.clear();
    </script>
    <script>
        orderCard = document.querySelector('.order-success-page');

        Swal.fire({
            title: 'Success!',
            text: 'Payment Successful',
            icon: 'success',
            confirmButtonText: 'View Order'
        }).then(() => {
            orderCard.style.opacity = 1;
        });
    </script>
@endsection