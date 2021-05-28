<html>
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>SIWASIN - Setjen Wantannas</title>

        <meta name="description" content="SIAPI - Setjen Wantannas">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <meta property="og:title" content="SIAPI - Setjen Wantannas">
        <meta property="og:site_name" content="SIAPI">
        <meta property="og:description" content="SIAPI - Setjen Wantannas">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{url('/')}}">
        <meta property="og:image" content="{{asset('/media/favicons/Dekena.png')}}">

        <link rel="shortcut icon" href="{{asset('/media/favicons/Dekena.png')}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{asset('/media/favicons/Dekena.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/media/favicons/Dekena.png')}}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" id="css-main" href="{{asset('/css/oneui.min.css')}}">
        <link rel="stylesheet" id="css-main" href="{{asset('/css/custom.css')}}">

        @yield('style')

</head>
<body>
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">   
            @include('layouts.aside')
            @include('layouts.sidebar')
            @include('layouts.header')

        <main id="main-container">
            @yield('content')
        </main>

        @guest
        @else
            @include('layouts.footer')
            @include('layouts.modal')
        @endguest
    </div>
    @include('layouts.script')
    @yield('script')
</body>
</html>
