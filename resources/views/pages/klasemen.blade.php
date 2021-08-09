@extends('layouts.frontend')

@push('style')
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/style/style.css')}}">
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/mystyle.css')}}">
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/style/style2.css')}}">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,700&display=swap"
    rel="stylesheet">
<style>
    .main {
        border-bottom: 5px solid #791cd5;
        padding-top: 1.5%;
        padding-bottom: 1.5%;
        padding-left: 5%;
        background: linear-gradient(-20deg, #ae3475 -95%, #1b073a 80%);
        color: white;
    }
</style>
@endpush

@section('title')
Klasemen
@endsection

@section('content')

<div class="main">
    <div class="container">
        <h2 class="judul main-head">Klasemen</h2>
    </div>




</div>


<section>
    <div class="container col-md-8 section_padding_100 mb-5">
        <section class="mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Rank</th>

                        <th scope="col">Universitas</th>
                        <th scope="col">Team</th>
                        <th scope="col"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trophy-fill"
                                fill="currentColor" style="color: #FFDF00" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z" />
                            </svg></th>
                        <th scope="col"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trophy-fill"
                                fill="currentColor" style="color: #D3D3D3" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z" />
                            </svg></th>
                        <th scope="col"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trophy-fill"
                                fill="currentColor" style="color: #CD7F32" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z" />
                            </svg></th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                    <tr>
                        <td>{{$item->rank}}</td>
                        <td>{{$item->university}}</td>
                        <td>{{$item->Team}}</td>
                        <td>{{$item->gold}}</td>
                        <td>{{$item->silver}}</td>
                        <td>{{$item->bronze}}</td>
                        <td>{{$item->gold + $item->silver + $item->bronze}}</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" align="center">Coming Soon</td>
                    </tr>
                    @endforelse



                </tbody>
            </table>
        </section>
    </div>
</section>
@endsection
@push('script')
<script src="{{url('/frontend/homepage/bootstrap/jquery/jquery-3.5.1.min.js')}}"></script>
<script src="{{url('/frontend/homepage/bootstrap/js/bootstrap.js')}}"></script>
@endpush
