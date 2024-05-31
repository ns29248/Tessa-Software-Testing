@extends('layouts.Masteradmin')

@section('content')
    <div class="content">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="centered-card" >
                <div class="card  card-half">
                    <div class="card-body">
                        <div class="card-body">
                            <h2>User Details</h2>
                            <table class="table table-bordered">
                                <tr>
                                    <td><strong>First Name:</strong></td>
                                    <td>{{ $user->first_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Last Name:</strong></td>
                                    <td>{{ $user->last_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Role:</strong></td>
                                    <td>{{ $user->role }}</td>
                                </tr>
                                <tr>
                                    <td><strong>City:</strong></td>
                                    <td>{{ $user->city }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address:</strong></td>
                                    <td>{{ $user->address }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Postcode / Zip:</strong></td>
                                    <td>{{ $user->zip }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email Address:</strong></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
