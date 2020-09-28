@extends('layouts.app')

@section('content')

{{--    <div class="d-flex align-items-center mb-3">--}}

{{--        <h1 class="h1 mb-0">--}}
{{--            Лучшая база фильмов!--}}
{{--        </h1>--}}

{{--    </div>--}}

{{--    <div class="row">--}}

{{--        <div class="col-md-9">--}}
{{--            <a class="card card-body mb-3 index-link" href="{{ route('actors.index') }}">--}}
{{--                <div class="h4">--}}
{{--                    К актёрам--}}
{{--                    <div class="mt-4">--}}
{{--                        <img src="https://avatars.mds.yandex.net/get-zen_doc/50509/pub_5e302ac37d508d4055d23e26_5e3199c07065cb58f698b496/scale_1200" style="height: 600px; width: 600px"/>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}

{{--            <a class="card card-body mb-3 index-link" href="{{ route('movies.index') }}">--}}
{{--                <div class="h4">--}}
{{--                    К фильмам--}}

{{--                    <div class="mt-4">--}}
{{--                        <img src="https://clipartion.com/wp-content/uploads/2015/11/film-reel-clipart-free-clip-art-images.jpg" style="height: 600px; width: 600px"/>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="col-md-3">--}}

{{--        </div>--}}

{{--    </div>--}}

<?php
$images = [Storage::url('public/images/1162439.jpg'), Storage::url('public/images/136260.jpg')];
$someVar = "Hello";

?>

<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >

<body id="play">
<div class="slider">
    <div class="slide active mr-1 position-fixed" style="background-image: url('/storage/images/eight.jpg'); width: 1920px; height: 1080px; right: 0.1%;"></div>

    <div class="slide mr-1 position-fixed" style="background-image: url('/storage/images/sonic.jpg'); width: 1920px; height: 1080px; right: 0.1%;"></div>

    <div class="slide mr-1 position-fixed" style="background-image: url('/storage/images/edARj5QbThiHvuXDvHPIi1s08UW.jpg'); width: 1920px; height: 1080px; right: 0.1%;"></div>

</div>

<script type="text/javascript">
    const slides = document.querySelector('.slider').children;
    let index = 0;

    function nextSlide() {
        if (index === slides.length-1) {
            index = 0;
        }
        else {
            index++;
        }
        changeSlide();
    }

    function changeSlide() {
        for(let i = 0; i < slides.length; i++) {
            slides[i].classList.remove("active");
        }

        slides[index].classList.add("active");

    }

    function autoPlay() {
        nextSlide();
    }

    let timer = setInterval(autoPlay, 5000);

</script>

</body>



@endsection
