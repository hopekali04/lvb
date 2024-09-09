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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    ul>li>a:hover {
  background-color: rgba(251, 213, 26, 0.763);
}
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="color: #FBD41A;">
            <div class="container px-5">
                <a class="navbar-brand" href="/">Love Builds Apparel Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/products">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/orders">Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/categories">Categories</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/customers">Customers</a></li>
                    </ul>
                </div>
            </div>
        </nav> 
    </div>
    <div class="py-4">
        @yield('content')
    </div>
    @include('layouts.partials.footer')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
