@extends('layouts.headShop')

@section('content')

<!-- Failed Payment View -->
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <h2 class="card-title mt-2">Payment Failed</h2>
                <div class="card-body">
                    <svg width="129px" height="129px" viewBox="0 0 14.00 14.00" xmlns="http://www.w3.org/2000/svg" fill="#ff0000" stroke="#ff0000" stroke-width="0.00014"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill-rule="evenodd"> <path d="M0 7a7 7 0 1 1 14 0A7 7 0 0 1 0 7z"></path> <path d="M13 7A6 6 0 1 0 1 7a6 6 0 0 0 12 0z" fill="#ffffff" style="fill: var(--svg-status-bg, #ffffff);"></path> <path d="M7 5.969L5.599 4.568a.29.29 0 0 0-.413.004l-.614.614a.294.294 0 0 0-.004.413L5.968 7l-1.4 1.401a.29.29 0 0 0 .004.413l.614.614c.113.114.3.117.413.004L7 8.032l1.401 1.4a.29.29 0 0 0 .413-.004l.614-.614a.294.294 0 0 0 .004-.413L8.032 7l1.4-1.401a.29.29 0 0 0-.004-.413l-.614-.614a.294.294 0 0 0-.413-.004L7 5.968z"></path> </g> </g></svg>
                    <h5>Sorry, your payment was declined.</h5>
                    <p>The transaction was declined by your Payment Method. Please try again with a different payment method.</p>
                    <p>Order ID: {{ $order->id }}</p>
                    <!--  <a href="route('orders.retry', $order->id) " class="btn btn-primary">Try Again</a>
                        -->
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection