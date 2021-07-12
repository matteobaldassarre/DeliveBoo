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
                    
                    <form action="{{ route('restaurant.plates.destroy', ['plate' => $plate->id ] )}}" method="post">
                        @csrf
                        @method('DELETE')

                        <input type="submit" class="btn btn-danger" value="Cancella post" onclick="return confirm('Press ok to confirm and delete this plate')">
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection