@extends('layouts.app')

@section('content')
    
    <div class="container py-5 text-center">
        <h1>{{request('trashed') ? 'Trash' : 'All Projects'}}</h1>
        <div class="d-flex justify-content-end py-2 gap-3">
          @if (request('trashed'))
            <a class="btn btn-outline-dark" href="{{ route('projects.index')}}"> All Projects </i></a>    
          @else
            <a class="btn btn-outline-dark" href="{{ route('projects.index', ['trashed' => true])}}"> Trash ({{$in_trash}}) </i></a>    
          @endif
          <a class="btn btn-outline-success" href="{{ route('projects.create')}}"> Aggiungi Progetto </i></a>
        </div>
    </div>

    <div class="container py-2">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Url</th>
                <th scope="col">Deleted</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($projects as $project)
                  <tr>
                    <td class="project_title">
                        <a href="{{ route('projects.show',$project) }}">{{ $project->title }}</a>
                    </td>
                    <td>{{ $project->description }}</td>
                    <td> <a href="{{ $project->url }}">Visit</a></td>
                    <td> {{ $project->trashed() ? $project->deleted_at->format('d/m/Y') : ''}}</td>
                    <td>
                      <div class="text-center d-flex gap-2 align-items-center">
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
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
    </div>

@endsection