@extends('layouts.master')

@section('content')

    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>My Orders</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li>My Orders</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="cart-area ptb-100">
        <div class="container">
            <form>
                <div class="cart-table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Order Number</th>
                            <th scope="col" class="text-center">Order Date</th>
                            <th scope="col" class="text-center">Order Total</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="product-name text-center">
                                    <span>{{ $order->id }}</span>
                                </td>
                                <td class="product-price text-center">
                                    <span class="unit-amount">{{ $order->created_at }}</span>
                                </td>
                                <td class="product-subtotal text-center">
                                    <span class="subtotal-amount">{{ number_format($order->total, 2) }}</span>
                                </td>
                                @if($order->status == 1)
                                    <td class="product-subtotal text-center">
                                        <span class="subtotal-amount">Completed</span>
                                    </td>
                                @elseif($order->status == 0)
                                    <td class="product-subtotal text-center">
                                        <span class="subtotal-amount">Pending...</span>
                                    </td>
                                @endif
                                <td class="product-subtotal text-center">
                                    <a href="{{ route('order.details', ['order_id' => $order->id]) }}" class="default-btn">View Order</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </section>
    <style>
        @media only screen and (max-width: 768px) {
            .table-responsive td:nth-of-type(1):before { content: "Order Number"; }
            .table-responsive td:nth-of-type(2):before { content: "Order Date"; }
            .table-responsive td:nth-of-type(3):before { content: "Order Total"; }
            .table-responsive td:nth-of-type(4):before { content: "Status"; }
            .table-responsive td:nth-of-type(5):before { content: "Action"; }
        }
    </style>
@endsection
