@extends('layouts.frontend')

@push('style')
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/style/style.css')}}">
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/mystyle.css')}}">
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/style/style2.css')}}">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,700&display=swap"
    rel="stylesheet">
@endpush

@section('title')
Jadwal
@endsection

@section('content')
<div class="main">
    <div class="container">
        <h1 class="judul main-head">COMING<a style="color: #E93DE4;">SOON</a></h1>
    </div>

    {{--
    <div class="container">
        <table width="100%" class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th style="width:46%" align="center">Judul</th>
                    <th style="width:20%" align="center">Lomba</th>
                    <th align="center">Tanggal</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($jadwal as $item)
                <tr>
                    <td>{{$item->judul}}</td>
    <td>
        @if ($item->lomba == 'catur')
        Catur
        @elseif($item->lomba == 'padus')
        Paduan Suara
        @elseif($item->lomba == 'pubg')
        PUBG
        @elseif($item->lomba == 'ml')
        Mobile Legends
        @elseif($item->lomba == 'sinematografi')
        Sinematografi
        @else
        Semua Lomba
        @endif
    </td>
    <td>{{$item->tanggal}}</td>
    </tr>
    @endforeach

    </tbody>
    </table>
</div>
--}}
</div>

@endsection
@push('script')
<script src="{{url('/frontend/homepage/bootstrap/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="{{url('/frontend/homepage/bootstrap/js/bootstrap.js')}}"></script>
@endpush
