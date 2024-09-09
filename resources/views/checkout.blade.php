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
                @csrf
                <div class="row gy-3">
                    <div class="col-lg-6">
                        <label class="form-label" for="first_name">First name</label>
                        <input class="form-control" type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" for="last_name">Last name</label>
                        <input class="form-control" type="text" id="last_name" name="last_name" required>
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
                    <input type="hidden" id="amount" name="amount" value="{{ $total }}">
                    <input type="hidden" id="currency" name="currency" value="MWK">
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

<script>
    function makePayment() {
        const form = document.getElementById('checkoutForm');
        const formData = new FormData(form);
        const cart = {!! json_encode($cart) !!}; // Convert the cart data to JSON
    
        // Add validation
        const requiredFields = [
            'first_name',
            'last_name',
            'email',
            'phone',
            'address',
            'city',
            'country'
        ];
    
        let isValid = true;
        requiredFields.forEach(field => {
            if (!form[field].value.trim()) {
                isValid = false;
            }
        });

    
        if (!isValid) {
            alert(`Please fill in the All the fields`);
            return
        };
    
        cart.forEach((item, index) => {
            formData.append(`cart[${index}][option_id]`, item.option_id);
            formData.append(`cart[${index}][quantity]`, item.quantity);
            formData.append(`cart[${index}][price]`, item.price);
        });
    
        fetch('{{ route("process.checkout") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => {
            console.log(response);
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                return response.json();
            }
        })
        .then(data => {
            if (data && data.error) {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing your payment. Please try again.');
        });
    }
    </script>
@endsection