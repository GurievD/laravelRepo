<?php
$genre = $genre ?? null;
?>

@extends('layouts.app')

@section('content')

    <div class="h3 mb-3">
        {{ $genre ? 'Изменить данные жанра' : 'Добавить новый жанр' }}
    </div>

    <div class="row">
        <div class="col-md-4">

            <form class="card card-body"
                  action="{{ $genre ? route('genres.update', $genre) : route('genres.store') }}"
                  method="post">
                @csrf

                @if($genre)
                    @method('put')
                @endif

                <div class="form-group">
                    <label for="genre_name">Имя жанра</label>

                    <input id="genre_name" name="genre_name" type="text"
                           class="form-control @error('genre_name') is-invalid @enderror"
                           placeholder="Введите имя жанра..." value="{{ old('genre_name', $genre->genre_name ?? null) }}">

                    @error('genre_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button class="btn btn-primary">{{ $genre ? 'Обновить' : 'Добавить' }}</button>
            </form>
        </div>
    </div>

@endsection
