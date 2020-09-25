@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center mb-5">

        <h1 class="h3 mb-3">
            Список актёров
        </h1>

        <a href="{{ route('actors.create') }}" class="ml-auto btn btn-info">
                Добавить нового актёра
        </a>
    </div>

    <div class="row">
        <div class="col-md-5">
            @include('components.actors-list')
        </div>
    </div>

@endsection
