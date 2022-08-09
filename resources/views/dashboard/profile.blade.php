@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <div class="row px-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Management</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container pt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{Auth::user()->name}}</h5>
                            @if (Auth::user()->name == 'admin')
                                <a class="btn btn-dark btn-sm" href="{{ route('userRegisteration') }}">{{ __('Register') }}</a>
                            @endif
                        </div>
                      <hr>
                      <table id="user_table"  class="table table-bordered table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Is Admin</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>@if( $user->isAdmin === 1)<i class="fa-solid fa-check text-success mx-2"></i> <a href="{{route('toggleAdmin', $user->id)}}" class="btn btn-sm btn-outline-danger">Remove Admin</a>@else<i class="fa-solid text-danger fa-xmark mx-2"></i> <a href="{{route('toggleAdmin', $user->id)}}" class="btn btn-sm btn-outline-success">Make Admin</a>@endif</td>
                                    <td>@if( $user->active_status === 1)<i class="fa-solid fa-check text-success mx-2"></i> <a href="{{route('toggleActive', $user->id)}}" class="btn btn-sm btn-outline-danger">Deactivate</a>@else<i class="fa-solid text-danger fa-xmark mx-2"></i> <a href="{{route('toggleActive', $user->id)}}" class="btn btn-sm btn-outline-success">Activate</a>@endif</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#user_table').DataTable({
                "order": [[ 0, "asc" ]],
            });
        } );
    </script>

@endsection