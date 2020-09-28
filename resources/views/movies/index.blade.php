<?php
use Illuminate\Support\Facades\Auth;
$admin = $admin ?? null;
?>

@auth
    <?php
    if(isset(config('admin.admin_list')[Auth::user()->id])) {
        if(config('admin.admin_list')[Auth::user()->id] == Auth::user()->email) {
            $admin = true;
        }
    }
    ?>
@endauth

@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center mb-3">

        <h1 class="h3 mb-0">
            Фильмы
        </h1>

        @if($admin)
            <a href="{{ route('movies.create') }}" class="ml-auto btn btn-success">
                Добавить новый фильм
            </a>
        @endif

    </div>


    <div class="row">
        <div class="col-md-9">
            @include('components.movies-list')
        </div>

        <div class="col-md-3">
            <div class="mb-3">
                <strong class="mb-2 d-block">
                    По жанрам
                </strong>

                @include('components.genre-list')
            </div>

            <div class="mb-3">
                <strong class="mb-2 d-block">
                    По актёрам
                </strong>

                @include('components.actors-list')
            </div>
        </div>
    </div>
@endsection
