<?php
$movie = $movie ?? null;
?>

@extends('layouts.app')

@section('content')

    <div class="h3">
        {{ $movie ? 'Изменить данные фильма' : 'Новый фильм' }}
    </div>

    <div class="row">
        <div class="col-mb-4">
            <form action="{{ $movie ? route('movies.update', $movie) : route('movies.store') }}"
                  class="card card-body" method="post" enctype="multipart/form-data">
                @csrf
                @if($movie) @method('put') @endif
                <div class="form-group">
                    <label for="name">Название фильма</label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Введите название фильма..." value="{{ old('name', $movie->name ?? null)  }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="release_date">Дата релиза</label>
                    <input type="number" id="release_date" name="release_date"
                           class="form-control @error('release_date') is-invalid @enderror"
                           placeholder="Введите дату релиза..." value="{{ old('release_date', $movie->release_date ?? null)  }}">
                    @error('release_date')
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
                    <label for="mydiv"> Выберите актеров, сыгравших в фильме: </label>
                    @foreach($actors as $actor)
                        <div id="mydiv">
                            <input id="actor-{{ $actor->id }}" name="actors[]" type="checkbox" value="{{ $actor->id }}">
                            <label for="actor-{{ $actor->id }}">{{ $actor->name }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="description">О фильме</label>
                    <textarea class="form-control"
                              name="description"
                              id="description"
                              rows="10"
                              placeholder="Введите описание фильма...">{{ old('description', $movie->description ?? null) }}</textarea>
                    @error('description')
                    <div>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button class="btn btn-success">{{ $movie ? 'Обновить' : 'Добавить' }}</button>

            </form>
        </div>
    </div>

@endsection
