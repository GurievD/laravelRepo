@if($actors->isNotEmpty())

    @foreach($actors as $actor)
        @include('components.actor-card')
    @endforeach

    {{ $actors->links() }}

@else
    <div class="alert alert-secondary">
        Актёры отсутствуют в списке!
    </div>
@endif
