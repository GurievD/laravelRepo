<?php
$actor = $actor ?? null;
?>

@extends('layouts.app')

@section('content')

    <div class="h3">
        {{ $actor ? 'Изменить данные актёра' : 'Добавить нового актёра' }}
    </div>

    <div class="row">
        <div class="col-md-5">
            <form action="{{ $actor ? route('actors.update', $actor) : route('actors.store') }}" class="card card-body" method="post" enctype="multipart/form-data">
                @csrf

                @if($actor)
                    @method('put')
                @endif

                <div class="form-group">
                    <label for="actor_name">Имя актёра</label>

                    <input type="text" id="actor_name" name="actor_name"
                           class="form-control @error('actor_name') is-invalid @enderror"
                           placeholder="Введите имя..." value="{{ old('actor_name', $actor->actor_name ?? null)  }}">

                    @error('actor_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="birth_date">Дата рождения актёра</label>

                    <input class="form-control"
                           type="date"
                           name="birth_date" id="birth_date" placeholder="Введите дату..."
                           value="{{ old('birth_date', $actor->birth_date ?? null) }}">
                </div>

                <div class="form-group">
                    <label for="image">Изображение</label>

                    <div class="custom-file is-invalid">
                        <input type="file"
                               accept=".jpg,.png,.bmp,.jpeg,.gif,.webp"
                               class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">

                        <label class="custom-file-label" for="image">Выберите изображение...</label>

                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-primary">{{ $actor ? 'Обновить' : 'Добавить' }}</button>

            </form>
        </div>
    </div>

@endsection
