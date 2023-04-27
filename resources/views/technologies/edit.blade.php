@extends('layouts.app')

@section('content')
    
    <div class="container py-3">
        <h4>Edit technology</h4>
    </div>

    <div class="container">
    <form action="{{ route('technologies.update', $technology)}}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $technology->name) }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        <a href="{{route('technologies.index')}}" class="btn btn-primary mb-3" role="button">Back</a>
        <button type="submit" class="btn btn-primary mb-3">Save</button>
    </form>



    </div>

@endsection