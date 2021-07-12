@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Plate</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Edit New Plate --}}
        <form action="{{ route('restaurant.plates.update', ['plate' => $plate->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Plate Name Field --}}
            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="restaurant_name">Plate Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name', $plate->name) }}">
                </div>
            </div>

            {{-- Plate Image Field --}}
            <div class="form-group">
                <div class="row col-md-3 col-lg-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="Enter image">
                </div>
            </div> 

            {{-- Plate Name Field --}}
            <div class="form-group">
                <div class="row col-md-4 col-lg-3">
                    <label for="ingredients">Ingredients</label>
                    <input type="text" class="form-control" id="ingredients" name="ingredients" placeholder="Enter ingredients" value="{{ old('ingredients', $plate->ingredients) }}">
                </div>
            </div>

            <div class="form-group">
                <div class="row col-md-3 col-lg-3">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="{{ old('price', $plate->price) }}">
                </div>
            </div> 

            <div class="select">
                <label for="visible">select plate visibility to the customers: </label>
                <select name="visible" id="visible">
                    <option value="1">visible</option>
                    <option value="0">invisible</option>
                </select>
            </div>

            <div class="select">
                <label for="type">select plate type: </label>
                <select name="type" id="type">
                    <option value="Primo" {{ old('type', $plate->type) == 'Primo' ? 'selected' : ''}}>Primo</option>
                    <option value="Secondo" {{ old('type', $plate->type) == 'Secondo' ? 'selected' : ''}}>Secondo</option>
                    <option value="Contorno" {{ old('type', $plate->type) == 'Contorno' ? 'selected' : ''}}>Contorno</option>
                    <option value="Dolce"{{ old('type', $plate->type) == 'Dolce' ? 'selected' : ''}}>Dolce</option>
                    <option value="Antipasto" {{ old('type', $plate->type) == 'Antipasto' ? 'selected' : ''}}>Antipasto</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Done</button>
        </form>
    </div>
@endsection