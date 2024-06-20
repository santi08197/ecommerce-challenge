<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
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

    <div class="container">
        <h1>Thank You for Your Purchase!</h1>
        <p>Your order has been successfully processed.</p>
        <a href="/products">Back to Products</a>
    </div>
</body>
</html>
