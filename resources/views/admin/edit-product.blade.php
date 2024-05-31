@extends('layouts.MasterAdmin')

@section('content')
    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Product</h4>
                    </div>
                    <div class="card-body">
                        @if(session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" value="{{ $product->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Enter product description" required>{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Product Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter product quantity" value="{{ $product->quantity }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Enter product price" value="{{ $product->price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="stylist_price">Stylist Price</label>
                                <input type="number" name="stylist_price" id="stylist_price" class="form-control" placeholder="Enter product price" value="{{ $product->stylist_price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="photo" class="file-input">
                                    <input type="file" name="image" id="photo" class="form-control-file">
                                    <span class="btn btn-sm btn-primary">Change Photo</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="current-photo">Current Photo:</label>
                                @if($product->image)
                                    <img src="{{ asset('storage/images/'.$product->image->name) }}" alt="Product Image" style="width: 100px; height: 100px;">
                                @else
                                    <p>No photo available</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Product Brand:</label>
                                <select class="text_color" name="brand_id" required>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product Category:</label>
                                <select class="text_color" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
