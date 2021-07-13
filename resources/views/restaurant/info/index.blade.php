@extends('layouts.app')

@section('page_title')Restaurant Dashboard @endsection

@section('content')
    <div class="container">
        <h1>{{ $user->name }}, check your restaurant info!</h1>

        @if ($user_info)
            <ul>
                <li>
                    Restaurant Name: {{ $user_info->restaurant_name }}
                </li>
                <li>
                    Address: {{ $user_info->address }}
                </li>
                <li>
                    VAT Number: {{ $user_info->VAT }}
                </li>
            </ul>

        <a href="{{ route('restaurant-info.edit', ['slug' => $user_info->slug]) }}" class="btn btn-primary">Edit Your Restaurant</a>
        @endif
        
    </div>
@endsection