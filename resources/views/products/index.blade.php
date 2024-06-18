<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a class="navbar-brand" href="/">MyApp</a>
            <a class="nav-link" href="/">Home</a>
            <a class="nav-link" href="/products">Productos</a>
            <a class="nav-link" href="/about">Información</a>
        </div>
        <div class="navbar-right">
            <a class="nav-link" href="/logout">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="content">
            <h1>Products</h1>
            <div class="cards">
                @foreach ($products as $product)
                    {{ print_r($product['images'][0]) }} 
                    <div class="card">
                        <img src="{{ $product['images'][0] }}" alt="{{ $product['title'] }}">
                        <div class="card-body">
                            <h2 class="card-title">{{ $product['title'] }}</h2>
                            <p class="card-price">${{ $product['price'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
