<?php
$admin = $admin ?? null;
?>

@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center mb-5">

        <h1 class="h3 mb-3">
            Список актёров
        </h1>

        @if($admin)
            <a href="{{ route('actors.create') }}" class="ml-auto btn btn-info">
                Добавить нового актёра
            </a>
        @endif

    </div>

    <div class="row">
        <div class="col-md-5">
            @include('components.actors-list')
        </div>
    </div>

@endsection
