<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Social Media Display -->
    <meta property="og:title" content="Love Builds"/>
    <meta property="og:description" content=""/>
    <meta property="og:type" content="website" />
    <meta property="og:url" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:image:secure_url" content=""/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="css/styles.css" rel="stylesheet"/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('dist/assets/custom.css') }}">
    @vite(['resources/sass/custom.scss', 'resources/js/app.js'])
</head>
<style>
    ul > li > a:hover {
        background-color: rgba(251, 213, 26, 0.763);
    }
    .nav-link, .fab {
        color: white;
    }
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="color: #FBD41A; height: 13vh; font-family: 'Aspira', sans-serif; font-size: 1rem;">
            <div class="container px-5">
                <a href="/" class="navbar-brand">
                    <img src="{{ asset('img/logo.svg') }}" alt="Brand Logo" width="100" height="100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav text-center">
                            <li class="nav-item">
                                <a class="nav-link px-2" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2" href="/about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2" href="/shop">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2" href="/contact">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2" href="/faq">FAQ</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <a type="button" class="btn btn-floating btn-lg" href="https://web.facebook.com/yohanebandafoundation/?_rdc=3&_rdr" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a type="button" class="btn btn-floating btn-lg" href="https://twitter.com/YohaneBandaFou1" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a type="button" class="btn btn-floating btn-lg" href="https://www.instagram.com/lovebuildsapparel/" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a type="button" class="btn btn-floating btn-lg" href="https://www.youtube.com/channel/UCy1rvIqAwo81NrLsay8c24Q" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <button class="btn btn-outline-dark" style="background-color: #D27F2D; border-radius: 5em;" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">
                                {{ Session::get('totalItems', 0) }}
                            </span>
                        </button>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="py-4">
            @yield('content')
        </div>
        @include('layouts.partials.footer')
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
