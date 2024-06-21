<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="/">Home</a>
            <a href="/products">Products</a>
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
            <a href="/logout">Logout</a>
        </div>
    </nav>

    @yield('content')

    @yield('scripts')
</body>
</html>