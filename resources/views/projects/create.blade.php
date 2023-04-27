@extends('layouts.app')

@section('content')
    
    <div class="container py-3">
        <h4>Add new project</h4>
    </div>

    <div class="container">
    <form action="{{ route('projects.store')}}" method="POST">

        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') ?? "" }}">
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">{{ old('description') ?? "" }}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="customer" class="form-label">Customer</label>
            <input type="text" class="form-control @error('customer') is-invalid @enderror" id="customer" name="customer" value="{{ old('customer') ?? "" }}">
            @error('customer')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">Url</label>
            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') ?? "" }}">
            @error('url')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type-id" class="form-label">Type</label>
            <select class="@error('type_id') is-invalid @enderror" id="type-id" name="type_id">
                <option value="">Select a type</option>
                @foreach ($types as $type)
                  <option @selected(old('type_id') == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="technologies" class="form-label">Technologies</label>
               <div class="d-flex gap-3 @error('technologies') is-invalid @enderror">
                @foreach ($technologies as $key => $tec)
                    <div class="form-check">
                        <input @checked(in_array($tec->id, old('technologies', []))) name="technologies[]" class="form-check-input" id="technologies" type="checkbox" value="{{ $tec->id}}">
                        <label class="form-check-label" for="technologies">
                            {{ $tec->name}}
                        </label> 
                    </div>
                @endforeach
               </div>

            @error('technologies')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
            

        <a href="{{route('projects.index')}}" class="btn btn-primary mb-3" role="button">Back</a>
        <button type="submit" class="btn btn-primary mb-3">Save</button>
    </form>



    </div>

@endsection