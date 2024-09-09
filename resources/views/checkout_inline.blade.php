<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    let token = document.head.querySelector('meta[name="csrf-token"]');

    if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    console.log("token found", token.content)
    } else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }
</script>
@extends('layouts.app')

@section('content')
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Checkout</h1>
        </div>
    </div>
</header>
@if(empty($cart))
    <div class="text-center" style="padding: 100px;">
        <h3>Your cart is empty.</h3>
        <h4>You don't have any items in your cart.</h4>
        <a href="{{ route('shop') }}" class="btn btn-primary">Shop Now</a>
    </div>
@else
<div class="container" style="margin-top:40px; margin-bottom:40px;">
    <div id="wrapper"></div>
    <div class="row">
        <!-- Left -->
        <div class="col-lg-9">
            <form id="checkoutForm">
                <div class="row gy-3">
                    <div class="col-lg-6">
                        <label class="form-label" for="firstName">First name</label>
                        <input class="form-control" type="text" id="firstName" name="firstName" required>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="lastName">Last name</label>
                        <input class="form-control" type="text" id="lastName" name="lastName" required>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="email">Email address</label>
                        <input class="form-control" type="email" id="email" name="email" required>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="phone">Phone number</label>
                        <input class="form-control" type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-label" for="address">Address</label>
                        <input class="form-control" type="text" id="address" name="address" required>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="city">City</label>
                        <input class="form-control" type="text" id="city" name="city" required>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="country">Country</label>
                        <input class="form-control" type="text" id="country" name="country" required>
                    </div>
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-primary" onclick="makePayment()">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Right -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    @foreach($cart as $item)
                        <p>{{ $item['title'] }} (x{{ $item['quantity'] }}): ${{ $item['price'] * $item['quantity'] }}</p>
                    @endforeach
                    <hr>
                    <h6>Total: ${{ $total }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<script src="https://in.paychangu.com/js/popup.js"></script>
<script>
function makePayment() {
    const form = document.getElementById('checkoutForm');
    const formData = new FormData(form);
    formData.append('amount', '{{ $total }}');

    axios.post('{{ route("checkout.process") }}', formData)
        .then(response => {
            // console.log('Response:', response);
            const data = response.data;
            if (data.success) {
                console.log(token.content)
                PaychanguCheckout({
                    "public_key": "secret Key",
                    "tx_ref": '' + Math.floor((Math.random() * 1000000000) + 1),
                    "amount": data.data.amount,
                    "currency": "MWK",
                    "callback_url": "https://paychangu.readme.io/reference/inline-js",
                    "return_url": "https://paychangu.readme.io/reference/inline-js",
                    "customer": {
                        "email": data.data.email,
                        "first_name": data.data.firstName,
                        "last_name": data.data.lastName
                    },
                    "customization": {
                        "title": "Test Payment",
                        "description": "Payment Description"
                    },
                    "meta": {
                        "uuid": "uuid",
                        "response": "Response"
                    }
                });
            } else {
                console.error('Error processing order:', data.message);
                alert('Error processing order: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.response) {
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.error('Response data:', error.response.data);
                console.error('Response status:', error.response.status);
                console.error('Response headers:', error.response.headers);
                alert('Error: ' + JSON.stringify(error.response.data));
            } else if (error.request) {
                // The request was made but no response was received
                console.error('Request:', error.request);
                alert('No response received from server');
            } else {
                // Something happened in setting up the request that triggered an Error
                console.error('Error message:', error.message);
                alert('Error: ' + error.message);
            }
        });
}
</script>
@endsection