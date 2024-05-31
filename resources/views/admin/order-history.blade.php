@extends('layouts.Masteradmin')

@section('content')
    <style>
        .text-center-custom {
            text-align: center;
        }
    </style>
    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center-custom">Completed Orders</h4>
                        <div class="card-header">
                            <h4 class="card-title text-center-custom">Orders</h4>
                            <div>
                                <a href="{{ route('orders.index') }}" class="btn btn-primary">Orders</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered mx-auto">
                                    <thead class="text-center">
                                    <tr>
                                        <th class="text-center-custom">Order Number</th>
                                        <th class="text-center-custom">Order Date</th>
                                        <th class="text-center-custom">Order Total</th>
                                        <th class="text-center-custom">Status</th>
                                        <th class="text-center-custom">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr class="text-center">
                                            <td class="text-center-custom">{{ $order->id }}</td>
                                            <td class="text-center-custom">{{ $order->created_at }}</td>
                                            <td class="text-center-custom">{{ number_format($order->total, 2) }}</td>
                                            <td class="text-center-custom">{{ $order->status }}</td>
                                            <td class="text-center-custom">
                                                <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-sm">View Order</a>
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
    </div>
@endsection
