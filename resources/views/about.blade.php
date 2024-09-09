@extends('layouts.headShop')

@section('title', 'Your Page Title')

@section('content')
<script src="https://cdn.lordicon.com/lordicon.js"></script>
<style>

   @font-face {
  font-family: 'HisyamFacelift';
  src: url('/fonts/Hisyam/HisyamFacelift.ttf.woff') format('woff'),
       url('/fonts/Hisyam/HisyamFacelift.ttf.svg') format('svg'),
       url('/fonts/Hisyam/HisyamFacelift.ttf.eot'),
       url('/fonts/Hisyam/HisyamFacelift.ttf.eot?#iefix') format('embedded-opentype');
       font-weight: normal;
       font-style: normal;
    }
    .hisyam-facelift {
        font-family: 'HisyamFacelift', sans-serif;
    }
    .gold-text {
      color: #D27F2D;
    }
    .shop-banner {
            width: 100vw;
            height: 30vh;
            background-image: url('{{ asset('img/tes1.jpg') }}');
            background-size: cover;
            background-position: center;
            font-family: Montserrat, sans-serif;
            margin-top: -5px;
            position: relative;
        }

        .shop-banner::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.73); /* Adjust the color and opacity as needed */
        }

        .shop-banner-content {
            position: relative;
            z-index: 1;
            padding: 2rem;
            padding-left: 10vw;
        }

        .shop-banner h2 {
            color: #ffffff;
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        .shop-banner p {
            color: #ffffff;
            font-size: 1.2rem;
            margin-top: 0;
        }

        .shop-banner .text-grey {
            color: #cccccc;
        }
</style>
        
    <!-- Banter for shop -->
    <div class="shop-banner">
        <div class="d-flex align-items-center justify-content-start h-100 shop-banner-content">
            <div>
                <button class="btn btn-warning rounded-pill px-4"></button>
                <h2><strong>About Lovebuilds</strong></h2>
                <p><span class="text-grey">Home</span> &nbsp; > &nbsp; About</p>
            </div>
        </div>
    </div>
        <section class="pt-5">
            <header class="text-center">
            <h1 class="hisyam-facelift" style="font-size: 3.2rem;">
                L
                <span class="svg">
                    <svg width="64px" height="64px" viewBox="0 0 1024.00 1024.00" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M927.4 273.5v-95.4h-87.9V82.8h-201v95.3h-87.9v95.4h-78.5v-95.4h-88V82.8H183.2v95.3H95.3v95.4H16.7v190.6h78.6v95.4h75.3v95.3H246v95.3h87.9v95.4h100.5v95.3h153.9v-95.3h100.4v-95.4h88v-95.3H852.1v-95.3h75.3v-95.4h78.5V273.5z" fill="#E02D2D">
                        </path></g></svg>
                </span>
               VE Builds</h1>
            </header>
        </section>
        <div class="hisyam-facelift text-center">
            <p class="h1" style="font-size: 3.2rem;">Was Established In
                <span class="gold-text" style="font-size: 5.9rem;">2019</span> 
            </p>                
        </div>
        <section class="py-5 bg-white" id="scroll-target">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" style="max-height: 60vh;" src="{{ asset('img/gal3.jpg') }}" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder">Our founding</h2>
                        <p class="lead fw-normal text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto est, ut esse a labore aliquam beatae expedita. Blanditiis impedit numquam libero molestiae et fugit cupiditate, quibusdam expedita, maiores eaque quisquam.</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="hisyam-facelift text-center">
            <p class="h1" style="font-size: 3.2rem;">The legacy goes on...</p>
        </div>
        <!-- About section two-->
        <!--  <svg width="100%" height="100%" id="svg" viewBox="0 0 1440 490" xmlns="http://www.w3.org/2000/svg" class="transition duration-300 ease-in-out delay-150"><path d="M 0,500 L 0,187 C 81.9230504981106,215.25626932325662 163.8461009962212,243.5125386465132 243,241 C 322.1538990037788,238.4874613534868 398.53864651322573,205.2061147372037 448,172 C 497.46135348677427,138.7938852627963 519.999312950876,105.66300240467193 579,100 C 638.000687049124,94.33699759532807 733.4641016832703,116.14187564410858 809,138 C 884.5358983167297,159.85812435589142 940.1442803160428,181.76949501889382 1008,195 C 1075.8557196839572,208.23050498110618 1155.958777052559,212.78014428031605 1230,210 C 1304.041222947441,207.21985571968395 1372.0206114737205,197.10992785984197 1440,187 L 1440,500 L 0,500 Z" stroke="none" stroke-width="0" fill="#fbd41a" fill-opacity="1" class="transition-all duration-300 ease-in-out delay-150 path-0"></path></svg>
        -->
        
        <section class="border-bottom" style="background-color: #D27F2D; border-style: solid; border-color: white;"> 
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" style="max-height: 60vh;" src="{{ asset('img/purpose.jpg') }}" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder">Growth &amp; beyond</h2>
                        <p class="lead fw-normal text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto est, ut esse a labore aliquam beatae expedita. Blanditiis impedit numquam libero molestiae et fugit cupiditate, quibusdam expedita, maiores eaque quisquam.</p>
                    </div>
                </div>
            </div>
            <svg id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 100" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(248, 249, 250, 1)" offset="0%"></stop><stop stop-color="rgba(248, 249, 250, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,20L48,26.7C96,33,192,47,288,48.3C384,50,480,40,576,33.3C672,27,768,23,864,20C960,17,1056,13,1152,18.3C1248,23,1344,37,1440,41.7C1536,47,1632,43,1728,35C1824,27,1920,13,2016,11.7C2112,10,2208,20,2304,20C2400,20,2496,10,2592,15C2688,20,2784,40,2880,41.7C2976,43,3072,27,3168,16.7C3264,7,3360,3,3456,16.7C3552,30,3648,60,3744,71.7C3840,83,3936,77,4032,73.3C4128,70,4224,70,4320,61.7C4416,53,4512,37,4608,30C4704,23,4800,27,4896,35C4992,43,5088,57,5184,58.3C5280,60,5376,50,5472,41.7C5568,33,5664,27,5760,25C5856,23,5952,27,6048,23.3C6144,20,6240,10,6336,8.3C6432,7,6528,13,6624,13.3C6720,13,6816,7,6864,3.3L6912,0L6912,100L6864,100C6816,100,6720,100,6624,100C6528,100,6432,100,6336,100C6240,100,6144,100,6048,100C5952,100,5856,100,5760,100C5664,100,5568,100,5472,100C5376,100,5280,100,5184,100C5088,100,4992,100,4896,100C4800,100,4704,100,4608,100C4512,100,4416,100,4320,100C4224,100,4128,100,4032,100C3936,100,3840,100,3744,100C3648,100,3552,100,3456,100C3360,100,3264,100,3168,100C3072,100,2976,100,2880,100C2784,100,2688,100,2592,100C2496,100,2400,100,2304,100C2208,100,2112,100,2016,100C1920,100,1824,100,1728,100C1632,100,1536,100,1440,100C1344,100,1248,100,1152,100C1056,100,960,100,864,100C768,100,672,100,576,100C480,100,384,100,288,100C192,100,96,100,48,100L0,100Z"></path></svg>
        </section>
        <div class="hisyam-facelift text-center">
            <lord-icon
                src="https://cdn.lordicon.com/etgnxeer.json"
                trigger="loop"
                delay="1500"
                stroke="bold"
                colors="primary:#629110,secondary:#fbd41a"
                style="width:100px;height:100px">
            </lord-icon>
            <p class="h1" style="font-size: 3.2rem;">
                <span class="gold-text">Love Builds </span>            
                Is A Lifestyle</p>
        </div>
        <!-- Team members section-->
        <section class="py-5" style="background-color: #d2802db6">
            <div class="container px-5 my-5">
                <div class="text-center">
                    <h2 class="fw-bolder">Our team</h2>
                    <p class="lead fw-normal text-muted mb-5">Dedicated to quality and your success</p>
                </div>
                <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5 mb-5 mb-xl-0">
                        <div class="text-center">
                            <img class="img-fluid rounded-circle mb-4 px-4" src="https://dummyimage.com/150x150/ced4da/6c757d" alt="..." />
                            <h5 class="fw-bolder">Ibbie Eckart</h5>
                            <div class="fst-italic text-muted">Founder &amp; CEO</div>
                        </div>
                    </div>
                    <div class="col mb-5 mb-5 mb-xl-0">
                        <div class="text-center">
                            <img class="img-fluid rounded-circle mb-4 px-4" src="https://dummyimage.com/150x150/ced4da/6c757d" alt="..." />
                            <h5 class="fw-bolder">Arden Vasek</h5>
                            <div class="fst-italic text-muted">CFO</div>
                        </div>
                    </div>
                    <div class="col mb-5 mb-5 mb-sm-0">
                        <div class="text-center">
                            <img class="img-fluid rounded-circle mb-4 px-4" src="https://dummyimage.com/150x150/ced4da/6c757d" alt="..." />
                            <h5 class="fw-bolder">Toribio Nerthus</h5>
                            <div class="fst-italic text-muted">Operations Manager</div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="text-center">
                            <img class="img-fluid rounded-circle mb-4 px-4" src="https://dummyimage.com/150x150/ced4da/6c757d" alt="..." />
                            <h5 class="fw-bolder">Malvina Cilla</h5>
                            <div class="fst-italic text-muted">CTO</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('layouts.partials.shopwithus')

@endsection
