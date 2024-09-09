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
        @if(isset($data['collections']) && !empty($data['collections']))
            @foreach($data['collections'] as $product)
                <div class="product">
                    <h2>{{ $product['title'] }}</h2>
                    <p>{{ $product['handle'] }}</p>
                    <pre>{{ print_r($product, true) }}</pre>
                    <!-- Other product details -->
                </div>
            @endforeach
        @else
            <p>No collections available.</p>
        @endif
    </div>
</body>
</html>
