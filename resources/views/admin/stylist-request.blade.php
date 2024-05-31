@extends('layouts.Masteradmin')

@section('content')
    <style>
        .text-center-custom {
            text-align: center;
        }
    </style>
    <div class="content">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center-custom">Stylist Requests</h4>
                        <div class="text-right">
                            <form action="{{ route('show_stylists') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Stylists</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered mx-auto">
                                    <thead class="text-center">
                                    <tr>
                                        <th class="text-center-custom">First Name</th>
                                        <th class="text-center-custom">Last Name</th>
                                        <th class="text-center-custom">E-mail</th>
                                        <th class="text-center-custom">Saloon Name</th>
                                        <th class="text-center-custom">Saloon City</th>
                                        <th class="text-center-custom">Saloon Address</th>
                                        <th class="text-center-custom">Saloon Phone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($requests as $request)
                                        <tr class="text-center">
                                            <td class="text-center-custom">{{ $request->user->first_name }}</td>
                                            <td class="text-center-custom">{{ $request->user->last_name }}</td>
                                            <td class="text-center-custom">{{ $request->user->email }}</td>
                                            <td class="text-center-custom">{{ $request->saloon_name }}</td>
                                            <td class="text-center-custom">{{ $request->saloon_city }}</td>
                                            <td class="text-center-custom">{{ $request->saloon_address }}</td>
                                            <td class="text-center-custom">{{ $request->saloon_phone }}</td>
                                            <td class="text-center-custom">
                                                <form action="{{ route('request.update', $request) }}" method="POST">
                                                    @csrf
                                                    @method('PUT') {{-- This line specifies that the form is making a PUT request --}}
                                                    <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                                                </form>

                                            </td>
                                            <td class="text-center-custom">
                                                <form action="{{ route('request.destroy', $request) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE') {{-- This specifies that the form is making a DELETE request --}}
                                                    <button type="submit" class="btn btn-primary btn-sm">Disapprove</button>
                                                </form>
                                            </td>
                                            <td class="text-center-custom">
                                                <form action="{{ route('request.show', $request) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">View</button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
