@extends('layouts.app')

@section('content')
   
  <div class="container py-5">
      <div class="row align-items-center">
          <div class="d-flex gap-2 align-items-center justify-content-end">
              <a href="{{ route('projects.edit',$project) }}"><i class="fa-solid fa-pencil"></i></a>
              <form action="{{route('projects.destroy', $project)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="border-0 bg-transparent">
                  <i class="text-danger fa-regular fa-trash-can"></i>
                </button>
              </form>
              @if ($project->trashed())
              <form action="{{route('projects.restore', $project)}}" method="POST">
                @csrf
                <button type="submit" class="border-0 bg-transparent">
                  <i class="text-success fa-solid fa-trash-arrow-up"></i>
                </button>
              </form>
              @endif
            </div>
          <div class="col">
              <h3 class="project_title">Title: {{$project->title}}</h3>
              
                @if($project->type)
                  <span class="badge text-bg-success mb-4 py-2">{{ $project->type->name }}</span>
                @else
                  <span class="badge text-bg-secondary mb-4 py-2"> Nessun Tipo </span>
                @endif
                
              <p class="m-0"><strong>Description:</strong></p>
              @if (!$project->description)
                  <p>Not available</p>
              @endif
              <p>{{$project->description}}</p>
              <ul class="p-0">
                  <li> <strong> Customer: </strong> {{ $project->customer}} </li>
                  <li> <a href="{{ $project->url}}"> Url </a> </li>
              </ul>
          </div>
      </div>
  </div>

@endsection