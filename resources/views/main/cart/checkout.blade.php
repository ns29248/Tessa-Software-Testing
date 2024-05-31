@extends('layouts.master')

@section('content')


    <!-- Start Checkout Area -->
    <section class="checkout-area ptb-100">
        <div class="container">
            <div class="user-actions">
                <i class="bx bx-log-in"></i>
                <span
                >Returning customer?
            <a href="../login.blade.php">Click here to login</a></span
                >
            </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="billing-details">
                            <h3 class="title">Billing Details</h3>

                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                        <label>Town / City <span class="required">*</span></label>
                                        <div class="select-box">
                                            <select class="form-control" >
                                                <option>{{ Auth::user()->city }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>First Name <span class="required">*</span></label>
                                        <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Last Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" />
                                    </div>
                                </div>

                                {{--    review thiss!!!!
                                                        <div class="col-lg-12 col-md-12">--}}
                                {{--                                <div class="form-group">--}}
                                {{--                                    <label>Company Name</label>--}}
                                {{--                                    <input type="text" class="form-control" />--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}

                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                        <label>Address <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}"/>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" />
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label
                                        >Postcode / Zip <span class="required">*</span></label
                                        >
                                        <input type="text" class="form-control" name="postcode" value="{{ Auth::user()->postcode }}" />
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                        <label
                                        >Email Address <span class="required">*</span></label
                                        >
                                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        @livewire('place-order')
                    </div>

                </div>

        </div>
    </section>
    <!-- End Checkout Area -->
@endsection
