@extends('layouts.frontend')

@push('style')
<script src="https://kit.fontawesome.com/c2b9b7aca3.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link rel="stylesheet" href="{{url('/frontend/galeri/bootstrap/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{url('/frontend/galeri/style/style.css')}}">
<link rel="stylesheet" href="{{url('/frontend/galeri/style2/style.css')}}">

<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,700&display=swap"
    rel="stylesheet">
@endpush

@section('title')
Galeri
@endsection

@section('content')


<div class="main">
    <div class="container">
        <br>
        <h2 class="judul main-head">AFTER <a style="color: #E93DE4;">EVENT</a></h2>
    </div>
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($galleries as $gallery)
                @if ($loop->first)
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                @else
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}"></li>
                @endif

                @endforeach



            </ol>
            <div class="carousel-inner">

                @foreach ($galleries as $gallery)
                @if ($loop->first)
                <div class="carousel-item active">
                    <img class="d-block w-100" src=" {{$gallery->url}}" alt="First slide">
                </div>
                @else
                <div class="carousel-item">
                    <img class="d-block w-100" src=" {{$gallery->url}}" alt="Second slide">
                </div>
                @endif

                @endforeach

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


</div>




<div class="container-fluid">
    <div class="row" style="padding:0 4%;">


        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center">
            <div class="mt-5">
                <div class="card ytkecil">
                    <div class="embed-responsive embed-responsive-16by9 mt-50">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/aSGFhwyx7oE"
                            allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center">
            <div class="mt-5">
                <div class="card ytkecil">
                    <div class="embed-responsive embed-responsive-16by9 mt-50">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/7G-N36CcfwE"
                            allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center">
            <div class="mt-5">
                <div class="card ytkecil">
                    <div class="embed-responsive embed-responsive-16by9 mt-50">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/UDdr0b11FFI"
                            allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center dekstop">
            <div class="mt-5">
                <div class="card ytkecil">
                    <div class="embed-responsive embed-responsive-16by9 mt-50">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/WCbjSovQn1M"
                            allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center dekstop">
            <div class="mt-5">
                <div class="card ytkecil">
                    <div class="embed-responsive embed-responsive-16by9 mt-50">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zHQH5cF0qZ0"
                            allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 text-center dekstop">
            <div class="mt-5">
                <div class="card ytkecil">
                    <div class="embed-responsive embed-responsive-16by9 mt-50">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/LLWUec9-ArU"
                            allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>









@endsection

@push('script')
<script src="{{url('/frontend/homepage/bootstrap/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="{{url('/frontend/homepage/bootstrap/js/bootstrap.js')}}"></script>
@endpush
