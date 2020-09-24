<?php
$movie = $movie ?? null;
?>

@extends('layouts.app')

@section('content')

    <div class="h3">
        {{ $movie ? 'Редактирование фильма' : 'Добавить фильм' }}
    </div>

    <div class="row">
        <div class="col-mb-4">
            <form action="{{ $movie ? route('movies.update', $movie) : route('movies.store') }}"
                  class="card card-body" method="post" enctype="multipart/form-data">
                @csrf
                @if($movie) @method('put') @endif
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Введите название..." value="{{ old('name', $movie->name ?? null)  }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="original_name">Оригинальное название</label>
                    <input type="text" id="original_name" name="original_name"
                           class="form-control @error('original_name') is-invalid @enderror"
                           placeholder="Введите оригинальное название..." value="{{ old('original_name', $movie->original_name ?? null)  }}">
                    @error('original_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Описание фильма</label>
                    <textarea class="form-control"
                              name="description" id="description" rows="10"
                              placeholder="Введите описание фильма...">{{ old('description', $movie->description ?? null) }}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="year">Год</label>
                    <input type="number" id="year" name="year"
                           class="form-control @error('year') is-invalid @enderror"
                           placeholder="Введите год..." value="{{ old('year', $movie->year ?? null)  }}">
                    @error('year')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country_id">Страна</label>
                    <select id="country_id" class="form-control @error('country_id') is-invalid @enderror"
                            name="country_id">
                        @foreach($countries as $country)
                            <option {{ old('country_id', $movie->country_id ?? null) == $country->id ? 'selected' : '' }}
                                    value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="genre_id">Жанр</label>
                    <select id="genre_id" class="form-control @error('genre_id') is-invalid @enderror"
                            name="genre_id">
                        @foreach($genres as $genre)
                            <option {{ old('genre_id', $movie->genre_id ?? null) == $genre->id ? 'selected' : '' }}
                                    value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                    @error('genre_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Изображение</label>
                    <div class="custom-file is-invalid">
                        <input type="file" accept=".jpg,.png,.bmp,.jpeg,.gif,.webp"
                               class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                        <label class="custom-file-label" for="image">Выберите изображение...</label>
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary">{{ $movie ? 'Изменить' : 'Добавить' }}</button>

            </form>
        </div>
    </div>

@endsection
