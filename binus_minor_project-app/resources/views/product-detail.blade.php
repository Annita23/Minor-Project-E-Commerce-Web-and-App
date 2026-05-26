<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - RetroShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="anonymous" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('home') }}" class="btn btn-secondary mb-4">⬅️ Back to Shop</a>

        <div class="row bg-white p-4 rounded shadow-sm">
            <div class="col-md-6">
                <img src="{{ $product->image_url ?? 'https://via.placeholder.com/400' }}" class="img-fluid rounded" alt="{{ $product->name }}">
            </div>
            
            <div class="col-md-6 d-flex flex-column justify-content-between">
                <div>
                    <h1 class="mb-3">{{ $product->name }}</h1>
                    <h3 class="text-success mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                    <hr>
                    <h5>Description:</h5>
                    <p class="text-muted fs-5">{{ $product->description }}</p>
                    <p class="mt-3"><strong>Available Stock:</strong> {{ $product->stock }} pcs</p>
                </div>

                <div class="mt-4">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>