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
            Актёры
        </h1>

        @if($admin)
            <a href="{{ route('actors.create') }}" class="ml-auto btn btn-success">
                Добавить нового актёра
            </a>
        @endif

    </div>

    <div class="row">

        <div class="col-md-9">

            @if($actors->isNotEmpty())

                @foreach($actors as $actor)
                    @include('components.actor-card')
                @endforeach


            @else
                <div class="alert alert-secondary">
                    Актёры отсутствуют в списке!
                </div>
            @endif

        </div>

        <div class="col-md-3">
            <div class="mb-3">

            </div>
        </div>

    </div>

@endsection
