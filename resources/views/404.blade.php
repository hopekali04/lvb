<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="jumbotron text-center">
            <h1 class="display-4">404 Not Found</h1>
            <p class="lead">The page you requested could not be found.</p>
            <hr class="my-4">
            <p>Sorry, but the page you are looking for has either been moved or does not exist.</p>
            <a class="btn btn-primary btn-lg" href="{{ url('/') }}" role="button">Go to Homepage</a>
        </div>
    </div>
</body>
</html>
