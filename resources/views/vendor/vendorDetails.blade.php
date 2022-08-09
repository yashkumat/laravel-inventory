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
                    <li class="breadcrumb-item active" aria-current="page">Vendor Detail</li>
                    </ol>
                </nav>
                <a href="/vendor"><button class="btn btn-dark btn-sm">Back</button></a>
            </div>
        </div>
    </div>
    
    <div class="container mt-4 border rounded p-3">
        <div class="row">
            <div class="col-12 d-flex justify-content-end mb-2">
                <a href="{{route('editVendor', $vendor->id )}}" class="btn btn-outline-dark btn-sm">Edit</a>
            </div>
        </div>
        <div class="row">
                <div class="col-md-4 text-center">
                    <h3>{{$vendor->name}}</h3>
                    <p class="mb-1"><i class="fa-solid mx-1 fa-location-dot"></i> {{$vendor->address}} - {{$vendor->pinCode}}</p>
                    <p><i class="fa-solid mx-1 fa-phone"></i> {{$vendor->number}}</p>
                </div>
            <div class="col-md-8">
                <table class="table table-bordered bg-white">
                    <tr>
                        <td>Acc No.: {{$vendor->accountNumber}}</td>
                        <td>IFSC Code: {{$vendor->ifscCode}}</td>
                    </tr>
                    <tr>
                        <td>Bank Name: {{$vendor->bankName}}</td>
                        <td>Acc Name: {{$vendor->accountName}}</td>
                    </tr>
                    <tr>
                        <td>GST No.: {{$vendor->gstNumber}}</td> 
                        <td>PhonePe No.: {{$vendor->phonePeNumber}}</td>
                    </tr>
                </table>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-12">
                <table id="vendor_table"  class="table table-bordered table-responsive table-hover bg-white">
                    <thead>
                        <tr>
                            <th>Bill No.</th>
                            <th>Date</th>
                            <th>Item</th>
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
                                <td>{{$bill->item->name}} <a href="{{route('vendorItemInfo', $bill->item_id)}}" class="btn"><i class="fa-solid fa-info-circle"></i></a> </td>
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