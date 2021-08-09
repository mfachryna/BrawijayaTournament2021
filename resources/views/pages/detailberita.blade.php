@extends('layouts.frontend')

@push('style')
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/style/style.css')}}">
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/mystyle.css')}}">
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/style/style2.css')}}">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,700&display=swap"
    rel="stylesheet">
<style>
    .image__ {
        width: 80vw;
        display: block;
        margin: 19px auto;
    }

    .embed__ {
        width: 80%;
        display: block;
        margin: 18px auto;
        height: 516px;
    }
</style>
@endpush

@section('title')
Detail Berita
@endsection

@section('content')

<div class="main penjelasan container col-lg-12">
    <h2 style="text-align: center; margin-top: 30px; margin-bottom: 20px;">{{$items->title}}</h2>

    <img src="{{$items->thumbnail}}" class="img-fluid container mx-auto d-block " alt="Responsive image">

</div>

<div class="container ">
    @foreach (json_decode($items->content, true)['blocks'] as $block)

    @switch($block['type'])
    @case('paragraph')
    <p>{!!$block['data']['text']!!}</p>
    @break
    @case('header')
    <h3>{!!$block['data']['text']!!}</h3>
    @break
    @case('image')
    <img src="{{$block['data']['file']['url']}}" class="image__" alt="" srcset="">
    @break
    @case('list')
    @if ($block['data']['style'] == 'unordered')
    <ul>
        @foreach ($block['data']['items'] as $list)
        <li>{!!$list!!}</li>
        @endforeach
    </ul>
    @else
    <ol>
        @foreach ($block['data']['items'] as $list)
        <li>{!!$list!!}</li>
        @endforeach
    </ol>
    @endif
    @break
    @case('embed')
    <iframe src="{{$block['data']['embed']}}" frameborder="0" class="embed__"></iframe>
    @break
    @default

    @endswitch


    @endforeach


</div>
@endsection

@push('script')
<script src="{{url('/frontend/homepage/bootstrap/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="{{url('/frontend/homepage/bootstrap/js/bootstrap.js')}}"></script>
@endpush
