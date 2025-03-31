<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/logo.png') }}" width="80" height="80" style="mix-blend-mode: multiply;" alt="PrimePicks">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="form-inline mx-auto" action="{{ route('home') }}" method="GET">
                <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link {{ request() -> is('/') ? 'nav-active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request() -> is('become a seller') ? 'nav-active' : '' }}" href="{{ route('seller') }}">Become a Seller</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request() -> is('help and support') ? 'nav-active ' : '' }}" href="{{ route('help') }}">Help & Support</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item" id="shoppingCart">
                        <a class="nav-link {{ request()->is('cart') ? 'nav-active' : '' }}" href="{{ route('cart') }}">
                            <i class="fas fa-shopping-cart"></i>
                            @if(session('cart_count') > 0)
                                <span class="cart-count">{{ session('cart_count') }}</span>
                            @endif
                        </a>
                    </li>
                @else
                    <li class="nav-item" id='loginSignup'>
                        <a class="nav-link" href="{{ route('signupPage') }}">Signup | Login</a>
                    </li>
                @endif
                    
                <li class="nav-item dropdown" id="side">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if (Auth::check())
                          {{ Auth::user() -> name }}'s account
                      @else
                          user's account
                      @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('profile') }}">Orders</a>
                       
                            @if (Gate::allows('isSeller'))
                                <a class="dropdown-item" id="sell" href="{{ route('product.index') }}">Sell Product</a>
                            @endif    

                        <div class="dropdown-divider"></div>
                       <form action="{{ route('logout') }}" method="POST">
                        @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                       </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
@yield('content')
        <!-- Footer -->
        <footer class="footer mt-5">
            <div class="container">
                <p>&copy; 2023 PrimePicks. All rights reserved.</p>
            </div>
        </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>