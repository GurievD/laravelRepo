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


    @if ($post->image_path)
        <img class="img-fluid" src="{{ \Illuminate\Support\Facades\Storage::url($post->image_path) }}" alt="{{ $post->title }}">
        <hr style="border-style: dashed;" />
    @endif

    <div class="mb-3 text-muted d-flex align-items-center">

        <div class="badge badge-secondary mr-3">
            {{ $post->category->name }}
        </div>

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

    <hr style="border-style: dashed;" />

    <div class="d-flex justify-content-end">

        @auth
            <form action="{{ route('likes.toggle', $post) }}" method="post">
                @csrf @method('put')
                <button class="btn @if($post->isLikedBy(auth()->user())) btn-danger @else btn-secondary @endif">
                    {{ $post->likes()->count() }} лайков
                </button>
            </form>
        @else
            <div>
                {{ $post->likes()->count() }} лайков
            </div>
        @endauth

    </div>

    <div class="mt-5">
        <h1 class="h3">Все комментарии под постом №{{$post->id}}</h1>
        @foreach($post->post_comments as $comment)
            <div class="card card-body lead">
                {!!   nl2br($comment->content) !!}
            </div>
            <div class="mb-2 text-muted d-flex">
                <div>
                    Автор комментария: {{$comment->user->name}}
                </div>
                <div class="ml-auto">
                    {{$comment->created_at->diffForHumans()}}
                </div>

                @if(auth()->user() == $comment->user)
                    <form class="ml-5" action="{{ route('comment.delete', $comment) }}" method="post">
                        @csrf
                        <button class="btn btn-sm btn-danger">
                            Удалить
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-5">
        <h1 class="h3">Комментировать пост</h1>
        <form action="{{route('comment.create', $post)}}" method="post" class="card card-body">
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

@endsection
