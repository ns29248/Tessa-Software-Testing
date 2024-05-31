@extends('layouts.master')

@section('content')


    <!-- Start Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>{{$course->name}}</h2>
                <ul>
                    <li><a href={{ url('/') }}>Home</a></li>
                    <li>Course Details</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Start Product Details Area -->
    <section class="product-details-area pt-100 pb-70">
        <div class="container">
            <div class="products-details-image-slider owl-carousel owl-theme">
                @foreach($course->image as $image)
                    <div class="image">
                        <img src="{{ asset('storage/images/'.$image->name) }}" alt="image" />
                    </div>
                @endforeach
            </div>


            <div class="tab products-details-tab">
                <ul class="tabs">
                    <li><a href="#">
                            <div class="dot"></div> Description
                        </a></li>
                </ul>

                <div class="tab-content">
                    <div class="tabs-item">
                        <div class="products-details-tab-content">
                            <h2>{{$course->name}}</h2>
                        </div>
                        <div class="products-details-tab-content">
                            <h4 style="color: #5c636a">{{$course->category}}</h4>
                        </div>
                        <div class="products-details-tab-content">
                            <p>{{$course->description}}</p>
                        </div>
                    </div>




{{--                    <div class="tabs-item">--}}
{{--                        <div class="products-details-tab-content">--}}
{{--                            <p>Here are 5 more great reasons to buy from us:</p>--}}

{{--                            <ol>--}}
{{--                                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</li>--}}
{{--                                <li> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</li>--}}
{{--                                <li>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>--}}
{{--                                <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>--}}
{{--                                <li>When an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>--}}
{{--                            </ol>--}}
{{--                        </div>--}}
{{--                    </div>--}}


    </section>
    <!-- End Product Details Area -->
@endsection
