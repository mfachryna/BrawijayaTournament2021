<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin-{{ config('app.name', 'Admin') }}</title>
    <link rel="shortcut icon" href="{{url('/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{url('/favicon.ico')}}" type="image/x-icon">
    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" class="admin" name="{{Auth::user()->name}}" email="{{Auth::user()->email}}">
        <admin></admin>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Hotjar Tracking Code for www.bt.muhajir.id -->
    {{-- <script>
        (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1984311,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script> --}}
</body>

</html>
