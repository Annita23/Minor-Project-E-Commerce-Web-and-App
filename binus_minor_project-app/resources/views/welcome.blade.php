<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Clothing E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">👕 RetroShop</a>
            <span class="navbar-text text-white">Group Project</span>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="text-center mb-5">Our Clothing Collection</h1>

        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300' }}" class="card-img-top" alt="{{ $product->name }}" style="height: 450px; object-fit: cover;">
                        
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">
                                    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark fw-bold">
                                        {{ $product->name }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted text-truncate">{{ $product->description }}</p>
                            </div>
                            
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <span class="fs-5 fw-bold text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary btn-sm">View Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>