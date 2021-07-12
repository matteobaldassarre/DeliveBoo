@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Restaurant Menu</h1>
        @foreach ($plates as $plate)
            <div class="card" style="width: 18rem;">
                @if($plate->image)
                    <img class="card-img-top" src="{{asset('storage/' . $plate->image)}}" alt="Card image cap">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{$plate->name}}</h5>
                    <p class="card-text">{{$plate->ingredients}}</p>
                    <p class="card-text">{{$plate->type}}</p>
                    {{-- <a href="#" class="card-link">view Plate</a> --}}
                    <a href="{{ route('restaurant.plates.edit', ['plate' => $plate->id]) }}" class="card-link">Edit Plate</a>
                    {{-- <a href="{{ route('restaurant.plates.edit') }}" class="card-link">delete Plate</a> --}}
                </div>
            </div>
        @endforeach
    </div>
@endsection