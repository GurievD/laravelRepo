@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center">

        <div class="h5">Список всех жанров</div>

        @can('create', \App\Models\Genre::class)
            <a href="{{ route('genres.create') }}" class="btn btn-info ml-auto">Добавить новый жанр</a>
        @endcan
    </div>

    @include('components.genre-list')


@endsection
