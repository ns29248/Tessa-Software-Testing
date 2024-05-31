@extends('layouts.master')

@section('content')

    <!-- Start Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>Courses</h2>
                <ul>
                    <li><a href="index-2.html">Home</a></li>
                    <li>Courses</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Start Blog Area -->
    <section class="blog-area ptb-100">
        <div class="container">
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog-post">
                            @foreach($course->image as $image)
                                <div class="post-image">
                                    <a href="">
                                        <img src="{{ asset('storage/images/'.$image->name) }}" class="main-image" alt="image">
                                    </a>
                                </div>
                                @break
                            @endforeach
                            <div class="post-content">
                                <span class="category">{{$course->category}}</span>
                                <h3>
                                    <a href="">{{$course->name}}</a>
                                </h3>
                                <p>{{$course->description}}</p>
                                <a href="{{ route('showCourse', ['course' => $course]) }}" class="details-btn">Read Story</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Blog Area -->

@endsection
