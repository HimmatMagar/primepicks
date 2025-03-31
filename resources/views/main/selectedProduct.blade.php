@extends('layout.nav')
@section('title')
    Product Details
@endsection
@section('content')
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/uploads/' . $product -> image) }}" alt="Product Image" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2 class="product-name">{{ $product -> name }}</h2>
            <p class="product-price">{{ $product -> price }}</p>
            @php
                $num = number_format($rating);
            @endphp
            @for($i = 1; $i <= $num; $i++)
                <i class="fa fa-star text-warning"></i>
            @endfor
            @for($j = $num + 1; $j <= 5; $j++)
                <i class='fa fa-star'></i>
            @endfor
                <span>{{ $num }} Ratings</span>

           <form action="{{ route('cart.product', $product -> id) }}" method="POST">
            @csrf
                <div class="bg-white p-3 rounded shadow-sm d-flex align-items-center mb-2 mt-2">
                    <span class="text-secondary mr-3">Quantity</span>
                    <div class="d-flex align-items-center mr-3">
                        <button type="button" class="btn btn-light border" id="Button">-</button>
                        <input type="hidden" name="index" id="indexs" value="1"> <!-- Hidden input to hold the value -->
                        <span class="mx-2" id="index">1</span>
                        <button type="button" class="btn btn-light border" id="addBtn">+</button>
                    </div>
                    <span class="text-muted" id="stock">Only {{ $product -> stock }} item left</span>
                </div>
                <button type="submit" class="btn btn-primary" id="buy-button">Buy Now</button>
                <button type="submit" class="btn btn-success" id="add-to-cart-button">Add to Cart</button>
           </form>

            <h5 class="mt-4">Description</h5>
            <p>{{ $product -> description }}</p>

            <h5 class="mt-4">Sold by: <span class="store-name">Thapa Store</span></h5>
        </div>
    </div>

    <div class="mt-5">
        <h4>Comments</h4>
    
        <!-- Display Existing Comments -->
        <div class="comment-section">
            @foreach ($comment as $comment)
                <div class="p-3 border rounded-lg shadow-sm mb-2">
                    <strong>{{ $comment->user->name }}</strong>
                        <span class="ms-2">
                            @for($i = 1; $i <= $comment->rating_value; $i++)
                                <i class="fa fa-star text-warning"></i>
                            @endfor
                            @for($j = $comment->rating_value + 1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                        </span>
                    <p class="text-gray-600">{{ $comment->body }}</p>
                    <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
        
        <div class="mt-3 text-center"> 
            {{-- {{ $comment->links() }} --}}
        </div>
    </div>
</div>
@endsection