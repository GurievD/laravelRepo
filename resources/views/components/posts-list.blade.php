@if($posts->isNotEmpty())

    @foreach($posts as $post)
        @include('components.post-card')
    @endforeach

@else
    <div class="alert alert-secondary">
        Постов нет :(
    </div>
@endif
