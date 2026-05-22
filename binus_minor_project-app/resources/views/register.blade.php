<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RetroShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center py-5">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
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
                    <h2 class="text-center mb-4">👕 Create Account</h2>

                    <form action="{{ url('/register') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number (Optional)</label>
                            <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password (mini 8 characters)</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 btn-lg">Register</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="text-muted text-decoration-none">Already have an account? Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>