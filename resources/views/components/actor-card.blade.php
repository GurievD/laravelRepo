
<div class="card card-body mb-3">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('actors.show', $actor) }}">
            <h2 class="h5 mb-0">{{ $actor->name }}</h2>
        </a>

        <div class="d-flex align-items-center justify-content-end">
            @if($admin)
                <a href="{{ route('actors.edit', $actor) }}" class="mt-3 btn btn-warning btn-sm">
                    Редактировать
                </a>
                <form action="{{ route('actors.destroy', $actor) }}" method="post">
                    @csrf @method('delete')
                    <button class="ml-2 mt-3 btn btn-danger btn-sm">
                        Удалить
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if($actor->image_path)
        <img src="{{ Storage::url($actor->image_path) }}" alt="{{ $actor->name }}" class="img-fluid my-3 rounded">
    @else
        <img src="https://diesel.tigmig.ru/image/cache/no-image-900x.jpg" alt="no_image">
    @endif

    <div class="text-muted d-flex align-items-center">
        <div class="ml-auto">

        </div>
    </div>

    <hr style="border-style: dashed;" />
    @if ($movies->isNotEmpty())
    <h4 class="mb-0">
        Снимался в
        @foreach($actor->movies()->paginate(20) as $movie)
            <a class="badge badge-dark" href="{{ route('movies.show', $movie) }}">{{ $movie->name }}</a>
        @endforeach
    </h4>
    @endif

    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('actors.show', $actor) }}">
            Подробнее...
        </a>
    </div>

</div>

