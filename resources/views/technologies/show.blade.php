@extends('layouts.app')

@section('content')
   
  <div class="container py-5">
      <div class="row align-items-center">
          <div class="d-flex gap-2 align-items-center justify-content-end">
              <a href="{{ route('technologies.edit',$technology) }}"><i class="fa-solid fa-pencil"></i></a>
              <form action="{{route('technologies.destroy', $technology)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="border-0 bg-transparent">
                  <i class="text-danger fa-regular fa-trash-can"></i>
                </button>
              </form>
              @if ($technology->trashed())
              <form action="{{route('technologies.restore', $technology)}}" method="POST">
                @csrf
                <button type="submit" class="border-0 bg-transparent">
                  <i class="text-success fa-solid fa-trash-arrow-up"></i>
                </button>
              </form>
              @endif
            </div>
          <div class="col">
              <h3>Name: {{$technology->name}}</h3>
              <h5 class="mb-5">ID: {{ $technology->id }} </h5>
              <h5>Related Projects</h5>
              <ul class="p-0">
                @forelse ($technology->projects as $project)
                  <li><a href="{{ route('projects.show', $project)}}">{{ $project->title }} </a> </li>        
                @empty
                   <li>No matches found </li>
                @endforelse 
    
              </ul>
          </div>
      </div>
  </div>

@endsection