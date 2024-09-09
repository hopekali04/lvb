<!-- resources/views/ecommerce.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce UI</title>
    <!-- Add your CSS styles here -->
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        @if(isset($data['products']) && !empty($data['products']))
            @foreach($data['products'] as $product)
                <div class="product">
                    <!--<h2> $product['title'] </h2>
                    <p> $product['handle'] </p>
                    <pre>print_r($product, true) </pre>
                     Other product details -->
                </div>
        <div class="row h-40 g-2 py-1">
        <div class="col-md-4">
            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="{{ $product['thumbnail'] }}" alt="Thumbnail" />
            <!-- <img src=" $product['products'][0]['thumbnail'] " alt="Thumbnail">  -->
            <div class="card-img-overlay bg-dark-gradient">
              <div class="d-flex align-items-end justify-content-center h-100"><a class="btn btn-lg text-light fs-1" href="/product/{{ $product['id'] }}" role="button">{{ $product['title'] }}
                  <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                  </svg></a></div>
            </div>
          </div>
        </div>
      </div>
            @endforeach
        @else
            <p>No collections available.</p>
        @endif
    </div>
</body>
</html>
