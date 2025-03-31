@extends('layout.nav')
@section('title')
    Edit Product
@endsection
@section('content')
<div class="row mb-5">
    <div class="container w-25 mt-3 shadow p-3 rounded">
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
            <div class="text-center">
                <h5>Update Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" value="{{ old('name', $product->name) }}" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="text" class="form-control" id="productPrice" value="{{ old('price', $product->price) }}" name="price" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="stock" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="stock" value="{{ old('stock', $product->stock) }}" name="stock" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select" id="productCategory" name="category" required>
                            <option value="" disabled>Select Category</option>
                            <option value="Electronics" {{ old('category', $product->category->category) == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                            <option value="Books" {{ old('category', $product->category->category) == 'Books' ? 'selected' : '' }}>Books</option>
                            <option value="Clothing" {{ old('category', $product->category->category) == 'Clothing' ? 'selected' : '' }}>Clothing</option>
                            <option value="Home & Kitchen" {{ old('category', $product->category->category) == 'Home & Kitchen' ? 'selected' : '' }}>Home & Kitchen</option>
                            <option value="Beauty & Personal Care" {{ old('category', $product->category->category) == 'Beauty & Personal Care' ? 'selected' : '' }}>Beauty & Personal Care</option>
                            <option value="Sports & Outdoors" {{ old('category', $product->category->category) == 'Sports & Outdoors' ? 'selected' : '' }}>Sports & Outdoors</option>
                            <option value="Toys & Games" {{ old('category', $product->category->category) == 'Toys & Games' ? 'selected' : '' }}>Toys & Games</option>
                            <option value="Automotive" {{ old('category', $product->category->category) == 'Automotive' ? 'selected' : '' }}>Automotive</option>
                            <option value="Health & Wellness" {{ old('category', $product->category->category) == 'Health & Wellness' ? 'selected' : '' }}>Health & Wellness</option>
                            <option value="Pet Supplies" {{ old('category', $product->category->category) == 'Pet Supplies' ? 'selected' : '' }}>Pet Supplies</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="image">
                        <small class="form-text text-muted">Leave blank to keep the current image.</small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
    </div>
</div>
@endsection
