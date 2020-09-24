<?php
if(isset(config('app.admins')[auth()->user()->id])) {
    if(config('app.admins')[auth()->user()->id] == auth()->user()->email) {
        $isAdmin = true;
    }
}
$isAdmin = $isAdmin ?? null;
?>

@extends('layouts.app')

@section('content')

<div class="d-flex align-items-center mb-3">

    <h1 class="h3 mb-0">
        Фильмы с жанром {{ $genre->name }}
    </h1>

</div>

<div class="row">

    <div class="col-md-9">
        @include('components.movies-list')
    </div>

    <div class="col-md-3">

    </div>

</div>

@endsection
