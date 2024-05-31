@extends('layouts.MasterAdmin')

@section('content')
    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Course</h4>
                    </div>
                    <div class="card-body">
                        @if(session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form action="{{ route('coupons.update', $coupon->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Code</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter coupon name" value="{{ $coupon->code }}" required>
                            </div>
                            <div class="form-group">
                                <label>Coupon Type</label>
                                <select class="text_color" name="type" required>
                                    <option value="fixed">Fixed</option>
                                    <option value="percentage">Percentage</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Coupon Value</label>
                                <input type="number" name="value" id="value" class="form-control" placeholder="Enter coupon value" value="{{ $coupon->value }}" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Coupon Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter coupon quantity" value="{{ $coupon->quantity }}" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Coupon Expiration Date</label>
                                <input type="date" name="expiration_date" id="expiration_date" class="form-control" placeholder="Enter coupon expiration date" value="{{ $coupon->expiration_date }}" required>
                            </div>



                            <button type="submit" class="btn btn-primary btn-block">Update Coupon</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
