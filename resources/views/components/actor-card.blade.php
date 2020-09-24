<div class="card card-body mb-5">

    <div class="d-flex align-items-center justify-content-start">
        <a href="{{ route('actors.show', $actor) }}">
            <h2 class="h5 mb-3">{{ $actor->actor_name }}</h2>
        </a>

        <div class="d-flex align-items-center justify-content-end">
            @if($admin)
                <a href="{{ route('actors.edit', $actor) }}" class="mt-5 btn btn-warning btn-sm">
                    Редактировать актёра
                </a>

                <form action="{{ route('actors.destroy', $actor) }}" method="post">
                    @csrf @method('delete')
                    <button class="ml-4 mt-5 btn btn-danger btn-sm">
                        Удалить актёра
                    </button>
                </form>
            @endif
        </div>
    </div>



    @if($actor->image_path)
        <img src="{{ \Illuminate\Support\Facades\Storage::url($actor->image_path) }}" alt="{{ $actor->actor_name }}" class="img-fluid my-5 rounded">
    @else
        <hr style="border-style: dashed;" />
    @endif


    <hr style="border-style: dashed;" />

    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('actors.show', $actor) }}">
            Подробнее...
        </a>
    </div>

</div>
