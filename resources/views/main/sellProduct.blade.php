@extends('layout.nav')
@section('title')
    Sell Product
@endsection

@section('content')
<div class="container mt-5">
    <!-- Seller Dashboard Header -->
    <div class="text-center mb-5">
        <div class="col">
            <h1><strong>Welcome, Seller!</strong></h1>
            <p>Manage your products and start selling!</p>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <!-- Add New Product Form -->
    <div class="row mb-5">
        <div class="container shadow p-3 rounded-0">
                <div class="text-center">
                    <h5>Add New Product</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="productName" name="name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" id="productDescription" name="description" rows="3"></textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" id="productPrice" name="price">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Quantity</label>
                            <input type="text" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" id="stock" name="stock">
                            @error('stock')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="productCategory" name="category">
                                <option value="" disabled selected>Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Books">Books</option>
                                <option value="Clothing">Clothing</option>
                                <option value="Home & Kitchen">Home & Kitchen</option>
                                <option value="Beauty & Personal Care">Beauty & Personal Care</option>
                                <option value="Sports & Outdoors">Sports & Outdoors</option>
                                <option value="Toys & Games">Toys & Games</option>
                                <option value="Automotive">Automotive</option>
                                <option value="Health & Wellness">Health & Wellness</option>
                                <option value="Pet Supplies">Pet Supplies</option>
                            </select>
                            @error('category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="productImage" name="image">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection