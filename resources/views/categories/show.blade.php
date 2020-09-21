@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center mb-3">

        <h1 class="h3 mb-0">{{ $category->id }}</h1>

        <div class="ml-auto d-flex align-items-center justify-content-end">
            @can('update', $category)
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">
                    Редактировать
                </a>
            @endcan
            @can('delete', $category)
                <form action="{{ route('categories.destroy', $category) }}" method="post">
                    @csrf @method('delete')
                    <button class="ml-2 btn btn-danger">
                        Удалить
                    </button>
                </form>
            @endcan
        </div>

    </div>

    <hr style="border-style: dashed;" />

    <div class="card card-body lead">
        {!! nl2br($category->name) !!}
    </div>

@endsection
