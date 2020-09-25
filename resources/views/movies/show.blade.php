@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center">
        <p class="h3 mb-0">{{ $movie->name }}</p>

        <div class="ml-auto">
            <div class="d-flex align-items-center justify-content-end">
                <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('movies.destroy', $movie) }}" method="post">
                        @csrf @method('delete')
                        <button class="btn btn-danger">Удалить</button>
                    </form>
            </div>
        </div>
    </div>

    <p class="h6">{{ $movie->original_name }}</p>

    <hr style="border-style: dashed;">

    @if($movie->image_path)
        <img src="{{ Storage::url($movie->image_path) }}" alt="{{ $movie->name }}">
        <hr style="border-style: dashed;">
    @endif

    <div class="mb-3 d-flex">
        <div>
            {{ $movie->genre->name }}, {{ $movie->country->name }}
        </div>
        <div class="ml-auto">
            {{ $movie->year }}
        </div>
    </div>

    <div class="card card-body lead">
        {!! nl2br($movie->description) !!}
    </div>

    <hr style="border-style: dashed;">

    <div class="d-flex justify-content-end">

    </div>

@endsection
