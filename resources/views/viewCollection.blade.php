@extends('layouts.headShop')

@section('title', 'Collection')

@section('content')
    <!-- Banter for shop -->
    <div style="width: 100vw; height:45vh; background-image: url('{{ asset('img/coll.jpg') }}');
        background-size: cover; background-position: center;
        font-family: Montserrat, sans-serif;
        margin-top: -4px;"
        >
        <div class="d-flex align-items-center justify-content-start h-100" style="padding: 2rem; padding-left: 10vw;">
            <div>
                <h2 style="color: #000000;font-size: 3rem;"><strong>Shop</strong></h2>
                <p style="color: #D27F2D;font-size: 1.2rem;"><span style="color: grey">Home</span> &nbsp; > &nbsp; Collections
                </p>
            </div>
        </div>
    </div>

    <!-- Section-->
    <section class="py-1" >
        @if (!empty($data))
            @foreach($data as $category)
            <div class="text-start px-4 border-bottom">
                LoveBuilds > 
                <span style="color: grey">Shop</span> > 
                <span style="color: #DD7907">{{ $category['category_name'] }}</span>
            </div>
                <div class="container px-4 px-lg-5 mt-3">
                    <header class="section-heading" style="margin-bottom:30px; font-family: Montserrat, sans-serif;">
                        <h2 class="section-title" style="font-size: 2rem;"><strong>{{ $category['category_name'] }}</strong> Collection</h2>
                    </header>
                    <div class="row">
                        @if (!empty($category['products']))
                            @foreach($category['products'] as $product)
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                                    <div class="product text-left">
                                        <div class="position-relative mb-3">
                                            <a href="/product/{{ $product['product_id'] }}">
                                                <img class="img-fluid w-100" src="{{ asset($product['product_thumbnail']) }}" alt="...">
                                            </a>
                                        </div>
                                        <h5 class="fw-bolder"> 
                                            <a href="/product/{{ $product['product_id'] }}" style="text-decoration: none; color: black;">
                                            {{ $product['product_name'] }}</a>
                                        </h5>
                                        <div class="price"><h5 class="mt-2" style="color: grey">{{ $category['category_name'] }}</h5></div>                                   
                                        <div class="price text-success"><h5 class="mt-2 mb-4">MWK {{ number_format($product['base_price']) }}</h5></div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                            <p class="text-center" style="padding: 50px">Sorry, No products Are Currently in Stock For This Collection, Check Later Please.</p>
                            <div class="text-center">
                                <a href="{{ route('shop') }}" class="btn btn-primary">Return To Shop</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center" style="padding: 50px">No products Are Currently Stock For This Collection, Check Later Please.</p>
            <div class="text-center">
                <a href="{{ route('shop') }}" class="btn btn-primary">Return To Shop</a>
            </div>
        @endif
        @include('layouts.partials.smallbanner')
       @include('layouts.partials.newsletter')
    </section>
@endsection
