@if($genres->isNotEmpty())
    <div class="row">
        @foreach($genres as $genre)
            <div class="col-md-3">
                <div class="card card-body">
                    <div class="mb-3">
                        {{ $genre->genre_name }}
                    </div>

                    <div class="d-flex align-items-center justify-content-end">
                        @can('update', $genre)
                            <a href="{{ route('genres.edit', $genre) }}" class="mt-5 btn btn-warning btn-sm">Редактировать жанр</a>
                        @endcan

                        @can('delete', $genre)
                            <form action="{{ route('genres.destroy', $genre) }}" method="post">

                                @csrf @method('delete')
                                <button class="mt-5 btn btn-danger btn-sm">Удалить жанр</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach

        {{ $genres->links() }}
    </div>
@else
    <div class="alert alert-secondary">
        Жанры отсутствуют в списке!
    </div>
@endif
