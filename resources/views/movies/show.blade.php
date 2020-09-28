<?php
use Illuminate\Support\Facades\Auth;
$admin = $admin ?? null;
?>

@auth
    <?php
    if(isset(config('admin.admin_list')[Auth::user()->id])) {
        if(config('admin.admin_list')[Auth::user()->id] == Auth::user()->email) {
            $admin = true;
        }
    }
    ?>
@endauth

@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center">
        <p class="h3 mb-0">{{ $movie->name }}</p>

        <div class="ml-auto">
            <div class="d-flex align-items-center justify-content-end">
                @if($admin)
                    <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('movies.destroy', $movie) }}" method="post">
                        @csrf @method('delete')
                        <button class="ml-2 btn btn-danger">Удалить</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <hr style="border-style: dashed;">

    @if($movie->image_path)
        <img src="{{ Storage::url($movie->image_path) }}" alt="{{ $movie->name }}">
    @else
        <img src="https://diesel.tigmig.ru/image/cache/no-image-900x.jpg" alt="no_image">
    @endif

    <hr style="border-style: dashed;">

    <div class="mb-3 d-flex">
        <div>
            Жанр: {{ $movie->genre->name }}, Дата релиза: {{ $movie->release_date }}

        </div>
    </div>

    <div class="card card-body lead">
        <h5 class="d-flex align-items-center">

        Кратко о фильме: {!! nl2br($movie->description) !!}
        </h5>
        <h5 class="d-flex align-items-center">
            В фильме снимались:
            @foreach($movie->actors as $actor)
                <div class="ml-2">
                    <a class="badge badge-dark" href="{{ route('actors.show', $actor) }}"> {{ $actor->name }}</a>
                </div>
            @endforeach
        </h5>
    </div>

    <hr style="border-style: dashed;">


    <div class="d-flex justify-content-start">

        @auth
            <form action="{{ route('movie_likes.toggle', $movie) }}" method="post">
                @csrf @method('put')
                <button class="btn @if($movie->isLikedBy(auth()->user())) btn-danger @else btn-secondary @endif">
                    {{ $movie->movie_likes()->count() }} лайков
                </button>
            </form>
        @else
            <div>
                {{ $movie->movie_likes()->count() }} лайков
            </div>
        @endauth
    </div>

    <div class="mt-5">
        <h1 class="h3">Комментировать фильм</h1>
        <form action="{{route('movie_comment.create', $movie)}}" method="post" class="card card-body">
            @csrf
            <div class="form-group">
                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror " placeholder="Напишите комментарий..."></textarea>
                @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button class="btn btn-success">Подтвердить</button>
        </form>

    </div>

    <div class="mt-5">
        <h1 class="h3">Все комментарии под фильмом <b>"{{$movie->name}}"</b></h1>
        @foreach($movie->movie_comments as $movie_comment)
            <div class="card card-body lead">
                {!!   nl2br($movie_comment->content) !!}
            </div>
            <div class="mb-2 text-muted d-flex">
                <div>
                    Автор комментария: {{$movie_comment->user->name}}
                </div>
                <div class="ml-auto">
                    {{$movie_comment->created_at->diffForHumans()}}
                </div>

                @if(auth()->user() == $movie_comment->user)
                    <form class="ml-5" action="{{ route('movie_comment.delete', $movie_comment) }}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-danger">
                            Удалить
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endsection
