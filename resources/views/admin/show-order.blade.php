@extends('layouts.Masteradmin')

@section('content')
    <style>
        .text-center-custom {
            text-align: center;
        }
        .product-image {
            max-width: 100px; /* Set the maximum width as per your design */
            max-height: 100px; /* Set the maximum height as per your design */
        }
    </style>

    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title text-center-custom">Order Details</h2>
                        <div>
                            <a href="{{ route('orders.index') }}" class="btn btn-primary">Orders</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered mx-auto">
                                    <thead class="text-center">
                                    <tr>
                                        <th class="text-center-custom">Product</th>
                                        <th class="text-center-custom">Name</th>
                                        <th class="text-center-custom">Unit Price</th>
                                        <th class="text-center-custom">Quantity</th>
                                        <th class="text-center-custom">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->item as $orderItem)
                                        <tr class="text-center">
                                            <td class="text-center-custom">
                                                <a href="#">
                                                    <img src="{{ asset('storage/images/' . $orderItem->product->image->name) }}" class="product-image" alt="item" />
                                                </a>
                                            </td>
                                            <td class="text-center-custom">
                                                <a href="#">{{ $orderItem->product->name }}</a>
                                            </td>
                                            <td class="text-center-custom">
                                                <span class="unit-amount">{{ number_format($orderItem->product->price, 2) }}</span>
                                            </td>
                                            <td class="text-center-custom">
                                                <span class="subtotal-amount">{{ number_format($orderItem->quantity, 2) }}</span>
                                            </td>
                                            <td class="text-center-custom">
                                                <span class="subtotal-amount">{{ number_format($orderItem->quantity * $orderItem->product->price, 2) }}</span>
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
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="centered-card" >
                    <div class="card  card-half">
                        <div class="card-body">
                            <div class="card-body">
                                <h2>Shipping Details</h2>
                                <table class="table table-bordered">
                                    <tr>
                                        <td><strong>First Name:</strong></td>
                                        <td>{{ $order->user->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Last Name:</strong></td>
                                        <td>{{ $order->user->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>City:</strong></td>
                                        <td>{{ $order->user->city }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address:</strong></td>
                                        <td>{{ $order->user->address }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Postcode / Zip:</strong></td>
                                        <td>{{ $order->user->postcode }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone:</strong></td>
                                        <td>{{ $order->user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email Address:</strong></td>
                                        <td>{{ $order->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Order Status: </strong></td>
                                        <td>
                                            <form action="{{ route('orders.update', $order->id) }} " method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="order_status" class="form-select">
                                                    <option {{ $order->status == '0'? 'selected':'' }} value="0">Pending</option>
                                                    <option {{ $order->status == '1'? 'selected':'' }} value="1">Completed</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
