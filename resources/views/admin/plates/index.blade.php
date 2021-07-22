@extends('layouts.app')

@section('page_title')Restaurant Menu @endsection

@section('page_content')
    {{-- Page Header --}}
    <header class="page-header">
        <div class="wrapper">
            {{-- DeliveBoo Logo --}}
            <div class="logo">
                <a href="{{ route('customer.home') }}" class="text-white text-decoration-none">DeliveBoo</a>
                <i class="fas fa-hamburger text-white"></i>

                <a href="{{ route('admin.home') }}">Dashboard</a>
            </div>
        </div>
    </header>
    {{-- End Page Header --}}


    <div class="container">

        {{-- Private Restaurant Menu Page --}}
        @if (count($plates) == 0)
            <h3>Your Menu is Empty!</h3>
            <a class="btn btn-primary" href="{{ route('admin.plates.create') }}">Add Plate</a>
        @else
            
            <h2 class="text-center">Antipasti</h2>
            <div class="row">
                @foreach ($plates as $plate)
                    @if ($plate->type == 'Antipasto')
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
                                    <a href="{{ route('admin.plates.edit', ['plate' => $plate->id]) }}" class="card-link"><i class="far fa-edit"></i></a>
                                    

                                    {{-- Delete Plate Button --}}
                                    <form action="{{ route('admin.plates.destroy', ['plate' => $plate->id ] )}}" method="post" class="d-inline-block" id="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" class="ml-2" onclick="return confirm('Want to delete this plate?')"><i class="far fa-trash-alt"></i></a>
                                    </form>
                                    {{-- End Delete Plate Button --}}
                                </div>
                            </div>
                        </div>
                        {{-- End Bootstrap Plate Card --}}
                    @endif
                @endforeach
            </div>

            <h2 class="text-center">Primi</h2>
            <div class="row">
                @foreach ($plates as $plate)
                    @if ($plate->type == 'Primo')
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
                                    <a href="{{ route('admin.plates.edit', ['plate' => $plate->id]) }}" class="card-link"><i class="far fa-edit"></i></a>
                                    

                                    {{-- Delete Plate Button --}}
                                    <form action="{{ route('admin.plates.destroy', ['plate' => $plate->id ] )}}" method="post" class="d-inline-block" id="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" class="ml-2" onclick="return confirm('Want to delete this plate?')"><i class="far fa-trash-alt"></i></a>
                                    </form>
                                    {{-- End Delete Plate Button --}}
                                </div>
                            </div>
                        </div>
                        {{-- End Bootstrap Plate Card --}}
                    @endif
                @endforeach
            </div>

            <h2 class="text-center">Secondi</h2>
            <div class="row">
                @foreach ($plates as $plate)
                    @if ($plate->type == 'Secondo')
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
                                    <a href="{{ route('admin.plates.edit', ['plate' => $plate->id]) }}" class="card-link"><i class="far fa-edit"></i></a>
                                    

                                    {{-- Delete Plate Button --}}
                                    <form action="{{ route('admin.plates.destroy', ['plate' => $plate->id ] )}}" method="post" class="d-inline-block" id="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" class="ml-2" onclick="return confirm('Want to delete this plate?')"><i class="far fa-trash-alt"></i></a>
                                    </form>
                                    {{-- End Delete Plate Button --}}
                                </div>
                            </div>
                        </div>
                        {{-- End Bootstrap Plate Card --}}
                    @endif
                @endforeach
            </div>

            <h2 class="text-center">Contorni</h2>
            <div class="row">
                @foreach ($plates as $plate)
                    @if ($plate->type == 'Contorno')
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
                                    <a href="{{ route('admin.plates.edit', ['plate' => $plate->id]) }}" class="card-link"><i class="far fa-edit"></i></a>
                                    

                                    {{-- Delete Plate Button --}}
                                    <form action="{{ route('admin.plates.destroy', ['plate' => $plate->id ] )}}" method="post" class="d-inline-block" id="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" class="ml-2" onclick="return confirm('Want to delete this plate?')"><i class="far fa-trash-alt"></i></a>
                                    </form>
                                    {{-- End Delete Plate Button --}}
                                </div>
                            </div>
                        </div>
                        {{-- End Bootstrap Plate Card --}}
                    @endif
                @endforeach
            </div>

            <h2 class="text-center">Dolci</h2>
            <div class="row">
                @foreach ($plates as $plate)
                    @if ($plate->type == 'Dolce')
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
                                    <a href="{{ route('admin.plates.edit', ['plate' => $plate->id]) }}" class="card-link"><i class="far fa-edit"></i></a>
                                    

                                    {{-- Delete Plate Button --}}
                                    <form action="{{ route('admin.plates.destroy', ['plate' => $plate->id ] )}}" method="post" class="d-inline-block" id="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" class="ml-2" onclick="return confirm('Want to delete this plate?')"><i class="far fa-trash-alt"></i></a>
                                    </form>
                                    {{-- End Delete Plate Button --}}
                                </div>
                            </div>
                        </div>
                        {{-- End Bootstrap Plate Card --}}
                    @endif
                @endforeach
            </div>

        @endif
        {{-- End Private Restaurant Menu Page --}}
    </div>
@endsection