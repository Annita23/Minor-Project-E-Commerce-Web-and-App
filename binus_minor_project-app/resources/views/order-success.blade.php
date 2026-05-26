<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - RetroShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(180deg, #f4f6f8 0%, #eef2f7 100%);
        }
        .success-card {
            max-width: 620px;
            margin: 0 auto;
            border-radius: 28px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="success-card bg-white p-5 text-center">
        <div class="display-4 mb-3">✅</div>
        <h1 class="fw-bold mb-3">Payment Successful</h1>
        <p class="text-muted fs-5 mb-4">Your order has been placed successfully.</p>
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg rounded-pill px-4">
            Back to Shop
        </a>
    </div>
</div>
</body>
</html>
