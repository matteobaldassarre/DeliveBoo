@extends('layouts.app')

@section('page_title')Restaurant Menu @endsection

@section('content')
    <div class="container">
        {{-- Private Restaurant Menu Page --}}
        <h1>Restaurant Menu</h1>
        <div class="row">
            @if (count($plates) == 0)
                <div class="container">
                    <h3>Your Menu is Empty!</h3>
                </div>
            @else
                @foreach ($plates as $plate)
                    {{-- Bootstrap Plate Card --}}
                    <div class="col-lg-3 mb-4">
                        <div class="card">
                            {{-- Plate Image --}}
                            @if($plate->image)
                                <img class="card-img-top" src="{{asset('storage/' . $plate->image)}}" alt="plate-image">
                            @endif

                            <div class="card-body">
                                {{-- Plate Name --}}
                                <h5 class="card-title">{{$plate->name}}</h5>

                                {{-- Plate Ingredients --}}
                                <div>Ingredienti:</div>
                                <p class="card-text">{{$plate->ingredients}}</p>

                                {{-- Plate Type --}}
                                <div>Tipo:</div>
                                <p class="card-text">{{$plate->type}}</p>

                                {{-- Plate Price --}}
                                <p class="card-text">Price: {{$plate->price}} €</p>


                                {{-- Edit Plate Button --}}
                                <a href="{{ route('restaurant.plates.edit', ['plate' => $plate->id]) }}" class="card-link">Edit Plate</a>
                                

                                {{-- Delete Plate Button --}}
                                <form action="{{ route('restaurant.plates.destroy', ['plate' => $plate->id ] )}}" method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="ml-2" value="Delete Plate" onclick="return confirm('Press ok to confirm and delete this plate')">
                                </form>
                                {{-- End Delete Plate Button --}}
                            </div>
                        </div>
                    </div>
                    {{-- End Bootstrap Plate Card --}}
                @endforeach
            @endif
        </div>
        {{-- End Private Restaurant Menu Page --}}
    </div>
@endsection