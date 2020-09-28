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
        <p class="h3 mb-0">{{ $actor->name }}</p>

        <div class="ml-auto">
            <div class="d-flex align-items-center justify-content-end">
                @if($admin)
                    <a href="{{ route('actors.edit', $actor) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('actors.destroy', $actor) }}" method="post">
                        @csrf @method('delete')
                        <button class="ml-2 btn btn-danger">Удалить</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <hr style="border-style: dashed;">

    <div>
        <div class="mb-3 d-flex">
            <div>
                @if($actor->image_path)
                    <img src="{{ Storage::url($actor->image_path) }}" alt="{{ $actor->name }}">
                @else
                    <img src="https://diesel.tigmig.ru/image/cache/no-image-900x.jpg" alt="no_image">
                @endif
            </div>
        </div>
    </div>

    <hr style="border-style: dashed;">

    <div class="d-flex justify-content-start">

        @auth
            <form action="{{ route('actor_likes.toggle', $actor) }}" method="post">
                @csrf @method('put')
                <button class="btn @if($actor->isLikedBy(auth()->user())) btn-danger @else btn-secondary @endif">
                    {{ $actor->actor_likes()->count() }} лайков
                </button>
            </form>
        @else
            <div>
                {{ $actor->actor_likes()->count() }} лайков
            </div>
        @endauth

    </div>

    <div class="d-flex justify-content-end">

    </div>

    <div class="mt-5">
        <h1 class="h3">Комментировать актёра</h1>
        <form action="{{route('actor_comment.create', $actor)}}" method="post" class="card card-body">
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
        <h1 class="h3">Все комментарии под актером <b>"{{$actor->name}}"</b></h1>
        @foreach($actor->actor_comments as $actor_comment)
            <div class="card card-body lead">
                {!!   nl2br($actor_comment->content) !!}
            </div>
            <div class="mb-2 text-muted d-flex">
                <div>
                    Автор комментария: {{$actor_comment->user->name}}
                </div>
                <div class="ml-auto">
                    {{$actor_comment->created_at->diffForHumans()}}
                </div>

                @if(auth()->user() == $actor_comment->user)
                    <form class="ml-5" action="{{ route('actor_comment.delete', $actor_comment) }}" method="post">
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
