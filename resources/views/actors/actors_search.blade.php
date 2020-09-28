<?php
use App\Models\Genre;use App\Models\Movie;use Illuminate\Support\Facades\Auth;

$actors = $actors ?? null;
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
    @foreach($actors as $actor)
        <div class="row">
            <div class="col-md-9">

                <div class="card card-body mb-3">

                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ url('actors/' . $actor->id) }}">
                            <h2 class="h5 mb-0">{{ $actor->name }}</h2>
                        </a>
                        <div class="d-flex align-items-center justify-content-end">
                            @if($admin)
                                <a href="{{ url('actors/' . $actor->id .  '/edit') }}" class="mt-3 btn btn-warning btn-sm">
                                    Редактировать
                                </a>
                                <form action="{{ url('actors/' . $actor->id) }}" method="post">
                                    @csrf @method('delete')
                                    <button class="ml-2 mt-3 btn btn-danger btn-sm">
                                        Удалить
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    @if($actor->image_path)
                        <img src="{{ Storage::url($actor->image_path) }}" alt="alt" class="img-fluid my-3 rounded">
                    @else
                        <img src="https://diesel.tigmig.ru/image/cache/no-image-900x.jpg" alt="no_image">
                    @endif

                    <hr style="border-style: dashed;" />


                    <div class="text-right">
                        <a class="btn btn-primary" href="{{ url('actors/' . $actor->id) }}">
                            Подробнее...
                        </a>
                    </div>

                </div>

            </div>
        </div>
    @endforeach
@endsection
