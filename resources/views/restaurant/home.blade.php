@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Restaurant Home</div>
        
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2>Welcome {{ $user->name }}!</h2>
                        <p>
                            This is your Dashboard, you can visit the other links to take a look at DeliveBoo.
                        </p>

                        @if (!$user_info)
                            <h3>First Step</h3>
                            <a class="btn btn-primary" href="{{ route('restaurant-info.create') }}">Add Restaurant Info</a>
                        @else
                            <ul>
                                <li>
                                    {{ $user_info->restaurant_name }}
                                </li>
                                <li>
                                    {{ $user_info->address }}
                                </li>
                                <li>
                                    {{ $user_info->VAT }}
                                </li>
                            </ul>

                            <a href="{{ route('restaurant-info.edit', ['slug' => $user_info->slug]) }}" class="btn btn-primary">Edit Your Restaurant</a>
                            <a href="{{ route('restaurant.plates.index') }}" class="btn btn-primary">View Menu</a>
                            <a href="{{ route('restaurant.plates.create') }}" class="btn btn-primary">Create Menu</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
