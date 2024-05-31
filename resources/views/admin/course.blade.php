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
                            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label for="name">Course Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter course name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Course Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Enter course description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category">Course Category</label>
                                <input type="text" name="category" id="category" class="form-control" placeholder="Enter course category" required>
                            </div>
                            <div class="form-group">
                                <label for="photo" class="file-input">
                                    <input type="file" name="images[]" id="photo" class="form-control-file" multiple onchange="previewImages();" required>

                                    <span class="btn btn-sm btn-primary">Add Photo</span>
                                </label>
                            </div>

                                <!-- Container for image previews -->
                                <div id="imagePreviewContainer"></div>

                                <button type="submit" class="btn btn-primary btn-block">Add Course</button>
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
                        <h4 class="card-title">Courses</h4>
                    </div>
                    <div class="card-body">
                        @if(count($course) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Images</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($course as $courses)
                                        <tr onclick="window.location='{{ route('courses.show', $courses) }}';" style="cursor: pointer;">
                                            <td>{{ $courses->name }}</td>
                                            <td>{{ $courses->category }}</td>
                                            <td>
                                                <div class="image-grid">
                                                    @foreach($courses->image as $image)
                                                        <img src="{{ asset('storage/images/'.$image->name) }}" alt="Course Image" class="image-item">
                                                        @break
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('courses.edit', $courses) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('courses.destroy', $courses) }}" method="POST" class="d-inline">
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
                            <p>No courses found.</p>
                        @endif
                    </div>

                    <style>
                        .image-grid {
                            display: flex;
                            flex-wrap: wrap;
                        }

                        .image-item {
                            width: 100px;
                            height: 100px;
                            margin: 5px;
                        }
                    </style>

                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImages() {
            var container = document.getElementById('imagePreviewContainer');
            container.innerHTML = ""; // Clear the container
            var files = document.getElementById('photo').files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onloadend = (function(index) {
                    return function(e) {
                        var span = document.createElement('span');
                        span.innerHTML = `<img src="${e.target.result}" class="img-fluid img-thumbnail" style="max-width: 100px; max-height: 100px; margin: 10px;">`;
                        container.appendChild(span);
                    };
                })(i);

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    container.innerHTML = "";
                }
            }
        }
    </script>

@endsection
