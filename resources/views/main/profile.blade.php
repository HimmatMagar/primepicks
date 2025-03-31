@extends('layout.nav')
@section('title')
    Profile
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">User Profile</h2>
    
    <!-- User Details -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Personal Information|<a href="">EDIT</a></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Full Name:</strong> {{ auth()->user()->name }}
                </div>
                <div class="col-md-6">
                    <strong>Email Address:</strong> {{ auth()->user()->email }}
                </div>
                <div class="col-md-6">
                    <strong>Joined On:</strong> {{ auth()->user()->created_at }}
                </div>
            </div>

        </div>
    </div>

    <!-- Recent Orders -->
@if (Auth::user() -> role == 'buyer')
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Recent Orders</h5>
            </div>
            <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Payment Status</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>#{{ $order -> id }}</td>
                                        <td>{{ $order -> created_at -> format('F j, Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>${{ $order -> total_amount }}</td>
                                        <td>
                                            <a href="{{ route('order', $order -> id) }}" class="btn btn-info btn-sm">View Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                    @if ($orders->isEmpty())
                        <p class="text-center">You have no recent orders.</p>
                    @endif
                </div>
            </div>
        </div>
@endif

@if (Auth::user() -> role == 'seller')
    <div class="card mb-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Your Products</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Example Product Row -->
                                
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row">{{ $product -> id }}</th>
                                            <td>{{ $product -> name }}</td>
                                            <td>{{ $product -> price }}</td>
                                            <td>{{ $product -> stock }}</td>
                                            <td>{{ $product -> category -> category }}</td>
                                            <td>
                                                <a href="{{ route('product.edit', $product -> id) }}" class="btn btn-warning">Edit</a>
                                                <form action="{{ route('product.destroy', $product -> id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>

        {{-- Order --}}
        <div class="card-header">
            <h5>Order</h5>
        </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Payment Status</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Product Row -->
                        <tr>
                            <th scope="row">1</th>
                            <td>Smartphone</td>
                            <td>$500</td>
                            <td>Paid</td>
                            <td>Completed</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Leather Jacket</td>
                            <td>$100</td>
                            <td>Paid</td>
                            <td>Completed</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>               
 @endif
@endsection