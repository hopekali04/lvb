@extends('layouts.app')
<head>
    <link href="{{ asset('css/banner.css') }}" rel="stylesheet">
</head>
@section('content')
@include('layouts.partials.banner', [
        'bannerImage' => asset('img/dis3.jpg'),
        'bannerTitle' => 'Cart',
        'bannerDescription' => 'This is where you connect with our team and get started with any of your projects'
    ])
<div class="container" id="content-pad">            
    <h2>Your Cart</h2>
    @if(Session::has('cart'))
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td><img src="{{ $item['thumbnail'] }}" width="50" height="50"></td>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['size'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] }}</td>
                         <td>{{ $item['price'] * $item['quantity'] }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total-price">
            <h3>Total: MWK {{ array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart)) }}</h3>
        </div>
        <a href="{{ route('checkout') }}" class="btn btn-dark">Proceed to Checkout</a>
            <form action="{{ route('cart.clear') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger">Clear Cart</button>
            </form>
    @else
        <div class="text-center" style="padding: 100px;">
            <h3>Your cart is empty.</h3>
            <h4>You don't have any items in your cart.</h4>
            Have an account? Sign in to see your items.
        </div>
    @endif
</div>
@include('layouts.partials.small_newsletter')
@endsection
