@extends('layouts.master')

@section('content')
<section class="login-area ptb-100">
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
    <div class="login-content">
        <h2>Request stylist account:</h2>

        <form class="login-form" action="{{route('requests.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="saloon_name" class="form-control" placeholder="Enter your saloon name" required>
            </div>
            <div class="form-group">
                <input type="text" name="saloon_city" class="form-control" placeholder="Enter your saloon city" required>
            </div>
            <div class="form-group">
                <input type="text" name="saloon_address" class="form-control" placeholder="Enter your saloon address" required>
            </div>
            <div class="form-group">
                <input type="text" name="saloon_phone" class="form-control" placeholder="Enter your saloon phone number" required>
            </div>

            <button type="submit" class="default-btn">Submit request</button>

        </form>
    </div>

</section>
@endsection
