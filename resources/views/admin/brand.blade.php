@extends('layouts.MasterAdmin')

@section('content')
    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Brand</h4>
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
                        <form action="{{ route('brands.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Enter brand name" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Add Brand</button>
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
                        <h4 class="card-title">Brands</h4>
                    </div>
                    <div class="card-body">
                        @if(count($brands) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($brands as $brand)
                                        <tr>
                                            <td>{{ $brand->name }}</td>
                                            <td>
                                                <a href="{{ route('brands.edit', $brand) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No Brands found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
