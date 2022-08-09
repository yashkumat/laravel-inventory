@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">


    <div class="row px-4 border-bottom border-2 border-dark">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Vendors</li>
                    </ol>
                </nav>
                <a href="/addVendor"><button class="btn btn-dark btn-sm">Add Vendor</button></a>
            </div>
        </div>
    </div>

    
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <table id="vendor-table"  class="table table-bordered table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $vendor)
                                <tr>
                                    <td>{{$vendor->id}}</td>
                                    <td>{{$vendor->name}}</td>
                                    <td>{{$vendor->number}} <a class="btn btn-outline-info btn-sm mx-2" href="tel:+91{{$vendor->number}}"><i class="fa-solid fa-phone"></i></a><a class="btn btn-outline-info btn-sm mx-2" href="https://wa.me/+91{{$vendor->number}}"><i class="fa-brands fa-whatsapp"></i></a></td>
                                    <td><a class="btn btn-outline-info btn-sm" href="{{route('vendorDetails', $vendor->id)}}">More Info <i class="fa-solid mx-1 fa-info-circle"></i></a></td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
                $('#vendor-table').DataTable({
                });
        } );
    </script>
    
@endsection