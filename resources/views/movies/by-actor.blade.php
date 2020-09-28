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
            Фильмы, в которых снимался {{ $actor->name }}
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
