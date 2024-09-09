@extends('layouts.app')

<style>
    .navbar {
        background: transparent;
        position: relative;
        overflow-x: hidden;
        z-index: 1001; /* Ensure navbar is above the overlay */
    }
    .banner {
        position: absolute; /* Change to absolute */
        top: 0; /* Start from the top of the page */
        left: 0;
        width: 100%;
        background-size: cover;
        background-position: center;
        height: 40vh; /* Make it full viewport height */
        min-height: 250px;
    }
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #6e67068f;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .banner-content {
        text-align: center;
        padding-top: 60px; /* Adjust based on your navbar height */
    }

    .banner-content h1,
    .banner-content p {
        color: #fff;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.31);
        font-family: 'Aspira', sans-serif;
    }
    .banner-content h1 {
        font-size: 3.2rem !important;
    }

    /* Ensure text is readable on any background */
    .navbar-dark .navbar-nav .nav-link {
        color: rgba(255, 255, 255, .8);
    }

    .navbar-dark .navbar-nav .nav-link:hover,
    .navbar-dark .navbar-nav .nav-link:focus {
        color: rgba(255, 255, 255, 1);
    }
    .overlay h1 {
        font-size: 1rem;
        color: #000;
    }
    .overlay p {
        font-size: 1.25rem;
        color: #000;
    }
    @media (max-width: 768px) {
        .banner {
            height: 40vh; /* Adjust height for smaller screens */
        }
        .overlay h1 {
            font-size: 2rem; /* Smaller font size for h1 on small screens */
        }
        .overlay p {
            font-size: 1rem; /* Smaller font size for p on small screens */
        }
    }
    @media (max-width: 576px) {
        .banner {
            height: 40vh; /* Adjust height for extra small screens */
        }
        .overlay h1 {
            font-size: 1.5rem; /* Smaller font size for h1 on extra small screens */
        }
        .overlay p {
            font-size: 0.875rem; /* Smaller font size for p on extra small screens */
        }
    }
</style>

@section('title', 'Frequently Asked Questions')

@section('content')
@include('layouts.partials.banner', [
    'bannerImage' => asset('img/faq.jpg'),
    'bannerTitle' => 'FAQ',
    'bannerDescription' => 'This is where you connect with our team and get started with any of your projects'
])

<body class="d-flex flex-column h-100" style="overflow-x: hidden;">
    <main class="flex-shrink-0">
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">Frequently Asked Questions</h1>
                    <p class="lead fw-normal text-muted mb-0">How can we help you?</p>
                </div>
                <div class="row gx-5">
                    <div class="col-xl-8 mx-auto">
                        <!-- FAQ Accordion -->
                        <h2 class="fw-bolder mb-3 text-center">Questions</h2>
                        <div class="accordion mb-5" id="accordionExample">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        What is mental health?
                                    </button>
                                </h3>
                                <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Mental health refers to cognitive, behavioral, and emotional well-being.</strong> It is about how people think, feel, and behave. It affects daily living, relationships, and physical health.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        What causes mental health problems?
                                    </button>
                                </h3>
                                <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Mental health problems can be caused by a variety of factors, including genetics, environment, and lifestyle.</strong> Stressful life events, such as a death or a divorce, can trigger mental illness.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Can you prevent mental health problems?
                                    </button>
                                </h3>
                                <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Preventing mental health problems involves promoting well-being and resilience.</strong> Strategies include maintaining a healthy lifestyle, seeking support when needed, and practicing mindfulness.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS -->
    <script src="js/scripts.js"></script>
</body>
@endsection
