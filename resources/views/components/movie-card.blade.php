<div class="card card-body mb-5">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('movies.show', $movie) }}">
            <h2 class="h3 mb-4">{{ $movie->movie_name }}</h2>
        </a>

        <div class="d-flex align-items-center justify-content-end">
            @if($admin)
                <a href="{{ route('movies.edit', $movie) }}" class="mt-5 btn btn-warning btn-sm">
                    Редактировать фильм
                </a>

                <form action="{{ route('movies.destroy', $movie) }}" method="post">
                    @csrf @method('delete')
                    <button class="ml-4 mt-5 btn btn-danger btn-sm">
                        Удалить фильм
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if($movie->image_path)
        <img src="{{ \Illuminate\Support\Facades\Storage::url($movie->image_path) }}" class="img-fluid my-5 rounded">
    @else
        <hr style="border-style: dashed;" />
    @endif

    <div class="text-muted d-flex align-items-center">
        <a href="{{ route('genre.movies', $movie->genre) }}" class="badge badge-secondary mr-5">
            {{ $movie->genre->genre_name }}
        </a>

        <div class="ml-auto">
            {{ $movie->movie_name }}, {{ $movie->release_date }}
        </div>
    </div>

    <hr style="border-style: dashed;" />

    <p class="mb-5">{{ \Illuminate\Support\Str::words($movie->description, 22) }}</p>

    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('movies.show', $movie) }}">
            Подробнее...
        </a>
    </div>

</div>
