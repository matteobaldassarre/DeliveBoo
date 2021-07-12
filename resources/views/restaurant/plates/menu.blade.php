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
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection