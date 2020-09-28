<?php
$actor = $actor ?? null;
?>

@extends('layouts.app')

@section('content')

    <div class="h3">
        {{ $actor ? 'Изменить данные актёра' : 'Новый актёр' }}
    </div>

    <div class="row">
        <div class="col-mb-4">
            <form action="{{ $actor ? route('actors.update', $actor) : route('actors.store') }}"
                  class="card card-body" method="post" enctype="multipart/form-data">
                @csrf
                @if($actor) @method('put') @endif
                <div class="form-group">
                    <label for="name">Имя актёра</label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Введите имя актёра..." value="{{ old('name', $actor->name ?? null)  }}">
                    @error('name')
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

                <button class="btn btn-success">{{ $actor ? 'Обновить' : 'Добавить' }}</button>

            </form>
        </div>
    </div>

@endsection
