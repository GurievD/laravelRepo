<div class="card card-body mb-3">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('movies.show', $movie) }}">
            <h2 class="h5 mb-0">{{ $movie->name }}</h2>
        </a>

        <div class="d-flex align-items-center justify-content-end">
            @if($admin)
                <a href="{{ route('movies.edit', $movie) }}" class="mt-3 btn btn-warning btn-sm">
                    Редактировать
                </a>
                <form action="{{ route('movies.destroy', $movie) }}" method="post">
                    @csrf @method('delete')
                    <button class="ml-2 mt-3 btn btn-danger btn-sm">
                        Удалить
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if($movie->image_path)
        <img src="{{ Storage::url($movie->image_path) }}" alt="{{ $movie->title }}" class="img-fluid my-3 rounded">
    @else
        <img src="https://diesel.tigmig.ru/image/cache/no-image-900x.jpg" alt="no_image">
    @endif

    <p class="mb-0 lead">
        {{ Str::words($movie->description, 22) }}
    </p>

    <hr style="border-style: dashed;" />


    <div class="text-muted d-flex align-items-center">
        <a href="{{ route('genre.movies', $movie->genre) }}" class="badge badge-secondary mr-3">
            <h5 class="mb-0">
            Жанр: {{ $movie->genre->name }}, Дата релиза: {{ $movie->release_date }}
            </h5>
        </a>

    </div>

    <hr style="border-style: dashed;" />

    <h4 class="mb-0">
        В фильме снимались:
        @foreach($movie->actors as $actor)
            <a class="badge badge-dark" href="{{ route('actors.show', $actor) }}"> {{ $actor->name }}</a>
        @endforeach
    </h4>

    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('movies.show', $movie) }}">
            Подробнее...
        </a>
    </div>

</div>
