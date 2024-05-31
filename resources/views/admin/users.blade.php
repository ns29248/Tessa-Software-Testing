@extends('layouts.MasterAdmin')

@section('content')
{{--dgsffgfgfgfgf--}}
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Users</h4>
            </div>
            <div class="card-body">
                @if(count($users) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="text-primary">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr onclick="window.location='{{ route('show_users', $user) }}';" style="cursor: pointer;">
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('user.destroy', ['user' => $user]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form  action="{{ route('show_user', ['user' => $user]) }}">
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
                    <p>No users found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
