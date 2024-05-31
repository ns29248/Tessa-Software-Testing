@extends('layouts.MasterAdmin')

@section('content')
    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bulk Add Hair Colors to Sale</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.bulkSale.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Product Brand:</label>
                                <select class="text_color" name="brand_id" required>
                                    <option value="" selected>Select a brand here</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sale_price">Sale Price</label>
                                <input type="number" name="sale_price" id="sale_price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add to Sale</button>
                        </form>

                        @if(isset($products))
                            <h3>Products for Brand: {{ $selectedBrand }}</h3>
                            <ul>
                                @foreach($products as $product)
                                    <li>{{ $product->name }} - {{ $product->price }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
