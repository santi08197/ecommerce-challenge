<!DOCTYPE html>
<html>
<head>
    <title>Detalles del Producto - {{ $product['title'] }}</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-left">
            <a class="navbar-brand" href="/">MyApp</a>
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

    <div class="container product-details">
        <img src="{{ $product['images'][0] }}" alt="{{ $product['title'] }}">
        <h1>{{ $product['title'] }}</h1>
        <p>Precio: ${{ $product['price'] }}</p>
        <p>Descripción: {{ $product['description'] }}</p>

            

        <div class="buttons mt-3">
            <form action="{{ route('cart.add', ['id' => $product['id'],'action' => 'checkout']) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-buy">Comprar</button>
            </form>
            <form action="{{ route('cart.add', ['id' => $product['id'],'action' => 'cart']) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-add-cart">Agregar al Carrito</button>
            </form>
        </div>
    </div>

</body>
</html>
