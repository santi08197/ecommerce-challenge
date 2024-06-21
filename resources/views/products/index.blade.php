<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a class="nav-link" href="/dashboard">Home</a>
            <a class="nav-link" href="/products">Productos</a>
            <a class="nav-link" href="/sales-report">Sales Report</a>
        </div>
        <div class="navbar-right">
            <a href="/cart">Cart
                @php
                    $cartItems = json_decode(Cookie::get('cart_items', '[]'), true);
                    $cartCount = count($cartItems);
                @endphp
                @if ($cartCount > 0)
                    ({{ $cartCount }})
                @endif
            </a>
            <a class="nav-link" href="/logout">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h1>Products</h1>
        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <a href="{{ route('products.show', ['id' => $product['id']]) }}">
                        <img src="{{ $product['images'][0] }}" alt="{{ $product['title'] }}">
                        <h2>{{ $product['title'] }}</h2>
                        <p>${{ $product['price'] }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
