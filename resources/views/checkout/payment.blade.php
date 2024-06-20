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
        <h1>Step 1: Select Payment Method</h1>
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Select Payment Method:</label><br>
                <label for="bank_transfer">Bank Transfer</label>
                <input type="checkbox" name="payment_method" value="Bank Transfer" id="bank_transfer">
            </div>
            <button type="submit" class="btn" disabled id="continueBtn">Continue to Review</button>
        </form>
    </div>
    
    <script>
        document.getElementById('bank_transfer').addEventListener('change', function() {
            document.getElementById('continueBtn').disabled = !this.checked;
        });
    </script>
</body>
</html>
