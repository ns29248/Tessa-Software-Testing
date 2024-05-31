@extends('layouts.MasterAdmin')

@section('content')
    {{--dgsffgfgfgfgf--}}
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Stylists</h4>
                </div>
                <div class="card-body">
                    @if(count($stylists) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="text-primary">
                                <tr>
                                    <th>Saloon Name</th>
                                    <th>City</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stylists as $stylist)
                                    <tr onclick="window.location='{{ route('show_stylists', $stylist) }}';" style="cursor: pointer;">
                                        <td>{{ $stylist->saloon_name }}</td>
                                        <td>{{ $stylist->saloon_city }}</td>
                                        <td>{{ $stylist->saloon_address }}</td>
                                        <td>{{ $stylist->saloon_phone }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('stylist.destroy', ['stylist' => $stylist]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form  action="{{ route('show_stylist', ['stylist' => $stylist]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">View</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                        </div>
                    @else
                        <p>No stylist found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
