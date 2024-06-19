<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="/">Home</a>
            <a href="/products">Products</a>
            <a href="/info">Information</a>
        </div>
        <div class="navbar-right">
            <a href="/logout">Logout</a>
        </div>
    </nav>
    {{-- {{dd($cartItems)}} --}}
    <div class="container">
        <h1>Shopping Cart</h1>
        @if(empty($cartItems))
            <p>Your cart is empty.</p>
        @else
            <div class="cart-items">
                @foreach ($cartItems as $productId => $item)
                    <div class="cart-item">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                        <div class="item-details">
                            <h3>{{ $item['title'] }}</h3>
                            <p>Price: ${{ $item['price'] }}</p>
                            <p>Quantity: {{ $item['quantity'] }}</p>
                            <form action="{{ route('cart.remove', ['productId' => $productId]) }}" method="POST">
                                @csrf
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
