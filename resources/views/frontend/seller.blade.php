@extends('layout.nav')
@section('title')
    Become a seller
@endsection
@section('content')

    <!-- Intro Section -->
    <section class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Start Selling With Us</h1>
                    <p>Join our platform and reach millions of customers worldwide. Grow your business with ease and efficiency.</p>
                    <a href="#seller-form" class="btn btn-primary btn-lg">Apply Now</a>
                </div>
            </div>
        </div>
    </section>


    @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

    <!-- Seller Benefits Section -->
    <section class="seller-benefits">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Why Sell With Us?</h2>
                    <p class="lead">Join our platform and start selling to millions of customers.</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4 text-center">
                    <div class="benefit-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>Grow Your Business</h4>
                    <p>Reach millions of customers and grow your sales with our powerful tools.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="benefit-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h4>Easy to Use</h4>
                    <p>Our seller dashboard is intuitive and easy to use, even for beginners.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="benefit-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p>Get help whenever you need it with our dedicated support team.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Seller Signup Form Section -->
    <section id="seller-form" class="seller-form">
        <div class="container w-50 shadow p-3 rounded-3">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <h2 class="text-center">Become a Seller</h2>
                    <form action="{{ route('seller.apply') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your full name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Phone Number</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter your phone number" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="business">Business Name</label>
                            <input type="text" class="form-control @error('business') is-invalid @enderror" id="business" name="business" placeholder="Enter your business name" required>
                            @error('business')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="category">Business Category</label>
                            <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="Fashion">Fashion</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Home & Kitchen">Home & Kitchen</option>
                                <option value="Beauty & Personal Care">Beauty & Personal Care</option>
                                <option value="Sports & Outdoors">Sports & Outdoors</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="message">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4" placeholder="Please give your reason to sell the product with us"></textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Apply Now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection