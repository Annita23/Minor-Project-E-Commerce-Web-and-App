<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
        <div class="mb-3">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Clear Cart</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>
                            <img src="{{ asset($item['image']) }}" width="70" alt="{{ $item['name'] }}">
                        </td>
                        <td>{{ $item['name'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width:90px;">
                                <button class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <h4 class="mt-4">Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>
    @else
        <div class="alert alert-info">Your cart is empty.</div>
    @endif

    <div class="mt-4 d-flex gap-2">
    <a href="{{ route('checkout') }}" class="btn btn-success btn-lg px-4">
        Proceed to Checkout
    </a>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg px-4">
        Continue Shopping
    </a>
</div>
</div>
</body>
</html>
