@extends('layouts.MasterAdmin')

@section('content')
    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $product->name }}</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            @if($product->image)
                                <img src="{{ asset('storage/images/'.$product->image->name) }}" alt="Product Image" style="width: 300px; height: 300px; object-fit: cover; object-position: center;">
                            @else
                                <p>No photo available</p>
                            @endif
                        </div>
                        <p><strong>Description:</strong> {{ $product->description }}</p>
                        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                        <p><strong>Price:</strong> {{ $product->price }}</p>
                        <p><strong>Stylist Price:</strong> {{ $product->stylist_price }}</p>

                        <div class="form-group">
                            <label for="brand">Brand:</label>
                            <p>{{ $product->brand->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <p>{{ $product->category->name }}</p>
                        </div>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
