@extends('layouts.MasterAdmin')

@section('content')

    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8"> <!-- Adjusted for better layout with more fields -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Product</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name" required>
                            </div>

                            <!-- Description fields for each language -->
                            <div class="form-group">
                                <label for="description_en">Product Description (English)</label>
                                <textarea name="description[en]" id="description_en" class="form-control" placeholder="Enter product description in English" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description_mk">Product Description (Macedonian)</label>
                                <textarea name="description[mk]" id="description_mk" class="form-control" placeholder="Enter product description in Macedonian" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description_shq">Product Description (Albanian)</label>
                                <textarea name="description[shq]" id="description_shq" class="form-control" placeholder="Enter product description in Albanian" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Product Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter product quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Enter product price" required>
                            </div>
                            <div class="form-group">
                                <label for="stylist_price">Stylist Price</label>
                                <input type="number" name="stylist_price" id="stylist_price" class="form-control" placeholder="Enter stylist price" required>
                            </div>
                            <div class="form-group">
                                <label for="photo" class="file-input">
                                    <input type="file" name="image" id="photo" class="form-control-file" onchange="previewImages();" required>
                                    <span class="btn btn-sm btn-primary">Add Photo</span>
                                </label>
                            </div>
                            <div id="imagePreviewContainer"></div>
                            <div class="form-group">
                                <label>Product Brand:</label>
                                <select class="text_color" name="brand_id" required>
                                    <option value="" selected>Add a brand here</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product Category:</label>
                                <select class="text_color" name="category_id" required>
                                    <option value="" selected>Add a category here</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Products</h4>
                    </div>
                    <div class="card-body">
                        @if(count($products) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Stylist Price</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr onclick="window.location='{{ route('products.show', $product) }}';" style="cursor: pointer;">
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->stylist_price }}</td>
                                            <td>
                                                @if($product->image)
                                                    <img src="{{ asset('storage/images/'.$product->image->name) }}" alt="Product Image" style="width: 100px; height: 100px;">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('sales.create', $product) }}" class="d-inline">
                                                    @csrf
                                                    @method('GET')
                                                    <button type="submit" class="btn btn-primary btn-sm">Add to Sale</button>
                                                </form>
                                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>


                            </div>
                        @else
                            <p>No products found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImages() {
            var container = document.getElementById('imagePreviewContainer');
            container.innerHTML = ""; // Clear the container
            var files = document.getElementById('photo').files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onloadend = (function(index) {
                    return function(e) {
                        var span = document.createElement('span');
                        span.innerHTML = `<img src="${e.target.result}" class="img-fluid img-thumbnail" style="max-width: 100px; max-height: 100px; margin: 10px;">`;
                        container.appendChild(span);
                    };
                })(i);

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    container.innerHTML = "";
                }
            }
        }
    </script>


@endsection
