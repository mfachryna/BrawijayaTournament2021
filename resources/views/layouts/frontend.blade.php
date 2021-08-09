<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') - {{ config('app.name', '') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('/frontend/homepage/images/Asset 3@4x.png')}}" rel="shortcut icon" />
    <link rel="stylesheet" href="{{url('/frontend/homepage/bootstrap/css/bootstrap.css')}}">

    @stack('style')


    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,700&display=swap"
        rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    @include('includes.navbar')

    @yield('content')

    @include('includes.footer')



    @stack('script')
</body>

</html>
