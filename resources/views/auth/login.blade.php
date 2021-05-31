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
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <link rel="shortcut icon" href="https://www.wantannas.go.id/wp-content/uploads/2017/06/Logo-Wantannas-150x150.png">
        <link rel="icon" type="image/png" sizes="192x192" href="https://www.wantannas.go.id/wp-content/uploads/2017/06/Logo-Wantannas.png">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/media/favicons/apple-touch-icon-180x180.png')}}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" id="css-main" href="{{asset('/css/oneui.min.css')}}">
        <link rel="stylesheet" id="css-main" href="{{asset('/css/custom.css')}}">
</head>
<body>
     <div id="page-container">
        <main id="main-container">
            <div class="bg-image" style="background-image: url('{{asset('/media/photos/photo6@2x.jpg')}}');">
            <div class="hero-static bg-white-95">
                <div class="content">
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-lg-6 col-xl-4">
                            <div class="block block-themed block-fx-shadow mb-0">
                                <div class="block-content bg-red rounded" style="background-color: #d10102;">
                                    <div class="p-sm-3 px-lg-4 text-center">
                                        <img alt="Header Avatar" style="width: 100;" class="pb-3" src="{{asset('/media/favicons/Dekena.png')}}" />
                                        <h3 class="mb-2 txt-white text-center">SIWASIN</h3>
                                        <p class="txt-white text-center">Sistem Informasi Pengawasan Internal</p>
                                        @if(\Session::has('alert'))
                                        <div class="alert alert-warning alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{Session::get('alert')}}</strong>
                                        </div>
                                        @endif
                                        <form class="js-validation-signin" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                            <div class="py-3">
                                                <div class="form-group">
                                                    <input type="nip" class="form-control form-control-alt form-control-lg @error('nip') is-invalid @enderror" id="nip" name="nip" placeholder="NIP/NRP" required autocomplete="email" autofocus>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-alt form-control-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="current-password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-xl-5">
                                                    <button type="submit" class="btn btn-block btn-primary bg-white txt-red">
                                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Masuk
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>
</body>
</html>
