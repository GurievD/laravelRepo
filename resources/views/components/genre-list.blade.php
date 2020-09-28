<div class="card">

    <div class="list-group list-group-flush">

        @foreach($genres as $genre)

            <a href="{{ route('genre.movies', $genre) }}" class="list-group-item list-group-item-action">
                {{ $genre->name }}
            </a>

        @endforeach

    </div>

</div>
