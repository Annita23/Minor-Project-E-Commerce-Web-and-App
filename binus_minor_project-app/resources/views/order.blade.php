<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - RetroShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f8;
        }
        .order-card {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            margin-bottom: 24px;
            overflow: hidden;
        }
        .order-header {
            background: #212529;
            color: #fff;
            padding: 16px 24px;
        }
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #eef2f6;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">RetroShop</a>
            <div class="d-flex align-items-center">
                @auth
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-white me-2">Hello, {{ Auth::user()->first_name }}</span>
                        
                        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-light fw-bold" style="width: 85px;">
                            Orders
                        </a>

                        <a href="{{ route('cart.index') }}" class="btn btn-sm btn-warning" style="width: 85px;">
                            Cart
                        </a>
                        
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" style="width: 85px;">Log Out</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container py-5" style="max-width: 900px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold mb-1">My Orders</h1>
                <p class="text-muted mb-0">Check the status of your recent purchases</p>
            </div>
            <a href="{{ route('home') }}" class="btn btn-outline-dark rounded-pill px-4">
                ← Continue Shopping
            </a>
        </div>

        @if($orders->isEmpty())
            <div class="card p-5 text-center border-0 shadow-sm rounded-4">
                <h5 class="text-muted mb-0">You haven't placed any orders yet.</h5>
                <div class="mt-3">
                    <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Explore Collection</a>
                </div>
            </div>
        @else
            @foreach($orders as $order)
                <div class="order-card border-0 shadow-sm">
                    <div class="order-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <span class="text-muted small d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">Order ID</span>
                            <span class="fw-bold">#{{ $order->id }}</span>
                        </div>
                        <div>
                            <span class="text-muted small d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">Date Placed</span>
                            <span class="fw-semibold">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <span class="text-muted small d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">Status</span>
                            <span class="badge bg-success text-white text-uppercase px-3 py-1.5 rounded-pill">{{ $order->status }}</span>                        
                        </div>
                    </div>

                    <div class="card-body p-4 bg-white">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td style="width: 70px; padding-left: 0;">
                                                @php
                                                    // Récupère l'image (seeder ou upload)
                                                    $rawImage = $item->product->image ?? $item->product->image_url ?? '';
                                                    
                                                    if (!empty($rawImage)) {
                                                        // Si c'est une URL directe (https://...) du seeder
                                                        if (str_starts_with($rawImage, 'http://') || str_starts_with($rawImage, 'https://')) {
                                                            $imgUrl = $rawImage;
                                                        } else {
                                                            // Si c'est une image locale stockée
                                                            $imgUrl = "http://10.60.76.34:8000/" . $rawImage;
                                                        }
                                                    } else {
                                                        $imgUrl = 'https://via.placeholder.com/60';
                                                    }
                                                @endphp
                                                <img src="{{ $imgUrl }}" alt="Product" class="product-img">
                                            </td>
                                            <td>
                                                <h6 class="mb-0 fw-bold text-dark">{{ $item->product->name ?? 'Product Unavailable' }}</h6>
                                                <small class="text-muted">Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                                            </td>
                                            <td class="text-end fw-semibold text-dark" style="padding-right: 0;">
                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                            <span class="fw-bold text-muted">Total Amount</span>
                            <span class="fs-4 fw-bold text-success">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</body>
</html>