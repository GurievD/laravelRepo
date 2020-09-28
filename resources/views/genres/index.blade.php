@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center">
        <div class="h3">Жанры</div>

        @can('create', \App\Models\Genre::class)
            <a href="{{ route('genres.create') }}" class="btn btn-success ml-auto">Добавить новый жанр</a>
        @endcan
    </div>

    @if($genres->isNotEmpty())
        <div class="row">
            @foreach($genres as $genre)
                <div class="col-md-3">
                    <div class="card card-body">
                        <div class="mb-3">
                            {{ $genre->name }}
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            @can('update', $genre)
                                <a href="{{ route('genres.edit', $genre) }}" class="mt-3 btn btn-warning btn-sm">Ред.</a>
                            @endcan
                            @can('delete', $genre)
                                <form action="{{ route('genres.destroy', $genre) }}" method="post">
                                    @csrf @method('delete')
                                    <button class="mt-3 btn btn-danger btn-sm">Удалить</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-secondary">
            Жанры отсутствуют в списке!
        </div>
    @endif

@endsection
