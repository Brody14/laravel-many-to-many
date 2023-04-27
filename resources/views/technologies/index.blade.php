@extends('layouts.app')

@section('content')

<div class="container py-5 text-center">
    <h1>All Technologies</h1>
    <div class="d-flex justify-content-end py-2 gap-3">
      @if (request('trashed'))
        <a class="btn btn-outline-dark" href="{{ route('technologies.index')}}"> All technologies </i></a>    
      @else
        <a class="btn btn-outline-dark" href="{{ route('technologies.index', ['trashed' => true])}}"> Trash ({{$in_trash}}) </i></a>    
      @endif
        <a class="btn btn-outline-success" href="{{ route('technologies.create')}}"> Add Technology </i></a>
    </div>
</div>

<div class="container py-2">
    <table class="table w-25 mx-auto">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col" class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($technologies as $tec)
              <tr>
                <td>
                    <a href="{{ route('technologies.show', $tec) }}">{{ $tec->name }}</a>
                </td>
                <td>
                  <div class="d-flex gap-2 align-items-center justify-content-end">
                    <a href="{{ route('technologies.edit',$tec) }}"><i class="fa-solid fa-pencil"></i></a>
                    <form action="{{route('technologies.destroy', $tec)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="border-0 bg-transparent">
                        <i class="text-danger fa-regular fa-trash-can"></i>
                      </button>
                    </form>
                      @if ($tec->trashed())
                        <form action="{{route('technologies.restore', $tec)}}" method="POST">
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