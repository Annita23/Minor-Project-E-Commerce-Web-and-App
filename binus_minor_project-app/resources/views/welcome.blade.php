<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Clothing E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom-cart:hover {
            background-color: #ca9504 !important; /* Un jaune orangé plus sombre au survol */
            border-color: #be8c04 !important;
            color: #000 !important;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">RetroShop</a>
            
            <div class="d-flex align-items-center">
                @auth
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-white me-2">Hello, {{ Auth::user()->first_name }}</span>

                        <a href="{{ route('cart.index') }}" class="btn btn-sm btn-warning btn-custom-cart" style="width: 85px;">
                            Cart
                        </a>
                        
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" style="width: 85px;">Log Out</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>

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
                            
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fs-5 fw-bold text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary btn-sm">View Product</a>
                                </div>

                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>