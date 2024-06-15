@extends('layouts.MasterAdmin')

@section('content')
    <!-- Content for adding a product to a sale -->
    <div class="content">
        @if(isset($product) && $product)

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-header">
                        <h4 class="card-title">Add Product to Sale</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sales.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <input type="hidden" name="product_id" value="{{ $product->name }}">

                            </div>
                            <div class="form-group">
                                <label for="sale_price">Sale Price</label>
                                <input type="number" name="sale_price" id="sale_price" class="form-control" placeholder="Enter sale price" required>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Add to Sale</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Products</h4>
                    </div>
                    <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Stylist Price</th>
                                        <th>Sale Price</th>
                                        <th>Actions</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sales as $sale)
                                        <tr onclick="window.location='{{ route('products.show', $sale->product) }}';" style="cursor: pointer;">
                                            <td>{{ $sale->product->name }}</td>
                                            <td>{{ $sale->product->description }}</td>
                                            <td>{{ $sale->product->quantity }}</td>
                                            <td>{{ $sale->product->price }}</td>
                                            <td>{{ $sale->product->stylist_price }}</td>
                                            <td>{{ $sale->sale_price }}</td>
                                            <td>
                                                @if($sale->product->image)
                                                    <img src="{{ asset('storage/images/'.$sale->product->image->name) }}" alt="Product Image" style="width: 100px; height: 100px;">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('sales.edit', $sale->product) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="d-inline">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
