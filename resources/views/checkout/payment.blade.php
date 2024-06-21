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
            <a class="nav-link" href="/sales-report">Sales Report</a>
        </div>
        <div class="navbar-right">
            <a href="/logout">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h1>Step 1: Select Payment Method</h1>
        
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="payment-options">
                <div class="payment-option">
                    <input type="radio" id="payment_method_transfer" name="payment_method" value="transfer">
                    <label for="payment_method_transfer">Bank Transfer</label>
                    <p>Pay via bank transfer. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="payment-option">
                    <input type="radio" id="payment_method_paypal" name="payment_method" value="paypal">
                    <label for="payment_method_paypal">PayPal</label>
                    <p>Pay via PayPal. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class="payment-option">
                    <input type="radio" id="payment_method_credit_card" name="payment_method" value="credit_card">
                    <label for="payment_method_credit_card">Credit Card</label>
                    <p>Pay with your credit card. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="checkout-button">
                <button type="submit">Continue to Checkout</button>
            </div>
        </form>
    </div>
    
    <script>
        document.getElementById('bank_transfer').addEventListener('change', function() {
            document.getElementById('continueBtn').disabled = !this.checked;
        });
    </script>
</body>
</html>
