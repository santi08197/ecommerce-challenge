<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a class="navbar-brand" href="/">MyApp</a>
            <a class="nav-link" href="/">Home</a>
            <a class="nav-link" href="/products">Productos</a>
            <a class="nav-link" href="/sales-report">Sales Report</a>
        </div>
        <div class="navbar-right">
            <a class="nav-link" href="/logout">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="content">
            <h1>Dashboard</h1>
            {{-- <p>Welcome, {{ Auth::user()->name }}!</p> --}}
        </div>
    </div>
</body>
</html>
