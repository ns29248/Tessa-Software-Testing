@extends('layouts.MasterAdmin')

@section('content')

    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $course->name }}</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            @if($course->image)
                                @foreach($course->image as $image)
                                    <img src="{{ asset('storage/images/'.$image->name) }}" alt="Course Image" style="width: 100px; height: 100px;">
                                    <form action="{{ route('image.destroy', ['course' => $course, 'image' => $image]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this image?')">Delete Image</button>
                                    </form>
                                @endforeach

                            @else
                                <p>No photo available</p>
                            @endif
                        </div>
                        <p><strong>Description:</strong> {{ $course->description }}</p>
                        <p><strong>Category:</strong> {{ $course->category }}</p>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
