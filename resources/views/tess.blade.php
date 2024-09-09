<!-- resources/views/ecommerce.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce UI</title>
    <!-- Add your CSS styles here -->
</head>
<body>
    <div class="container">
        @if(isset($data['products']) && !empty($data['products']))
            @foreach($data['products'] as $product)
                <div class="product">
                    <img src="{{ $product['thumbnail'] }}" alt="{{ $product['title'] }}">
                    <h2>{{ $product['title'] }}</h2>
                    <p>{{ $product['description'] }}</p>
                    <!-- Other product details -->
                </div>
            @endforeach
        @else
            <p>No products available.</p>
        @endif
    </div>
</body>
</html>
