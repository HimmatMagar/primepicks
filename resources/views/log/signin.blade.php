<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            width: 53%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="container shadow-lg rounded p-4 mt-5">
                <h2 class="text-center mb-4">Primepicks</h2>
                <form action="" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="signinEmail">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="signinEmail" placeholder="Enter email" autocomplete="current-email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="signinPassword">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="signinPassword" placeholder="Password" autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success w-100">Login</button>
                </form>
                <p class="mt-3 text-center">Don't have an account? <a href="{{ route('signupPage') }}">Sign up here</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>