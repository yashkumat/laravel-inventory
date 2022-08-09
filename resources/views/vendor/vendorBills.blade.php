@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <div class="row px-4 border-bottom border-2 border-dark">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/vendor">Vendors</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vendor Bills</li>
                    </ol>
                </nav>
                <a href="/dashboard"><button class="btn btn-dark btn-sm">Back</button></a>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <table id="vendor_table"  class="table table-bordered table-responsive table-hover bg-white">
                    <thead>
                        <tr>
                            <th>Bill No.</th>
                            <th>Date</th>
                            <th>Vendor</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $bill)
                            <tr>
                                <td>{{$bill->id}}</td>
                                <td>{{$bill->created_at->format('Y-m-d')}}</td>
                                <td>{{$bill->vendor->name}} <a href="{{route('vendorDetails', $bill->vendor_id)}}" class="btn"><i class="fa-solid fa-info-circle"></i></a> </td>
                                <td>{{$bill->total}}</td>
                                <td>{{$bill->total - $bill->balance}}</td>
                                <td class="text-end fw-bold">@if($bill->balance > 0) Rs. {{$bill->balance}} <a href="{{route('clearVendorBill', $bill->id)}}" class="btn mx-2 btn-sm btn-outline-danger">Clear</a> @else <a href="#" class="btn mx-2 btn-sm btn-outline-success">Nil</a> @endif</td>
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
            $('#vendor_table').DataTable({
                "order": [[ 1, "desc" ], [ 5, "desc" ]],
            });
        } );
    </script>
@endsection