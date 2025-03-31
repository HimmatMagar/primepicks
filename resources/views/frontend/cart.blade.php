@extends('layout.nav')
@section('title')
    cart
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('status') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <div class="container mt-5">
        <h1 class="mb-4">Shopping Cart</h1>
        <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="cart-item container shadow-sm rounded p-3 mb-3 bg-white">
                @if ($cart->isEmpty())
                    <h3 class="text-center">No Item in Cart</h3>
                @else
                    @foreach ($cart as $cartItem)
                        <div class="row align-items-center mb-3">
                            <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                                <img src="{{ asset('storage/uploads/' . $cartItem->product->image) }}" alt="Product Image" class="img-fluid rounded" style="max-width: 120px;">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                                <h5>{{ $cartItem->product->name }}</h5>
                                <p class="quantity">Quantity: {{ $cartItem->quantity }}</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                                <h5 class="allPrice">{{ $cartItem->product->price }}</h5>
                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
            </div>
        </div>

        <div class="col-lg-3 col-md-12 mt-4 mt-lg-0">
            <div class="card shadow-lg" style="box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="fw-bold mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <p class="d-flex justify-content-between mb-3">
                        <span>Subtotal:</span> <span class="fw-bold text-dark" id="subTotal">${{ $subTotal }}</span>
                    </p>
                    <p class="d-flex justify-content-between mb-3">
                        <span>Shipping:</span> <span class="fw-bold text-dark" id="shippingFee">$10.00</span>
                    </p>
                    <hr>
                    <h5 class="d-flex justify-content-between text-danger mb-4">
                        <span>Total:</span> <span class="fw-bold" id="totalPrice">${{ $total }}</span>
                    </h5>
                    
                </div>
                <div class="card-footer text-center">
                    @php
                      $amount = $total  
                    @endphp
                    @if ($amount > 10)
                        <form action="{{ route('paypal.checkout') }}">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Checkout</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        </div>

    </div>
@endsection