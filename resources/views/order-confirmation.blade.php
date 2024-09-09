@extends('layouts.HeadShop')

@section('content')
<div class="container py-5">
    <!-- TODO: ADD ORDER SUMMARY -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <h2 class="card-title">Order Confirmation</h2>
                    <svg width="129px" height="129px" viewBox="0 0 512.00 512.00" xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:none;stroke:#06c61c;stroke-linecap:round;stroke-linejoin:round;stroke-width:16.384;}</style> </defs> <g data-name="Layer 2" id="Layer_2"> <g data-name="E408, Success, Media, media player, multimedia" id="E408_Success_Media_media_player_multimedia"> <circle class="cls-1" cx="256" cy="256" r="246"></circle> <polyline class="cls-1" points="115.54 268.77 200.67 353.9 396.46 158.1"></polyline> </g> </g> </g></svg>

                    <p class="card-text">Your order has been successfully placed!</p>
                    <p class="card-text">Order ID: {{ $order->id }}</p>
                    <p class="card-text">Total Amount: {{ $order->total_amount }}</p>
                    <p class="card-text">Order Status: {{ $order->status }}</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection