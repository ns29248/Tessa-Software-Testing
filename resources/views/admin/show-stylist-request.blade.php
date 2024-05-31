@extends('layouts.Masteradmin')

@section('content')
    <style>
        .text-center-custom {
            text-align: center;
        }
        .product-image {
            max-width: 100px; /* Set the maximum width as per your design */
            max-height: 100px; /* Set the maximum height as per your design */
        }
    </style>

    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title text-center-custom">Request Details</h2>

                        <form action="{{ route('request.index') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Stylist Requests</button>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered mx-auto">
                                    <thead class="text-center">
                                    <tr>
                                        <th class="text-center-custom">Saloon Name</th>
                                        <th class="text-center-custom">Saloon City</th>
                                        <th class="text-center-custom">Saloon Address</th>
                                        <th class="text-center-custom">Saloon Phone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td class="text-center-custom">
                                                <span class="unit-amount">{{ $request->saloon_name }}</span>
                                            </td>
                                            <td class="text-center-custom">
                                                <span class="unit-amount">{{ $request->saloon_city }}</span>
                                            </td>
                                            <td class="text-center-custom">
                                                <span class="unit-amount">{{ $request->saloon_address }}</span>
                                            </td>
                                            <td class="text-center-custom">
                                                <span class="unit-amount">{{ $request->saloon_phone }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                        <td>{{ $request->user->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Last Name:</strong></td>
                                        <td>{{ $request->user->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>City:</strong></td>
                                        <td>{{ $request->user->city }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address:</strong></td>
                                        <td>{{ $request->user->address }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Postcode / Zip:</strong></td>
                                        <td>{{ $request->user->zip }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone:</strong></td>
                                        <td>{{ $request->user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email Address:</strong></td>
                                        <td>{{ $request->user->email }}</td>
                                    </tr>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
