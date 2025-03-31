@extends('layout.nav')
@section('title')
    order
@endsection

@section('content')
<div class="container">
    <h2>Order Details</h2>

    <!-- Order Details -->
    <div class="card mb-4">
        @foreach ($order as $item)
            <div class="card-header">
                <h5>Order #{{ $item->id }}</h5>
                <p>Status: {{ $item->status }}</p>
            </div>
            <div class="card-body">
                <p><strong>Order Date:</strong> {{ $item->created_at->format('M d, Y') }}</p>
                <p><strong>Total Amount:</strong> ${{ $item->total_amount }}</p>
            </div>
        @endforeach
    </div>

    <!-- Products in the Order -->
    <h3>Products</h3>
    @foreach($products as $product)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/uploads/' . $product['product']->image) }}" alt="{{ $product['product']->name }}" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <h5>{{ $product['product']->name }}</h5>
                        <p><strong>Price:</strong> {{ $product['product']->price }}</p>

                        <!-- Rating System (Stars) -->
                        <div class="rating">
                            <p><strong>Rate this product:</strong></p>
                            <form action="{{ route('comment', $product['product'] -> id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="rating">Rating:</label>
                                    <div class="stars">
                                        <input type="radio" name="rating_value" value="5" id="star1" required>
                                        <label for="star1" class="fa fa-star"></label>
                                        
                                        <input type="radio" name="rating_value" value="4" id="star2" required>
                                        <label for="star2" class="fa fa-star"></label>
                                        
                                        <input type="radio" name="rating_value" value="3" id="star3" required>
                                        <label for="star3" class="fa fa-star"></label>
                                        
                                        <input type="radio" name="rating_value" value="2" id="star4" required>
                                        <label for="star4" class="fa fa-star"></label>
                                        
                                        <input type="radio" name="rating_value" value="1" id="star5" required>
                                        <label for="star5" class="fa fa-star"></label>
                                    </div>
                                </div>

                                <!-- Comment Section -->
                                   <div class="mt-5">
                                        <h4>Comments</h4>
                                        <div class="comment-section">
                                                <textarea class="form-control mb-2" name="body" rows="3" placeholder="Leave a comment..."></textarea>
                                        </div>
                                    </div>
                                <button type="submit" class="btn btn-primary">Submit Rating</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection