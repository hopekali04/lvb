@extends('layouts.headshop')

@section('title', 'Frequently Asked Questions')
@section('content')
<script src="https://cdn.lordicon.com/lordicon.js"></script>
<style>
    .shop-banner {
            width: 100vw;
            height: 30vh;
            background-image: url('{{ asset('img/help.jpg') }}');
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
            background-color: rgba(0, 0, 0, 0.741);; /* Adjust the color and opacity as needed */
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
        .btn-custom-yellow {
                color: #000000; /* Dark yellow/brown color for text */
                background-color: #d2802dd6;
                border: 2px solid #d2802dd6; /* Gold color for border */
                border-radius: 25px; /* Rounded corners */
                padding: 10px 20px; /* Vertical and horizontal padding */
                font-size: 16px;
                transition: all 0.3s ease;
                white-space: nowrap; /* Prevent text from wrapping */
                min-width: 200px; /* Minimum width to ensure button isn't too narrow */
                display: inline-block; /* Allow button to grow with content */
        }

        .btn-custom-yellow:hover {
            background-color: #6D2E46; /* Gold color on hover */
            color: #f6f6f6; /* Keep text color the same on hover */
        }
    .gold-text {
      color: #D27F2D;
    }
    .card-icon {
        font-size: 2rem; /* Increased font size for larger icons */
    }
    .card-container {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
        }
        .card {
            flex: 1;
            border: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0;
        }
        .form-card {
            background-color: #f7f3e3;
            padding: 2rem;
        }
        .form-control {
        border-color: rgb(0, 0, 0);
        background-color: #ffffff;
        color: rgb(0, 0, 0);
        }
        .form-control:focus {
            border-color: #dfa368;
            box-shadow: 0 0 5px #dfa368;
            background-color: #dfa368;
            color: rgb(0, 0, 0);
        }
        .form-floating label {
            color: rgb(0, 0, 0);
        }
        .form-floating {
            margin-bottom: 1rem;
        }
        .email-phone-row {
            display: flex;
            justify-content: space-between;
        }
        .email-phone-row .form-floating {
            flex: 0 0 48%;
        }
        .img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        @media (max-width: 767.98px) {
            .card-container {
                flex-direction: column;
            }
        }
        .contact-section {
            text-align: center;
        }
        .contact-section p.lead {
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .contact-section p.lead {
                text-align: left;
            }
        }
</style>
    <!-- Banter for shop -->
    <div class="shop-banner">
        <div class="d-flex align-items-center justify-content-start h-100 shop-banner-content">
            <div>
                <button class="btn btn-warning rounded-pill px-4"></button>
                <h2><strong>Contact Us</strong></h2>
                <p>Have Questions Or Queries? Contact Us </p>
            </div>
        </div>
    </div>
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <!-- Page content-->
            <section class="py-5 bg-white">
                <div class="container px-5">
                    <!-- Contact form-->
                    <div class="contact-section">
                        <div class="container mb-3">
                            <button class="btn-custom-yellow"><strong>Get In Touch</strong></button>
                        </div>
                <h3 class="h2"><strong><span class="gold-text">HOW</span> Can <span class="gold-text">WE</span>  Help <span class="gold-text">YOU</span>?</strong></h3>
                <p class="lead">Do you have any questions? Please do not hesitate to contact us directly. <br>
                    Our team will come back to you within
                    a matter of hours to help you.</p>
                </div>
            </section>
            <div class="container mt-5">
                @include('layouts.partials.smallbanner')
                <h1 class="text-center mb-4"><strong>Get in Touch with Us</strong></h1>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center" style="background-color: #EAC29A">
                            <div class="card-body">
                                <lord-icon
                                src="https://cdn.lordicon.com/aycieyht.json"
                                trigger="loop"
                                delay="1500"
                                stroke="bold"
                                colors="primary:#000000,secondary:#000000"
                                style="width:100px;height:100px">
                            </lord-icon>
                                <h5 class="card-title mt-3">Send Us An Email</h5>
                                <p class="card-text">Reach out to us via email for any inquiries or support.</p>
                                <a href="mailto:example@example.com" class="btn btn-success rounded-pill">
                                    <i class="fas fa-envelope"></i> Email Us
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="background-color: #ffffff">
                            <div class="card-body" style="padding: 40px">
                                <i class="card-icon">
                                    <img src="{{ asset('img/telephone.gif') }}" alt="" 
                                    style="height: 50px; width: 50px;"
                                    >
                                </i>
                                <h5 class="card-title mt-3">Give Us A Call</h5>
                                <p class="card-text">Feel free to call for immediate assistance or queries.</p>
                                <a href="tel:+1234567890" class="btn btn-success rounded-pill">
                                    <i class="fas fa-phone"></i> Call Us
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center" style="background-color: #EAC29A; padding: 13px">
                            <div class="card-body">
                                <lord-icon
                                src="https://cdn.lordicon.com/cywksamr.json"
                                trigger="loop"
                                delay="1500"
                                style="width:60px;height:60px;">
                            </lord-icon>
                                <h5 class="card-title mt-3">Chat With Us</h5>
                                <p class="card-text">Feel Free to text us for immediate assistance or queries.</p>
                                <a href="https://wa.me/1234567890?text=Hello%20there!%20I%20want%20to%20get%20in%20touch%20with%20you." class="btn btn-success rounded-pill">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Map -->
            <div class="text-center" style="padding-top: 90px">
                <button class="btn"
                style=" background-color: #D27F2D; color: #000; border-radius: 5em; padding: 10px 20px; font-size: 1.25rem;"
                >
                    <strong>Our Location</strong>
                    <i class="fas fa-map-marker-alt"></i>
                </button>
            </div>

            <div class="container-fluid g-0">
                        <div class="row g-0">
                            <div class="col-md-12">
                                <div class="lc-block overflow-hidden">
                                    <div style="max-height:40vh; margin-top: 52px"; class="ratio ratio-1x1" lc-helper="gmap-embed">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30708.348421011186!2d35.06077176207084!3d-15.828004084797357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18d84994891a55e3%3A0x8672da440f7648fa!2sKaunjika&#39;s%20Resident!5e0!3m2!1sen!2smw!4v1661695482997!5m2!1sen!2smw" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <section class="bg-white">
                <div class="text-center" style="padding-top: 90px">
                    <button class="btn"
                    style=" background-color: #D27F2D; color: #000; border-radius: 5em; padding: 10px 20px; font-size: 1.25rem;"
                    >
                    <i class="fas fa-envelope"></i>
                        <strong>Contact Us</strong>
                    </button>
                </div>          
                <div class="container" style="padding: 20px">
                    <div class="card-container">
                        <div class="card img-card">
                            <img src="{{ asset('img/purpose.jpg')}}" alt="Image">
                        </div>
                        <div class="card form-card">
                            <h5 class="card-title text-center mb-5 fw-light fs-5">Send An Email Directly Here.</h5>
                            <form action="contactaction.php" method="post">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="name" required>
                                    <label for="name">Full Name</label>
                                </div>
                                <div class="email-phone-row">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                                        <label for="email">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="phone" required>
                                        <label for="phone">Phone number</label>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="message" id="message" placeholder="Enter your message" style="height: 10rem" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                                <div class="d-flex">
                                    <a type="button" class="btn btn-floating rounded-pill btn-lg" href="https://web.facebook.com/yohanebandafoundation/?_rdc=3&_rdr" target="_blank">
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
                                    <button class="btn btn-primary btn-login text-uppercase fw-bold rounded-pill px-4" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            @include('layouts.partials.smallbanner')
            @include('layouts.partials.newsletter')
        </main>
        <!-- Footer-->
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
@endsection

