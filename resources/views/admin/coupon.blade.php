@extends('layouts.MasterAdmin')

@section('content')
    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Course</h4>
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
                        <form action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label for="code">Coupon Code</label>
                                <input name="code" id="code" class="form-control" placeholder="Enter coupon code" required>
                            </div>
                            <div class="form-group">
                                <label for="value">Coupon Value</label>
                                <input type="number" name="value" id="value" class="form-control" placeholder="Enter coupon value" required>
                            </div>

                            <div class="form-group">
                                <label>Coupon Type</label>
                                <select class="text_color" name="type" required>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Coupon Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter coupon quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="expiration_date">Expiration Date</label>
                                <input type="date" name="expiration_date" id="expiration_date" class="form-control" required>
                            </div>



                            <button type="submit" class="btn btn-primary btn-block">Add Coupon</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Coupons</h4>
                    </div>
                    <div class="card-body">
                        @if(count($coupons) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Quantity</th>
                                        <th>Expiration Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $coupon)
                                        <tr onclick="" style="cursor: pointer;">
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->type }}</td>
                                            <td>{{ $coupon->value }}</td>
                                            <td>{{ $coupon->quantity }}</td>
                                            <td>
                                                <a href="{{ route('coupons.edit', $coupon) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('coupons.destroy', $coupon) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No coupons found.</p>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
