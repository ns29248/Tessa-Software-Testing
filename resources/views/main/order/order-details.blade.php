@extends('layouts.master')

@section('content')

    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>Order Details</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li>Order Details</li>
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
                            <th scope="col">Product</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->item as $orderItems)
                            <tr>
                                <td class="product-thumbnail">
                                    <a href="#">
                                        <img src="{{ asset('storage/images/'.$orderItems->product->image->name) }}" alt="item" />
                                    </a>
                                </td>
                                <td class="product-name">
                                    <a href="#">{{ $orderItems->product->brand->name }}</a>
                                </td>
                                <td class="product-name">
                                    <a href="#">{{ $orderItems->product->category->name }}</a>
                                </td>
                                <td class="product-name">
                                    <a href="#">{{ $orderItems->product->name }}</a>
                                </td>

                                <td class="product-price">
                                    <span class="unit-amount">{{ number_format($orderItems->product->price, 2) }}</span>
                                </td>
                                <td class="product-subtotal">
                                    <span class="subtotal-amount">{{number_format($orderItems->quantity, 2) }}</span>
                                </td>
                                <td class="product-subtotal">
                                    <span class="subtotal-amount">{{number_format($orderItems->quantity*$orderItems->product->price, 2) }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="cart-totals">
                    <h3>Order Totals</h3>

                    <ul>
                        <li>Subtotal <span>{{ number_format($order->total, 2) }} den</span></li>
                        <li>Shipping <span>150.00 den</span></li>
                        @if($order->coupon)
                            @if($order->coupon->type == 'percentage')
                                <li>Coupon Applied <span>-{{ $order->coupon->value }}%</span></li>
                            @elseif($order->coupon->type == 'fixed')
                                <li>Coupon Applied <span>-{{ number_format($order->coupon->value, 2) }} den</span></li>
                            @endif
                        @endif
                        <li>Total <span>{{ number_format($order->total + 150 - (!empty($order->coupon) ? ($order->coupon->type == 'percentage' ? ($order->total * $order->coupon->value / 100) : $order->coupon->value) : 0), 2) }} den</span></li>
                    </ul>

                    <a href="{{route('shop')}}" class="default-btn">Continue Shopping</a>
                </div>
            </form>
        </div>
    </section>
    <!-- End Cart Area -->
    <style>
        @media only screen and (max-width: 768px) {
            td:nth-of-type(2):before { content: "Brand"; }
            td:nth-of-type(3):before { content: "Category"; }
            td:nth-of-type(4):before { content: "Name"; }
            td:nth-of-type(5):before { content: "Unit Price"; }
            td:nth-of-type(6):before { content: "Quantity"; }
            td:nth-of-type(7):before { content: "Total"; }
        }
    </style>
@endsection
