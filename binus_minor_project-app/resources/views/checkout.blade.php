<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - RetroShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        body {
            background: #f4f6f8;
        }
        .page-shell {
            max-width: 1200px;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 24px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
        }
        .section-title {
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        .muted-label {
            color: #64748b;
            font-size: 0.92rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
        }
        .pay-option {
            border: 1px solid #dbe3ea;
            border-radius: 18px;
            padding: 14px 16px;
            transition: 0.2s ease;
            cursor: pointer;
            background: #fff;
        }
        .pay-option:hover {
            border-color: #9fb4c7;
            transform: translateY(-1px);
        }
        .pay-option input {
            transform: scale(1.1);
        }
        .summary-item {
            border-bottom: 1px solid #eef2f6;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }
        .summary-item:last-child {
            border-bottom: 0;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .btn-primary {
            background: #111827;
            border-color: #111827;
        }
        .btn-primary:hover {
            background: #000;
            border-color: #000;
        }
    </style>
</head>
<body>

<div class="container py-5 page-shell">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="section-title mb-1">Checkout</h1>
            <p class="text-muted mb-0">Complete your order securely</p>
        </div>
        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            ← Back to Cart
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="glass-card p-4 p-md-5">
                <h4 class="section-title mb-4">Shipping Details</h4>

                <form action="{{ route('place.order') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="muted-label">Full Name</label>
                        <input type="text" name="name" class="form-control form-control-lg rounded-4" placeholder="Enter your full name" required>
                    </div>

                    <div class="mb-3">
                        <label class="muted-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control form-control-lg rounded-4" placeholder="Enter your phone number" required>
                    </div>

                    <div class="mb-4">
                        <label class="muted-label">Address</label>
                        <textarea name="address" rows="4" class="form-control rounded-4" placeholder="Enter your complete address" required></textarea>
                    </div>

                    <h4 class="section-title mb-3">Payment Method</h4>
                    <p class="text-muted mb-3">Choose how you would like to pay</p>

                    <div class="d-grid gap-3 mb-4">
                        <label class="pay-option d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <input type="radio" name="payment_method" value="mybca" checked>
                                <div>
                                    <div class="fw-semibold">MyBCA</div>
                                    <small class="text-muted">Transfer directly from BCA mobile banking</small>
                                </div>
                            </div>
                            <span class="badge text-bg-light border">Popular</span>
                        </label>

                        <label class="pay-option d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <input type="radio" name="payment_method" value="debit">
                                <div>
                                    <div class="fw-semibold">Debit Card</div>
                                    <small class="text-muted">Pay using your debit card</small>
                                </div>
                            </div>
                        </label>

                        <label class="pay-option d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <input type="radio" name="payment_method" value="credit">
                                <div>
                                    <div class="fw-semibold">Credit Card</div>
                                    <small class="text-muted">Visa / Mastercard supported</small>
                                </div>
                            </div>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-semibold">
                        Pay Now
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="glass-card p-4 p-md-5 sticky-top" style="top: 24px;">
                <h4 class="section-title mb-4">Order Summary</h4>

                @if(count($cart) > 0)
                    @foreach($cart as $item)
                        <div class="summary-item d-flex align-items-start justify-content-between gap-3">
                            <div class="d-flex gap-3">
                                <img src="{{ $item['image'] ?? 'https://via.placeholder.com/80' }}" alt="{{ $item['name'] }}" width="74" height="74" class="rounded-4 border object-fit-cover">
                                <div>
                                    <div class="fw-semibold">{{ $item['name'] }}</div>
                                    <div class="text-muted small">Qty: {{ $item['quantity'] }}</div>
                                </div>
                            </div>
                            <div class="fw-semibold text-success text-nowrap">
                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <span class="fs-5 fw-semibold">Total</span>
                        <span class="fs-4 fw-bold text-success">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                @else
                    <div class="alert alert-warning mb-0 rounded-4">
                        Your cart is empty.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

</body>
</html>