@extends('layouts.frontend')

@push('style')
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/style/style.css')}}">
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/mystyle.css')}}">
<link rel="stylesheet" href="{{url('/frontend/jadwal_lomba/style/style2.css')}}">


<link rel="stylesheet" href="{{url('/frontend/berita/css/bootstrap1.css')}}">
<link rel="stylesheet" href="{{url('/frontend/berita/css/style.css')}}">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,700&display=swap"
    rel="stylesheet">
<link href="{{url('/frontend/berita/css/bootstrap.min.css')}}" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{url('/frontend/berita/css/freelancer.css')}}" rel="stylesheet">
<link href="{{url('/frontend/berita/font-awesome-4.1.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

@endpush

@section('title')
Berita
@endsection

@section('content')
<!-- Portfolio Grid Section -->
<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                @if ($news->count())
                <h2>BERITA</h2>
                <hr class="star-primary">
                @else
                <h1 class="judul main-head">COMING<a style="color: #E93DE4;">SOON</a></h1>
                @endif

            </div>
        </div>
        <div class="row">
            @foreach ($news as $item)
            <div class="col-sm-4 portfolio-item">
                <a href="#{{$item->slug}}" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="{{$item->thumbnail}}" class="img-responsive" alt="">
                </a>
            </div>
            @endforeach

        </div>
    </div>
</section>






<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll visible-xs visble-sm">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<!-- Portfolio Modals -->
@foreach ($news as $item)
<div class="portfolio-modal modal fade" id="{{$item->slug}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>{{$item->title}}</h2>
                        <hr class="star-primary">
                        @foreach (json_decode($item->content, true)['blocks'] as $block)

                        @switch($block['type'])
                        @case('paragraph')
                        <p>{!!$block['data']['text']!!}</p>
                        @break
                        @case('header')
                        <h3>{!!$block['data']['text']!!}</h3>
                        @break
                        @case('image')
                        <img src="{{$block['data']['file']['url']}}" class="image__ img-responsive img-centered" alt=""
                            srcset="">
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


                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>
                            Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach



@endsection

@push('script')


<!-- jQuery Version 1.11.0 -->
<script src="{{url('/frontend/berita/js/jquery-1.11.0.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{url('/frontend/berita/js/bootstrap.min.js')}}"></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="{{url('/frontend/berita/js/freelancer.js')}}"></script>
@endpush
