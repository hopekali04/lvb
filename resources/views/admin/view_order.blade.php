@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@extends('layouts.logged')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Order #{{ $order->id }}</h1>
            <div class="mt-3">
                <a href="{{ route('orders') }}" class="btn btn-secondary">Back to Orders</a>
                @if($order->status !== 'Confirmed')
                    <form action="{{ route('confirm.order', $order->id) }}" method="POST" style="display: inline;" onsubmit="return confirmOrder(event)">
                        @csrf
                        <button type="submit" class="btn btn-success">Confirm Shipping</button>
                    </form>
                @endif
            </div>
            <div class="card mb-4">
                <div class="card-header">Order Details</div>
                <div class="card-body">
                    <p><strong>Customer Email:</strong> {{ $order->email }}</p>
                    <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
                    <p><strong>Payment URL:</strong> {{ $order->checkout_url }}</p>
                    <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                    <p><strong>Status:</strong> {{ $order->status }}</p>
                    <p><strong>Is Shipped:</strong> {{ $order->is_shipped ? 'YES' : 'NO' }}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Order Items</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Variation</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderItems as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->variation_name }}: {{ $item->option_value }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total:</th>
                                <th>${{ number_format($order->total_amount, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <a href="{{ route('orders') }}" class="btn btn-secondary mt-3">Back to Orders</a>
        </div>
    </div>
</div>
<script>
    function confirmOrder(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to confirm this order? This Action Is Irrevesible')) {
            event.target.submit();
        }
        return false;
    }
</script>
@endsection