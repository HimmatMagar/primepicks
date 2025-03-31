@extends('layout.nav')
@section('title')
    Home
@endsection
@section('content')


@if (session('status'))
    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
@endif

    <!-- Hero Section -->
    <div class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-ride="carousel">
            <!-- Carousel Slides -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/image1.avif') }}" class="d-block w-100" alt="Hero Image 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Welcome to PrimePicks</h1>
                        <p>Your one-stop shop for the best deals!</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/image2.avif') }}" class="d-block w-100" alt="Hero Image 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Explore Our Electronics</h1>
                        <p>Discover the latest gadgets and devices.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/image3.avif') }}" class="d-block w-100" alt="Hero Image 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Fashion for Everyone</h1>
                        <p>Trendy outfits for men, women, and kids.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/image4.avif') }}" class="d-block w-100" alt="Hero Image 4">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Upgrade Your Home</h1>
                        <p>Find the best appliances and decor.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Sections -->
    <div class="container mt-5">
        @if ($query)
            <section class="category-section shadow-lg rounded p-3">
                <h2 class="section-title fs-4 text-center text-md-start">Your Search Result '{{ $query }}'</h2>
                <div class="row">
                    @foreach ($allProduct as $product)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                <a href="{{ route('product.view', $product -> id) }}" class="text-decoration-none">
                                    <div class="card product-card">
                                        <img src="{{ asset('storage/uploads/' . $product->image) }}" class="card-img-top" loading="lazy" alt="{{ $product->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title fs-6 text-truncate">{{ $product->name }}</h5>
                                            <p class="fs-6 fw-bold text-primary">{{ $product->price }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    @endforeach
                    <div class="m-3 text-center">
                        {{ $allProduct->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </section>
        @else 
        <section class="category-section shadow-lg rounded p-3">
            <h2 class="section-title fs-4 text-center text-md-start">Electronics</h2>
            <div class="row">
                @foreach ($allProduct as $product)
                    @if ($product->category->category == 'Electronics' && $loop->index <= 4)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                            <a href="{{ route('product.view', [$product -> id]) }}" class="text-decoration-none">
                                <div class="card product-card">
                                    <img src="{{ asset('storage/uploads/' . $product->image) }}" class="card-img-top" loading="lazy" alt="{{ $product->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title fs-6 text-truncate">{{ $product->name }}</h5>
                                        <p class="fs-6 fw-bold text-primary">{{ $product->price }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    
        <!-- Clothing Category -->
        <section class="category-section shadow-lg rounded p-3">
            <h2 class="section-title fs-4 text-center text-md-start">Clothing</h2>
            <div class="row">
                @foreach ($allProduct as $product)
                    @if ($product->category->category == 'Clothing')
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                            <a href="{{ route('product.view', $product -> id) }}" class="text-decoration-none">
                                <div class="card product-card">
                                    <img src="{{ asset('storage/uploads/' . $product->image) }}" loading="lazy" class="card-img-top" alt="{{ $product->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title fs-6 text-truncate">{{ $product->name }}</h5>
                                        <p class="fs-6 fw-bold text-primary">{{ $product->price }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    
        <!-- For You Section -->
        <section class="category-section shadow-lg rounded p-3">
            <h2 class="section-title fs-4 text-center text-md-start">For You</h2>
            <div class="row">
                @foreach ($allProduct->groupBy('category_id')->take(12) as $categoryProducts)
                    @php
                        $item = $categoryProducts->last();
                    @endphp
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                        <a href="{{ route('product.view', $item->id) }}" class="text-decoration-none">
                            <div class="card product-card">
                                <img src="{{ asset('storage/uploads/' . $item->image) }}" class="card-img-top" loading="lazy" alt="{{ $item->name }}">
                                <div class="card-body">
                                    <h5 class="card-title fs-6 text-truncate">{{ $item->name }}</h5>
                                    <p class="fs-6 fw-bold text-primary">{{ $item->price }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>    
        @endif
    </div>
    
    
@endsection