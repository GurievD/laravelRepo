@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center mb-3">

        <h1 class="h3 mb-0">
            Посты
        </h1>

        @can('create', App\Models\Post::class)
            <a href="{{ route('posts.create') }}" class="ml-auto btn btn-success">
                Добавить пост
            </a>
        @endcan

    </div>

    <div class="row">

        <div class="col-md-9">

            @if($posts->isNotEmpty())

                @foreach($posts as $post)
                    <div class="card card-body mb-3">

                        <a href="{{ route('posts.show', $post) }}">
                            <h2 class="h5 mb-3">{{ $post->title }}</h2>
                        </a>



                    @if($post->image_path)
                            <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}" class="img-fluid my-3 rounded">
                        @else
                            <hr style="border-style: dashed;" />
                        @endif

                        <div class="text-muted d-flex align-items-center">
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

                        <hr style="border-style: dashed;" />

                        <p class="mb-0">{{ \Illuminate\Support\Str::words($post->content, 22) }}</p>

                        <div class="d-flex align-items-center justify-content-end">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post) }}" class="mt-3 btn btn-warning btn-sm">
                                    Редактировать
                                </a>
                            @endcan
                            @can('delete', $post)
                                <form action="{{ route('posts.destroy', $post) }}" method="post">
                                    @csrf @method('delete')
                                    <button class="ml-2 mt-3 btn btn-danger btn-sm">
                                        Удалить
                                    </button>
                                </form>
                            @endcan
                        </div>

                    </div>
                @endforeach

                {{ $posts->links() }}

            @else
                <div class="alert alert-secondary">
                    Постов нет :(
                </div>
            @endif

        </div>

        <div class="col-md-3">

        </div>

    </div>

@endsection
