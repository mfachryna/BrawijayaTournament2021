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
<div class="wrapper">
    <div class="container">
        <h1> JADWAL <span style="color: #ff0000"><span><span style="color: PURPLE"> LOMBA </span></span></span></h1>
    </div>

    {{-- <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Hari Ini
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <button class="dropdown-item" type="button">Action</button>
            <button class="dropdown-item" type="button">Another action</button>
            <button class="dropdown-item" type="button">Something else here</button>
        </div>
    </div>
    <br>
    <table class="table table-hover">
        <THEAD class="thead-dark">
            <TR>
                <TH SCOPE="COL"> </TH>
                <TH SCOPE="COL"> VOLI </TH>
                <TH SCOPE="COL"> </TH>
            </TR>
        </THEAD>

        <TBODY>
            <TR>
                <TD SCOPE"row">LOREM IPSUM <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/bni.png')}}">
    </TD>
    <TD>
        <div class="container">
            <button type="button" class="btn btn-dark"> 09.00 </button>
        </div>
    </TD>
    <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/voli.png')}}">LOREM IPSUM </TD>
    </TR>
    <TR>
        <TD SCOPE"row">LOREM IPSUM <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/bni.png')}}">
        </TD>
        <TD>
            <div class="container">
                <button type="button" class="btn btn-dark"> 09.00 </button>
            </div>
        </TD>
        <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/voli.png')}}">LOREM IPSUM </TD>
    </TR>
    <TR>
        <TD SCOPE"row">LOREM IPSUM <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/bni.png')}}">
        </TD>
        <TD>
            <div class="container">
                <button type="button" class="btn btn-dark"> 09.00 </button>
            </div>
        </TD>
        <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/voli.png')}}">LOREM IPSUM </TD>
    </TR>
    <TR>
        <TD SCOPE"row">LOREM IPSUM <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/bni.png')}}">
        </TD>
        <TD>
            <div class="container">
                <button type="button" class="btn btn-dark"> 09.00 </button>
            </div>
        </TD>
        <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/voli.png')}}">LOREM IPSUM </TD>
    </TR>
    </TBODY>
    <br>
    </table>
    <table class="table table-hover">
        <THEAD class="thead-dark">
            <TR>
                <TH SCOPE="COL"> </TH>
                <TH SCOPE="COL"> BASKETBALL </TH>
                <TH SCOPE="COL"> </TH>
            </TR>
        </THEAD>

        <TBODY>
            <TR>
                <TD SCOPE"row">LOREM IPSUM <img class="card__image"
                        src="{{url('/frontend/jadwal_lomba/tim/shark.png')}}"></TD>
                <TD>
                    <div class="container">
                        <button type="button" class="btn btn-dark"> 09.00 </button>
                    </div>
                </TD>
                <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/eagles.png')}}"> LOREM IPSUM </TD>
            </TR>
            <TR>
                <TD SCOPE"row">LOREM IPSUM <img class="card__image"
                        src="{{url('/frontend/jadwal_lomba/tim/shark.png')}}"></TD>
                <TD>
                    <div class="container">
                        <button type="button" class="btn btn-dark"> 09.00 </button>
                    </div>
                </TD>
                <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/eagles.png')}}"> LOREM IPSUM </TD>
            </TR>
            <TR>
                <TD SCOPE"row">LOREM IPSUM <img class="card__image"
                        src="{{url('/frontend/jadwal_lomba/tim/shark.png')}}"></TD>
                <TD>
                    <div class="container">
                        <button type="button" class="btn btn-dark"> 09.00 </button>
                    </div>
                </TD>
                <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/eagles.png')}}"> LOREM IPSUM </TD>
            </TR>
            <TR>
                <TD SCOPE"row">LOREM IPSUM <img class="card__image"
                        src="{{url('/frontend/jadwal_lomba/tim/shark.png')}}"></TD>
                <TD>
                    <div class="container">
                        <button type="button" class="btn btn-dark"> 09.00 </button>
                    </div>
                </TD>
                <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/eagles.png')}}"> LOREM IPSUM </TD>
            </TR>
        </TBODY>
        <BR>
    </table>
    <table class="table table-hover">
        <THEAD class="thead-dark">
            <TR>
                <TH SCOPE="COL"> </TH>
                <TH SCOPE="COL"> FUTSAL </TH>
                <TH SCOPE="COL"> </TH>
            </TR>
        </THEAD>

        <TBODY>
            <TR>
                <TD SCOPE"row">LOREM IPSUM <img class="card__image"
                        src="{{url('/frontend/jadwal_lomba/tim/dragon.png')}}"></TD>
                <TD>
                    <div class="container">
                        <button type="button" class="btn btn-dark"> 09.00 </button>
                    </div>
                </TD>
                <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/futsal.png')}}">LOREM IPSUM </TD>
            </TR>
            <TR>
                <TD SCOPE"row">LOREM IPSUM <img class="card__image"
                        src="{{url('/frontend/jadwal_lomba/tim/dragon.png')}}"></TD>
                <TD>
                    <div class="container">
                        <button type="button" class="btn btn-dark"> 09.00 </button>
                    </div>
                </TD>
                <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/futsal.png')}}">LOREM IPSUM </TD>
            </TR>
            <TR>
                <TD SCOPE"row">LOREM IPSUM <img class="card__image"
                        src="{{url('/frontend/jadwal_lomba/tim/dragon.png')}}"></TD>
                <TD>
                    <div class="container">
                        <button type="button" class="btn btn-dark"> 09.00 </button>
                    </div>
                </TD>
                <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/futsal.png')}}">LOREM IPSUM </TD>

            </TR>
            <TR>
                <TD SCOPE"row">LOREM IPSUM <img class="card__image"
                        src="{{url('/frontend/jadwal_lomba/tim/dragon.png')}}"></TD>
                <TD>
                    <div class="container">
                        <button type="button" class="btn btn-dark"> 09.00 </button>
                    </div>
                </TD>
                <TD> <img class="card__image" src="{{url('/frontend/jadwal_lomba/tim/futsal.png')}}">LOREM IPSUM </TD>

            </TR>
        </TBODY>
    </table>

    <br>
    <br> --}}

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


    <br>

</div>

@endsection
