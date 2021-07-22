@extends('layouts.app')

@section('page_title')Restaurant Dashboard @endsection

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
            <div class="logo">
                <a href="{{ route('customer.home') }}" class="text-white text-decoration-none">DeliveBoo</a>
                <i class="fas fa-hamburger text-white"></i>
            </div>
        </div>
    </header>
    {{-- End Admin Dashboard Header --}}

    <div class="container admin-dashboard-main">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Restaurant Home</div>
        
                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- Dashboard Welcome Message --}}
                        <h2>Welcome {{ $user->name }}!</h2>
                        <p>
                            This is your Dashboard, you can visit the other links to take a look at DeliveBoo.
                        </p>

                        @if (!$user_info)
                            <h3>First Step</h3>
                            <a class="btn btn-primary" href="{{ route('admin-info.create') }}">Add Restaurant Info</a>
                        @else
                            @if ($user_info->cover)
                                <div class="flex-item">
                                    <img class="restaurant-cover" src="{{ asset('storage/' . $user_info->cover) }}" alt="{{ $user_info->restaurant_name  }}">
                                </div>
                            @endif

                            <ul>
                                <li>
                                    Restaurant Name &#8594; {{ $user_info->restaurant_name }}
                                </li>

                                <li>
                                    Restaurant Address &#8594; {{ $user_info->address }}
                                </li>
                                <li>
                                    Your VAT &#8594; {{ $user_info->VAT }}
                                </li>

                                <li>
                                    Types &#8594;
                                    @foreach ($user->types as $type)
                                            {{$type->type_name}}{{ $loop->last ? '' : ', ' }}
                                    @endforeach
                                </li>
                            </ul>


                            <div class="restaurant-actions">
                                <a href="{{ route('admin-info.edit', ['slug' => $user_info->slug]) }}" class="btn btn-primary">Edit Your Restaurant</a>
                                <a href="{{ route('admin.plates.index') }}" class="btn btn-primary">View Menu</a>
                                <a href="{{ route('admin.plates.create') }}" class="btn btn-primary">Add Plate</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="chart-container" style="position: relative; height:30%; width:100%">
            <canvas id="myCanvas"></canvas>
        </div>
    </div>
@endsection

@section('end_page_scripts')
    <script src="{{ asset('js/chart.js') }}"></script>
@endsection
