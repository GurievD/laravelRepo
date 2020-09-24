@if($movies->isNotEmpty())

    @foreach($movies->reverse() as $movie)
        @include('components.movie-card')
    @endforeach

    {{ $movies->links() }}

@else
    <div class="alert alert-secondary">
        Фильмы отсутствуют в списке!
    </div>
@endif
