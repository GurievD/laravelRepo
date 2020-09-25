@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center">
        <p class="h3 mb-5">{{ $actor->name }}</p>

        <div class="ml-auto">
            <div class="d-flex align-items-center justify-content-end">
                    <a href="{{ route('actors.edit', $actor) }}" class="btn btn-warning">Редактировать актёра</a>
                    <form action="{{ route('actors.destroy', $actor) }}" method="post">

                        @csrf @method('delete')
                        <button class="btn btn-danger">Удалить актёра</button>
                    </form>
            </div>
        </div>
    </div>

    <p class="h6">{{ $actor->original_name }}</p>

    <hr style="border-style: dashed;">

    @if($actor->image_path)
        <img src="{{ \Illuminate\Support\Facades\Storage::url($actor->image_path) }}" alt="{{ $actor->name }}">
        <hr style="border-style: dashed;">
    @endif

    <hr style="border-style: dashed;">


    <div class="mb-5 d-flex">
        <div>
            {{ $actor->birth_date }}
        </div>

        <div class="ml-auto">
            {{ $actor->country->name }}
        </div>
    </div>
@endsection
