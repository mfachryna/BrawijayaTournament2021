@extends('layouts.frontend')

@push('style')
<script src="https://kit.fontawesome.com/c2b9b7aca3.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link rel="stylesheet" href="{{url('/frontend/about/bootstrap/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{url('/frontend/galeri/style/style.css')}}">

{{-- <link rel="stylesheet" href="{{url('/frontend/about/style/style.css')}}"> --}}
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,700&display=swap"
    rel="stylesheet">
<style>
    .nav-item {
        font-size: 89%;
    }
</style>
@endpush

@section('title')
Tentang Kami
@endsection

@section('content')

<div class="main penjelasan">
    {{-- <img src="{{url('/frontend/about/Image/Asset%201@4x.png')}}" alt="" class="logo"> --}}
    <h2 class="judul main-head"><span>TENTANG</span><br>BRAWIJAYA TOURNAMENT</h2>
    <div class="row row1">
        <div class="col-3">
            <img src="{{url('/frontend/about/Image/Asset%202@4x%20(2).png')}}" alt="logo" class="gambar">

        </div>
        <div class="col-9 bagian2">
            <div class="garis1 ">
                <p class="font-weight-normal deskripsi">BRAWIJAYA TOURNAMENT merupakan acara kegiatan yang berkolaborasi
                    dengan unit kegiatan mahasiswa Universitas BRAWIJAYA yang terdiri dari beberapa rangkaian kompetisi
                    perlombaan dalam bidang olah raga dan seni.

                    BRAWIJAYA TOURNAMENT ini merupakan kegiatan perlombaan
                    yang dilakukan antar mahasiswa tingkat nasional se-Jawa Bali.</p>
            </div>

        </div>

    </div>

</div>



@endsection

@push('script')
<script src="{{url('/frontend/homepage/bootstrap/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="{{url('/frontend/homepage/bootstrap/js/bootstrap.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script>
    $('.carousel').carousel({
      interval: 5000
    })
</script>
@endpush
