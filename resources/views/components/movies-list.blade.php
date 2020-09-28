@if($movies->isNotEmpty())

    @foreach($movies as $movie)
        @include('components.movie-card')
    @endforeach



@else
    <div class="alert alert-secondary">
        Фильмы отсутствуют в списке!
    </div>
@endif

