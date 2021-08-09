@extends('layouts.frontend')

@push('style')
<link rel="stylesheet" href="{{asset('/frontend/homepage/style/style.css')}}">
@endpush

@section('title')
Beranda
@endsection

@section('content')
<header>

    <img src="{{asset('/frontend/homepage/images/logonyarloro@2x.jpg')}}" class="img-fluid" alt="Responsive image">

</header>

<div class="main">
    <div class="container">
        <h2 class="judul main-head">BRAWIJAYA <a style="color: #E93DE4;">TOURNAMENT</a></h2>
    </div>

    <div class="container">
        <section class="isi"></section>
        <div class="media position-relative">
            <img src="{{asset('/frontend/homepage/images/Asset%201@4x.png')}}" class="md-4" alt="..." style="margin-top: -20px;    height: 265px;
                object-fit: cover;">

            <div class="media-body konten" style="height: 260px;
            display: flex;
            flex-direction: column;
            justify-content: center;">

                <p class="font-weight-normal teks ">Brawijaya Tournament merupakan acara kegiatan yang berkolaborasi
                    dengan unit kegiatan mahasiswa Universitas Brawijaya yang terdiri dari beberapa rangkaian kompetisi
                    perlombaan dalam bidang olahraga dan seni. Brawijaya Tournament ini merupakan kegiatan perlombaan
                    yang dilakukan antar mahasiswa tingkat Nasional se Jawa - Bali</p>

            </div>
        </div>
    </div>
    <div class="ourevent">
        <section class="event" id="our">
            <div class="conatiner">
                <div class="row mt-3">
                    <div class="col text-center section-ourevent-heading">
                        <h2 class="head">OUR <a style="color: #E93DE4;">EVENT</a></h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-event-content" id="our-content">
            <div class="section-event-1 row justify-content-center">
                @foreach ($galleries as $gallery)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card-our text-center d-flex flex-column" style="background-image: url('{{$gallery->url}}'); background-size: cover;
                        background-position: center;">
                        {{-- <div class="event-head">Image</div> --}}

                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>

    <section>
        <div class="container daftaran">
            <div class="jumbotron">
                <h1 class="display-4">Pendatran Event</h1>
                <p class="lead">Untuk pendaftaran silahkan klik link dibawah ini </p>
                <hr class="my-4">

                <a class="btn btn-primary btn-lg" href="{{route('register')}}" role="button">DAFTAR</a>
            </div>

        </div>


    </section>


    <section class="stiker" id="gift">
        <div class="container">
            <div class="row mt-3">
                <div class="col text-center section-stiker-heading">
                    <h2 class="stik">OUR<a style="color: #E93DE4;"> STICKER</a></h2>

                </div>
            </div>
    </section>
    <section class="section-stiker-content">
        <div class="section-stiker-1 row justify-content-center">
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="d-flex flex-column">
                    <img src="{{asset('/frontend/homepage/images/phone7.jpg')}}" alt="#" class="phone">
                </div>
            </div>
            <div class="col-sm-3 col-md-4 col-lg-3">
                <button type="button" class="btn tombol" style="color: white;">COMING SOON</button>
            </div>
        </div>
</div>
</section>

</div>

@endsection
