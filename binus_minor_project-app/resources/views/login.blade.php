<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RetroShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                
                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow p-4 bg-white rounded">
                    <h2 class="text-center mb-4">RetroShop Login</h2>

                    <form action="{{ url('/login') }}" method="POST">
                        @csrf 
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required placeholder="test@example.com">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required placeholder="••••••••">
                        </div>

                        <button type="submit" class="btn btn-dark w-100 btn-lg">Sign In</button>

                        <div class="text-center mt-4">
                            <span class="text-muted">Don't have an account?</span> 
                            <a href="{{ route('register') }}" class="text-dark fw-bold text-decoration-none">Sign Up</a>
                        </div>
                    </form>

                    <div class="text-center mt-4 border-top pt-3">
                        <a href="{{ route('home') }}" class="text-muted text-decoration-none">← Back to shop</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</body>
</html>