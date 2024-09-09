@extends('layouts.headShop')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['product_name'] }}</title>
    <!--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    .card-img-top {
       width: 100%; /* make the image take the full width of the parent container */
       height: 500px; /* set a fixed height for all images */
       object-fit: cover; /* scale the image to cover the entire container while maintaining its aspect ratio */
     }
     .prod-img-top {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .badge {
        padding: 0.5em 1em;
        font-size: 0.75em;
    }

    .text-warning .bi-star-fill {
        color: #ffc107;
    }

    .card-footer .btn {
        width: 100%;
    }

    @media (min-width: 576px) {
        .row-cols-2 > * {
            flex: 0 0 50%;
        }
    }

    @media (min-width: 768px) {
        .row-cols-md-3 > * {
            flex: 0 0 33.333333%;
        }
    }

    @media (min-width: 1200px) {
        .row-cols-xl-4 > * {
            flex: 0 0 25%;
        }
    }

 
    .image-slider {
        overflow-y: auto;
        height: 500px; /* adjust the height to your liking */
    }

    .slider-item {
        margin-bottom: 10px;
    }

    .slider-item img {
        width: 5vw; /* adjust the width to your liking */
        height: 15vh; /* adjust the height to your liking */
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
    }

    .slider-item img:hover {
        opacity: 0.8;
    }

    .arrow {
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
    border: none;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.7);
    padding: 8px;
    transition: background-color 0.3s ease;
}

.arrow:hover {
    background-color: rgba(255, 255, 255, 0.9);
}

.arrow svg {
    width: 24px;
    height: 24px;
}

.arrow.left {
    left: 10px;
}

.arrow.right {
    right: 10px;
}

    @media (max-width: 769px) {
        .image-slider {
            display: none;
        }
        

        .arrow {
            display: block;
        }
    }
</style>

@section('content')

<div class="container" >
    @if (isset($data) && !empty($data))
    
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-2">
                    <div class="image-slider">
                        @foreach($data['images'] as $image)
                            <div class="slider-item">
                                <img src="/{{ $image }}" alt="Product Image" class="img-fluid">
                            </div>
                        @endforeach
                        <div class="slider-item">
                            <img src="/{{ $data['product_thumbnail'] }}" alt="Product Thumbnail" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 position-relative">
                    <div class="card border-0">
                        <img src="/{{ $data['product_thumbnail'] }}" class="card-img-top" alt="Product 2" id="main-image">
                    </div>
                    <button class="arrow left" aria-label="Previous image">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="currentColor" d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
                        </svg>
                    </button>
                    <button class="arrow right" aria-label="Next image">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="currentColor" d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                        </svg>
                    </button>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column justify-content-center">
                        <h1 class="display-5 fw-bolder">{{ $data['product_name'] }}</h1>
                        <h4 style="color: #DD7907"><strong> Collection:</strong> {{ $data['category_name'] }}</h4>
                        <p class="lead">{{ $data['description'] }}</p>
                        <div class="fs-5 mb-5">
                            <span><strong>MWK</strong> <span id="price" style="color: green">{{ $data['base_price'] }}</span></span>
                        </div>
                        <div class="mb-12">
                            <span class="d-block fw-bold text-secondary text-uppercase">Size</span>
                            <div class="row mb-n2">
                                @foreach(['S', 'M', 'L', 'X', 'XL'] as $size)
                                    @if (in_array($size, array_column($data['variations'], 'option_value')))
                                        <div class="col-4 col-sm-3 p-2">
                                            <a class="btn w-100 position-relative bg-white fw-bold text-secondary border size-btn @if ($loop->first) active @endif" data-size="{{ $size }}">
                                                {{ $size }}
                                                <span class="position-absolute bottom-0 start-0 end-0 d-block size-indicator @if ($loop->first) bg-info @endif" style="height: 2px;"></span>
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-4 col-sm-3 p-2">
                                            <a class="btn w-100 bg-white fw-bold text-secondary border disabled" data-size="{{ $size }}">
                                                {{ $size }}
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-secondary btn-sm" onclick="decrementQuantity()">-</button>
                                <input type="number" id="quantity" name="quantity" class="form-control mx-2" value="1" min="1" max="1" style="max-width: 50px;">
                                <button class="btn btn-outline-secondary btn-sm" onclick="incrementQuantity()">+</button>
                                <span id="availableQuantity" class="ms-2 text-muted"></span>
                            </div>
                        </div>
                                            
                        <form action="{{ route('add.to.cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $data['product_id'] }}">
                            <input type="hidden" name="option_id" id="hiddenOptionId" value="">
                            <input type="hidden" name="product_title" value="{{ $data['product_name'] }}">
                            <input type="hidden" name="product_thumbnail" value="{{ $data['product_thumbnail'] }}">
                            <input type="hidden" name="price" id="hiddenPrice" value="{{ $data['base_price'] }}">
                            <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                            <input type="hidden" name="available_quantity" id="hiddenAvailableQuantity" value="">
                            <input type="hidden" name="size" id="hiddenSize" value="">
                            <div class="d-grid">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold rounded-pill" type="submit">
                                    <i class="bi-cart-fill me-1"></i>
                                    Add to cart
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <section class="py-5 bg-light">
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3">Product Details</h2>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab" aria-controls="specifications" aria-selected="false">Specifications</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                    <p>{{ $data['description'] }}</p>
                                </div>
                                <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> 
            <section class="py-5 bg-light">
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-4">You May Also Like</h2>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                                @if (isset($collections['collection']) && !empty($collections['collection']))
                                @foreach($collections['collection']['products'] as $product)
                                        <div class="col mb-5">
                                            <div class="card h-100 shadow-sm">
                                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                                <img class="prod-img-top" src="{{ $product['thumbnail'] }}" alt="{{ $product['title'] }}"/>
                                                <div class="card-body p-4 text-center">
                                                    <h5 class="fw-bolder">{{ $product['title'] }}</h5>
                                                </div>
                                                <!-- Product reviews-->
                                                <div class="d-flex justify-content-center small text-warning mb-2">
                                                    <div class="bi-star-fill"></div>
                                                    <div class="bi-star-fill"></div>
                                                    <div class="bi-star-fill"></div>
                                                    <div class="bi-star-fill"></div>
                                                    <div class="bi-star-fill"></div>
                                                </div>
                                                <!-- Product actions-->
                                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                                                    <a class="btn btn-outline-dark mt-auto" href="/product/{{ $product['id'] }}">View Product</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-center">No Similar products Found.</p>
                                @endif
                            </div>  
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                                <div class="col mb-5">
                                    <div class="card h-100 shadow-sm">
                                        <!-- Product image-->
                                        <img class="prod-img-top" src="{{ asset('img/home2.jpg') }}" alt="Fancy Product"/>
                                        <!-- Product details-->
                                        <div class="card-body p-4 text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Fancy Product</h5>
                                            <!-- Product price-->
                                            <p class="text-muted">$40.00 - $80.00</p>
                                        </div>
                                        <!-- Product actions-->
                                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                                            <a class="btn btn-outline-dark mt-auto" href="product.php">View options</a>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col mb-5">
                                    <div class="card h-100 shadow-sm">
                                        <!-- Sale badge-->
                                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                        <!-- Product image-->
                                        <img class="prod-img-top" src="{{ asset('img/home2.jpg') }}" alt="Special Item"/>
                                        <!-- Product details-->
                                        <div class="card-body p-4 text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">Special Item</h5>
                                            <!-- Product reviews-->
                                            <div class="d-flex justify-content-center small text-warning mb-2">
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                                <div class="bi-star-fill"></div>
                                            </div>
                                            <!-- Product price-->
                                            <p>
                                                <span class="text-muted text-decoration-line-through">$20.00</span>
                                                $18.00
                                            </p>
                                        </div>
                                        <!-- Product actions-->
                                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                                            <a class="btn btn-outline-dark mt-auto">View options</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                              
                        </div>
                    </div>
                </div>
            </section>
            
        </div>
    </section>      
    @else
    <p class="text-center" style="padding: 70px">Product Not Found.</p>
    @endif
</div>
<script>
    let variations = <?php echo json_encode($data['variations']); ?>;
    let selectedVariation = variations[0];
    let selectedSize = '{{ array_column($data['variations'], 'option_value')[0] }}';

    function updateAvailableQuantity() {
        let availableQuantitySpan = document.getElementById('availableQuantity');
        availableQuantitySpan.textContent = `Available: ${selectedVariation.quantity}`;
        document.getElementById('hiddenAvailableQuantity').value = selectedVariation.quantity;
    }

    function updateQuantityLimits() {
        let quantityInput = document.getElementById('quantity');
        quantityInput.max = selectedVariation.quantity;
        if (parseInt(quantityInput.value) > selectedVariation.quantity) {
            quantityInput.value = selectedVariation.quantity;
        }
        updateAvailableQuantity();
        document.getElementById('hiddenQuantity').value = quantityInput.value;
    }

    function decrementQuantity() {
        let quantityInput = document.getElementById('quantity');
        if (quantityInput.value > 1) {
            quantityInput.value--;
            document.getElementById('hiddenQuantity').value = quantityInput.value;
        }
    }

    function incrementQuantity() {
        let quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) < selectedVariation.quantity) {
            quantityInput.value++;
            document.getElementById('hiddenQuantity').value = quantityInput.value;
        }
    }

    function updateSelectedVariation(size) {
        selectedVariation = variations.find(v => v.option_value === size);
        selectedSize = size;
        updateQuantityLimits();
        document.getElementById('price').textContent = selectedVariation.option_price;
        document.getElementById('hiddenPrice').value = selectedVariation.option_price;
        document.getElementById('hiddenSize').value = size;
        document.getElementById('hiddenAvailableQuantity').value = selectedVariation.quantity;
        document.getElementById('hiddenOptionId').value = selectedVariation.option_id; // Add this line
    }

    // Initial setup
    updateSelectedVariation(selectedSize);

    // Set initial values for size and available quantity
    document.getElementById('hiddenSize').value = selectedSize;
    document.getElementById('hiddenAvailableQuantity').value = selectedVariation.quantity;

    document.querySelectorAll('.size-btn').forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelectorAll('.size-btn').forEach(function(button) {
                button.classList.remove('active');
                button.querySelector('.size-indicator').classList.remove('bg-info');
            });
            this.classList.add('active');
            this.querySelector('.size-indicator').classList.add('bg-info');
            updateSelectedVariation(this.getAttribute('data-size'));
        });
    });

    document.getElementById('quantity').addEventListener('change', function() {
        document.getElementById('hiddenQuantity').value = this.value;
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        // Prevent the form from submitting
        e.preventDefault();

        // Ensure size and available quantity are set
        if (!document.getElementById('hiddenSize').value) {
            document.getElementById('hiddenSize').value = selectedSize;
        }
        if (!document.getElementById('hiddenAvailableQuantity').value) {
            document.getElementById('hiddenAvailableQuantity').value = selectedVariation.quantity;
        }

        // Now submit the form
        this.submit();
    });
</script>
<script>
    $(document).ready(function() {
        var currentImageIndex = 0;
        var images = $('.slider-item img');

        function showImage(index) {
            var imageUrl = $(images[index]).attr('src');
            $('#main-image').attr('src', imageUrl);
        }

        $('.slider-item img').on('click', function() {
            currentImageIndex = $(this).parent().index();
            showImage(currentImageIndex);
        });

        $('.arrow.left').on('click', function() {
            currentImageIndex = (currentImageIndex > 0) ? currentImageIndex - 1 : images.length - 1;
            showImage(currentImageIndex);
        });

        $('.arrow.right').on('click', function() {
            currentImageIndex = (currentImageIndex < images.length - 1) ? currentImageIndex + 1 : 0;
            showImage(currentImageIndex);
        });
    });
</script>

@endsection
