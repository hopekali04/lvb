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

    <title>Love Builds</title>
        <!--Social Media Display-->
        <meta property="og:title" content=""/>
        <meta property="og:description" content=""/>
        <meta property="og:type" content="website" />
        <meta property="og:url" content=""/>
        <meta property="og:image" content=""/>
        <meta property="og:image:secure_url" content=""/>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet"/>
        <!-- Font Awesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>


    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('dist/assets/custom.css') }}">
    @vite(['resources/sass/custom.scss', 'resources/js/app.js'])
</head>
<style>
    ul>li>a:hover {
  background-color: rgba(251, 213, 26, 0.763);
}
</style>
<body>
    <!--  
    <div id="app">
        <div class="banner" style="background-image: url('{{ asset('img/home/woman.jpg') }}'); position: absolute; 
        width: 100vw; height:30vh;
        ">
            <div class="overlay">
                <div class="container banner-content">
                    <h1 class="fw-bold" style="padding-top: 10vh">hello</h1>
                    <p> workd</p>
                </div>
                <lord-icon
                    src="https://cdn.lordicon.com/xcrjfuzb.json"
                    trigger="loop"
                    delay="1500"
                    colors="primary:#ffffff"
                    style="width:50px;height:50px">
                </lord-icon>
            </div>
        </div>
    -->
    <header class="mb-1 w-100">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" style="font-family: 'Aspira', sans-serif; font-size: 1rem;">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="{{ asset('img/logo.svg') }}" alt="Brand Logo" width="100" height="100">
                </a>
                <a class="navbar-brand" href="/">Love Builds Apparel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav text-center mx-auto">
                        <li class="nav-item">
                            <a class="nav-link px-2 text-white" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2 text-white" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2 text-white" href="/shop">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2 text-white" href="/contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2 text-white" href="/faq">FAQ</a>
                        </li>
                    </ul>
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <div class="mb-2 mb-md-0 me-md-3">
                            <a type="button" class="btn btn-floating btn-lg" href="https://web.facebook.com/yohanebandafoundation/?_rdc=3&_rdr" target="_blank">
                                <img src="{{ asset('img/facebook.png') }}" alt="Ig Icon" style="height: 30px; width:30px;">
                            </a>
                            <a type="button" class="btn btn-floating btn-lg" href="https://twitter.com/YohaneBandaFou1" target="_blank">
                                <img src="{{ asset('img/twitter.png') }}" alt="Ig Icon" style="height: 30px; width:30px;">
                            </a>
                            <a type="button" class="btn btn-floating btn-lg" href="https://www.instagram.com/lovebuildsapparel/" target="_blank">
                                <img src="{{ asset('img/insta.png') }}" alt="Ig Icon" style="height: 30px; width:30px;">
                            </a>
                            <a type="button" class="btn btn-floating btn-lg" href="https://www.youtube.com/channel/UCy1rvIqAwo81NrLsay8c24Q" target="_blank">
                                <img src="{{ asset('img/tik-tok.png') }}" alt="Ig Icon" style="height: 30px; width:30px;">
                        </a>
                        </div>
                        <form class="d-flex" action="/cart" method="get">
                            <button class="btn" style="background-color: #D27F2D; border-radius: 5em; margin-top: 20px;" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Cart
                                <span class="badge bg-dark text-white ms-1 rounded-pill">
                                    {{ Session::get('totalItems', 0) }}
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>    
    </div>
    <div class="py-4">
        @yield('content')
    </div>
    @include('layouts.partials.footer')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
