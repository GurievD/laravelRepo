@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center mb-3">

        <h1 class="h3 mb-0">{{ $post->title }}</h1>

        <div class="ml-auto d-flex align-items-center justify-content-end">
            @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">
                    Редактировать
                </a>
            @endcan
            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf @method('delete')
                    <button class="ml-2 btn btn-danger">
                        Удалить
                    </button>
                </form>
            @endcan
        </div>

    </div>

    <hr style="border-style: dashed;" />

    <div class="mb-3 text-muted d-flex">
        <div>
            Автор: {{ $post->user->name }}
        </div>
        <div class="ml-auto">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>

    <div class="card card-body lead">
        {!! nl2br($post->content) !!}
    </div>

@endsection
