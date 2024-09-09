@extends('layouts.header')

@section('title', 'Index')
<head>
    <title> Love Builds</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--  <link href="{ asset('css/landing.css') }}" rel="stylesheet"> -->

</head>
<style>
  body{
    overflow-x: hidden;
  }
  i {
    color: #2B2118;
  }
  #btn-cl {
    color: #f7f3e3;
  }
  #insta {
    color: #f7f3e3;
    text-decoration: none;
  }
  body {
      font-family: sans-serif;
    }
    .carousel-item img {
      object-fit: cover;
    }
    #myCarousel {
        height: 70vh;
        max-height: 70vh;
        margin-right: 2vw;
        margin-left: 2vw
    }
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }

    .prod-img-top {
      width: 100%; /* make the image take the full width of the parent container */
      height: 500px; /* set a fixed height for all images */
      object-fit: cover; /* scale the image to cover the entire container while maintaining its aspect ratio */
    }
    .card {
      border: none;
      text-align: center;
    }
    .card-body {
        padding: 20px;
    }
    .prod-img-top {
        border-bottom: none;
    }
    .yellow-text {
      color: #CA772B;
    }
    .gold-text {
      color: #e18504;
    }

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

.btn-custom {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 13rem;
  overflow: hidden;
  height: 3rem;
  background-size: 300% 300%;
  backdrop-filter: blur(1rem);
  border-radius: 5rem;
  transition: 0.5s;
  animation: gradient_301 5s ease infinite;
  border: double 4px transparent;
  background-image: linear-gradient(#212121, #212121), linear-gradient(137.48deg, #ffdb3b 10%, #ff9b17d7 45%, #f9ff41 67%, #feb200d7 87%);
  background-origin: border-box;
  background-clip: content-box, border-box;
}

#container-stars {
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  overflow: hidden;
  transition: 0.5s;
  backdrop-filter: blur(1rem);
  border-radius: 5rem;
}

.strong-text {
  z-index: 2;
  font-family: 'Poppins' sans-serif;
  font-size: 16px;
  letter-spacing: 3px;
  color: #FFFFFF;
  text-shadow: 0 0 4px rgb(0, 0, 0);
}

#glow {
  position: absolute;
  display: flex;
  width: 12rem;
}

.circle {
  width: 100%;
  height: 30px;
  filter: blur(2rem);
  animation: pulse_3011 4s infinite;
  z-index: -1;
}

.circle:nth-of-type(1) {
  background: rgba(0, 0, 1860 0.936);
}

.circle:nth-of-type(2) {
  background: rgba(0, 0, 1860 0.936);
}

.btn-custom:hover #container-stars {
  z-index: 1;
  background-color: #212121;
}

.btn-custom:hover {
  transform: scale(1.1)
}

.btn-custom:active {
  border: double 4px #FE53BB;
  background-origin: border-box;
  background-clip: content-box, border-box;
  animation: none;
}

.btn-custom:active .circle {
  background: #FE53BB;
}

#stars {
  position: relative;
  background: transparent;
  width: 200rem;
  height: 200rem;
}

#stars::after {
  content: "";
  position: absolute;
  top: -10rem;
  left: -100rem;
  width: 100%;
  height: 100%;
  animation: animStarRotate 90s linear infinite;
}

#stars::after {
  background-image: radial-gradient(#ffffff 1px, transparent 1%);
  background-size: 50px 50px;
}

#stars::before {
  content: "";
  position: absolute;
  top: 0;
  left: -50%;
  width: 170%;
  height: 500%;
  animation: animStar 60s linear infinite;
}

#stars::before {
  background-image: radial-gradient(#ffffff 1px, transparent 1%);
  background-size: 50px 50px;
  opacity: 0.5;
}

@keyframes animStar {
  from {
    transform: translateY(0);
  }

  to {
    transform: translateY(-135rem);
  }
}

@keyframes animStarRotate {
  from {
    transform: rotate(360deg);
  }

  to {
    transform: rotate(0);
  }
}

@keyframes gradient_301 {
  0% {
    background-position: 0% 50%;
  }

  50% {
    background-position: 100% 50%;
  }

  100% {
    background-position: 0% 50%;
  }
}

@keyframes pulse_3011 {
  0% {
    transform: scale(0.75);
    box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
  }

  70% {
    transform: scale(1);
    box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
  }

  100% {
    transform: scale(0.75);
    box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
  }
}
/* COntent for 2nd button */
.cssbuttons-io-button {
  background: #6D2E46;
  color: white;
  font-family: inherit;
  padding: 0.35em;
  padding-left: 1.2em;
  font-size: 17px;
  font-weight: 500;
  border-radius: 0.9em;
  border: none;
  letter-spacing: 0.05em;
  display: flex;
  align-items: center;
  box-shadow: inset 0 0 1.6em -0.6em #6D2E46;
  overflow: hidden;
  position: relative;
  height: 2.8em;
  padding-right: 3.3em;
  margin-left: auto;
}

.cssbuttons-io-button .icon {
  background: white;
  margin-left: 1em;
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 2.2em;
  width: 2.2em;
  border-radius: 0.7em;
  box-shadow: 0.1em 0.1em 0.6em 0.2em #6D2E46;
  right: 0.3em;
  transition: all 0.3s;
}

.cssbuttons-io-button:hover .icon {
  width: calc(100% - 0.6em);
}

.cssbuttons-io-button .icon svg {
  width: 1.1em;
  transition: transform 0.3s;
  color: #6D2E46;
}

.cssbuttons-io-button:hover .icon svg {
  transform: translateX(0.1em);
}

.cssbuttons-io-button:active .icon {
  transform: scale(0.95);
}
.upcoming-event-image {
  position:relative;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  max-width: 600px; /* adjust this value to match the max width of the opposite column */
  max-height: 300px; /* adjust this value to match the max height of the opposite column */
  object-fit: cover;
  object-position: center;
  border-radius: 10px; /* optional */
  z-index: -1; /* add this to send the image behind the title and button */
}
.bi {
    vertical-align: -3em;
    fill: currentColor;
}

.feature-icon-small {
  width: 3rem;
  height: 3rem;
}

</style>
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="collection" viewBox="0 0 16 16">
    <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z"/>
  </symbol>
</svg>
@section('content')

    @include('layouts.partials.mainslide')
    <!-- Categories section-->

    <section class="pt-5">
        <header class="text-center">
        <h1 class="hisyam-facelift">Carefully Created Collections</h1>
        </header>
    </section>
    <style>
      @media (max-width: 991.98px) {
        .text-end h2 {
          font-size: 1.5rem !important;
        }
        .text-end h2:nth-child(2) {
          font-size: 1.2rem !important;
        }
        .text-end h2:nth-child(3) {
          font-size: 1rem !important;
        }
      }
    </style>

    <!-- Your page-specific content goes here -->
    <div class="container">
      <div class="p-5 text-center bg-image position-relative" style="
        background-image: url('{{ asset('img/home/hometop.jpg') }}');
        height: 40vh;
        margin-top: 58px;
        border-radius: 20px;
        background-size: cover;
        background-blend-mode: overlay; /* Add this line to make the image partially opaque */
      ">
          <div class="mask">
            <div class="d-flex justify-content-end align-items-end h-100">
              <div class="text-end" style="font-family: Montserrat, sans-serif; max-width: 70%;">
                <h2 class="lh-1 fw-bold" style="color: #7F1AFB; font-size: 3rem;">
                  Are You Ready To
                </h2>
                <h2 class="lh-1 fw-bold" style="color: #121258; font-size: 2.5rem;">
                  Style The Summer?
                </h2>
                <h2 class="lh-3" style="color: #320b62; font-size: 1.6rem;">
                  <br>
                  Save on Select Collections for you.
                </h2>
                <button class="cssbuttons-io-button" style="justify-content: end;"> Shop Now
                  <div class="icon">
                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"></path><path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path></svg>
                  </div>
                </button>
              </div>
            </div>
          </div>
      </div>
      <br>
      <br>

      @include('layouts.partials.smallbanner')

      <!-- Collections section -->
      @include('layouts.partials.collections')

      @include('layouts.partials.top-selling')

    <!-- Founder section -->
    @include('layouts.partials.founder')


    <!-- top selling section -->
    @include('layouts.partials.topselling')

    <style>
      @media (max-width: 991.98px) {
        #blue-ban{
          max-width: 100% !important;
        }
        .text-start h2 {
          font-size: 1.8rem !important;
        }
        .text-start h2:nth-child(2) {
          font-size: 1.8rem !important;
        }
        .text-start h2:nth-child(3) {
          font-size: 1.2rem !important;
        }
      }
    </style>
  <div class="p-5 bg-image " style="
    background-image: url('{{ asset('img/home/homebase.jpg') }}');
    height: 40vh;
    margin-top: 58px;
    background-size: cover;
    border-radius: 20px; /* Add this line to make the edges round */
  ">
      <div class="mask">
          <div class="d-flex justify-content-start align-items-center h-100">
          <div class="text-start" id="blue-ban" style="font-family: Montserrat, sans-serif; max-width: 40%; padding-left: 20px;">
              <h2 class="lh-1 fw-bold" style="color: #121258; font-size: 48px;">
              Feel special
              </h2>
              <h2 class="lh-1 fw-bold" style="color: #CA772B; font-size: 48px;">
              Because You Are
              </h2>
              <h2 class="lh-3 " style="color: #121258; font-size: 20px;">
              Save on luxury jewelry, watches and handbags for you.
              </h2>
              <a data-mdb-ripple-init class="btn btn-outline-dark btn-lg" href="#!" role="button">Call to action</a>
          </div>
          </div>
      </div>
  </div>
    <main class="flex-shrink-0">
      <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-5">
        <div class="col d-flex flex-column align-items-start gap-2 position-relative p-4">
          <img src="{{ asset('img/upcoming.jpg') }}" alt="Image Describing the upcoming event" class="upcoming-event-image">
        </div>

        <div class="col">

          <div class="row row-cols-1 row-cols-sm-2 g-4">
            <div class="col d-flex flex-column gap-2">
              <svg width="55px" height="55px" viewBox="-12 -12 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-12" y="-12" width="48.00" height="48.00" rx="24" fill="#7F1AFB" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 9H21M7 3V5M17 3V5M6 12H8M11 12H13M16 12H18M6 15H8M11 15H13M16 15H18M6 18H8M11 18H13M16 18H18M6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V8.2C21 7.07989 21 6.51984 20.782 6.09202C20.5903 5.71569 20.2843 5.40973 19.908 5.21799C19.4802 5 18.9201 5 17.8 5H6.2C5.0799 5 4.51984 5 4.09202 5.21799C3.71569 5.40973 3.40973 5.71569 3.21799 6.09202C3 6.51984 3 7.07989 3 8.2V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.07989 21 6.2 21Z" stroke="#FBD41A" stroke-width="2" stroke-linecap="round">
                </path> </g></svg>
              <h4 class="fw-semibold mb-0 text-body-emphasis">Date</h4>
              <p class="text-body-primary"> 10 AUGUST, 2024</p>
            </div>

            <div class="col d-flex flex-column gap-2">
              <svg width="55px" height="55px" viewBox="-12 -12 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-12" y="-12" width="48.00" height="48.00" rx="24" fill="#FBD41A" strokewidth="0"></rect></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">
                  <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="#7F1AFB" stroke-width="2.064" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 6V12" stroke="#7F1AFB" stroke-width="2.064" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M16.24 16.24L12 12" stroke="#7F1AFB" stroke-width="2.064" stroke-linecap="round" stroke-linejoin="round">
                </path> </g></svg>
              <h4 class="fw-semibold mb-0 text-body-emphasis">Time</h4>
              <p class="text-body-primary"> 7 : 00 - 17 : 00 HRS</p>
            </div>

            <div class="col d-flex flex-column gap-2">

                <svg width="55px" height="55px" viewBox="-16.32 -16.32 64.64 64.64" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-16.32" y="-16.32" width="64.64" height="64.64" rx="32.32" fill="#FBD41A" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 12C21 9.24 18.76 7 16 7C13.24 7 11 9.24 11 12C11 14.76 13.24 17 16 17C18.76 17 21 14.76 21 12ZM16 1C22.08 1 27 5.92 27 12C27 21 16 31 16 31C16 31 5 21 5 12C5 5.92 9.92 1 16 1Z" fill="#ffffff"></path> <path d="M19 28C23 24 27 17.447 27 12C27 5.925 22.075 1 16 1C9.925 1 5 5.925 5 12C5 21 16 31 16 31M5 31H27M21 12C21 9.238 18.762 7 16 7C13.238 7 11 9.238 11 12C11 14.762 13.238 17 16 17C18.762 17 21 14.762 21 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
              <h4 class="fw-semibold mb-0 text-body-emphasis">Location</h4>
              <p class="text-body-primary"> College Of Medicine</p>
            </div>

            <div class="col d-flex flex-column gap-1">
              <a href="#" class="btn btn-lg" style="background-color: #7F1AFB; color: white;">Register</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Image Gallery -->



    </div>
    @include('layouts.partials.insta')
      @include('layouts.partials.smallbanner')

      @include('layouts.partials.newsletter')

    <!-- Service 3 - Bootstrap Brain Component -->
    @include('layouts.partials.shopwithus')
</main>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
@endsection
