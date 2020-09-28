<div class="card">

    <div class="list-group list-group-flush">

        @foreach($actors as $actor)

            <a href="{{ route('actor.movies', $actor) }}" class="list-group-item list-group-item-action">
                {{ $actor->name }}
            </a>

        @endforeach

    </div>

</div>
