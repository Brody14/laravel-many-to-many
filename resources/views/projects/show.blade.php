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
              
             <div class="d-flex gap-2 align-items-center mb-4">
                @if($project->type)
                  <span class="badge text-bg-success py-2">
                    <a class="text-white" href="{{ route('types.show', $project->type)}}"> 
                      {{ $project->type->name }} 
                    </a>
                  </span>
                @else
                  <span class="badge text-bg-secondary py-2"> No Types </span>
                @endif

                <ul class="p-0 m-0 d-flex gap-2">
                  @forelse ($project->technologies as $tec)
                    <li>
                      <span class="badge rounded-pill text-bg-primary">
                        <a class="text-white" href="{{ route('technologies.show', $tec) }}">
                          {{ $tec->name}}
                        </a> 
                      </span>
                    </li>
                  @empty
                    <li><span class="badge rounded-pill text-bg-primary"> No technologies </span></li>
                  @endforelse
                </ul>
             </div>
                
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

  <div class="container">
    <h5>Related Project</h5>
    <ul class="p-0">
      @if ($project->type)
        @foreach($project->getRelatedProjects() as $related)
          <li>
              <a href="{{ route('projects.show', $related)}}">
                {{ $related->title}}
              </a>
          </li>
        @endforeach

        @else
          <li>No matches found</li>
        @endif
    </ul>
  </div>


@endsection