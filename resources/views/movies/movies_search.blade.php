<?php
use App\Models\Genre;use App\Models\Movie;use Illuminate\Support\Facades\Auth;

    $movies = $movies ?? null;
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
    @foreach($movies as $movie)
        <div class="row">
            <div class="col-md-9">
                <div class="card card-body mb-3">

                    <div class="d-flex align-items-center justify-content-between">

                        <a href="{{ url('movies/' . $movie->id) }}">
                            <h2 class="h5 mb-0">{{ $movie->name }}</h2>
                        </a>

                        <div class="d-flex align-items-center justify-content-end">
                            @if($admin)

                            <a href="{{ url('movies/' . $movie->id .  '/edit') }}" class="mt-3 btn btn-warning btn-sm">
                                    Редактировать
                                </a>
                                <form action="{{ url('movies/' . $movie->id) }}" method="post">
                                    @csrf @method('delete')
                                    <button class="ml-2 mt-3 btn btn-danger btn-sm">
                                        Удалить
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    @if($movie->image_path)
                        <img src="{{ Storage::url($movie->image_path) }}" alt="alt" class="img-fluid my-3 rounded">
                    @else
                        <img src="https://diesel.tigmig.ru/image/cache/no-image-900x.jpg" alt="no_image">
                    @endif


                    <p class="mb-0 lead">
                        {{ Str::words($movie->description, 22) }}
                    </p>

                    <hr style="border-style: dashed;" />

                    <div class="text-muted d-flex align-items-center">
                        <a href="{{ url('genres/' . $movie->genre_id . '/movies') }}" class="badge badge-secondary mr-3">
                            <h5 class="mb-0">
                                Дата релиза: {{ $movie->release_date }}
                            </h5>
                        </a>
                    </div>

                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ url('movies/' . $movie->id) }}">
                            Подробнее...
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
