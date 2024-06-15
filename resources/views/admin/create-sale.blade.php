@extends('layouts.MasterAdmin')

@section('content')
    <!-- Content for adding a product to a sale -->
    <div class="content">
            <div class="row justify-content-center mt-4">
            @if($product)
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
                                <td class="product-name">
                                    <label>Product Name</label>
                                    <a href="#">{{ $product->name }}</a>
                                </td>
                                <div class="form-group">
                                    <input type="hidden" name="product_id" id="product_id" class="form-control" value="{{ $product->id }}" required>
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
                    @endif
                </div>
            </div>
@endsection
