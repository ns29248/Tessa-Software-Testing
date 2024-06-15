@extends('layouts.MasterAdmin')

@section('content')
    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Brand</h4>
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
                        <form action="{{ route('brands.update', $brand->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Enter category name" value="{{ $brand->name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Update Brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
