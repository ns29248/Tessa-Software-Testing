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
                        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Course Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter course name" value="{{ $course->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Course Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Enter course description" required>{{ $course->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="category">Course Category</label>
                                <input type="text" name="category" id="category" class="form-control" placeholder="Enter course category" value="{{ $course->category }}" required>
                            </div>
                            <div class="form-group">
                                <label for="photo" class="file-input">
                                    <input type="file" name="images[]" id="photo" class="form-control-file" multiple required>
                                    <span class="btn btn-sm btn-primary">Add Photo</span>
                                </label>
                            </div>



                            <button type="submit" class="btn btn-primary btn-block">Update Course</button>
                        </form>
                            <div class="form-group">
                                <label for="current-photo">Current Photos:</label>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
