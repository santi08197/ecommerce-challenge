<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="/">Home</a>
            <a href="/products">Products</a>
            <a class="nav-link" href="/sales-report">Sales Report</a>
        </div>
        <div class="navbar-right">
            <a href="/logout">Logout</a>
        </div>
    </nav>
    <div class="container">
        <h1>Step 2: Review Order</h1>
        <p><b>Selected Payment Method:</b> {{ $paymentMethod }}</p>
    
        <h2>Products</h2>
        @if(empty($cartItems))
            <p>Your cart is empty.</p>
        @else
            <div class="cart-items">
                @php
                    $total = 0;
                @endphp
                @foreach ($cartItems as $productId => $item)
                    <div class="cart-item">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                        <div class="item-details">
                            <h3>{{ $item['title'] }}</h3>
                            <p>Price: ${{ $item['price'] }}</p>
                            <p>Quantity: {{ $item['quantity'] }}</p>
                        </div>
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp 
                    </div>
                @endforeach
            </div>
            <div class="cart-total">
                <div class="total-label">Total:</div>
                <div class="total-amount">${{ $total }}</div>
            </div>
            <div class="cart-actions">
                <form action="{{ route('checkout.purchase') }}" method="POST">
                    @csrf
                    <button type="submit">Confirm Purchase</button>
                </form>
            </div>
        @endif
    </div>
    
   
</body>
</html>
