@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <div class="row px-4 border-bottom border-2 border-dark">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                      <li class="breadcrumb-item" aria-current="page"><a href="/bill">Billing Counter</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Bill Book</li>
                    </ol>
                </nav>
                <a href="{{route('bill')}}"><button class="btn btn-dark btn-sm">Back</button></a>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <table id="bill_table"  class="table table-bordered table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Bill No.</th>
                            <th>Name</th>
                            <th>Pending</th>
                            <th>Contact</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $bill)
                                <tr>
                                    <td>{{$bill->id}}</td>
                                    <td>{{$bill->name}}</td>
                                    <td class="text-end">
                                        Rs. {{$bill->pending}} @if($bill->pending > 0) <a class="btn mx-2 btn-danger btn-sm" href="{{route('clearBill', $bill)}}">Clear </a> @else <a class="btn btn-sm mx-2 btn-success">Paid</a> @endif <a class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal{{$bill->id}}"><i class="fa-solid fa-info-circle text-info"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-info btn-sm mx-2" href="tel:+91{{$bill->number}}"><i class="fa-solid fa-phone"></i></a><a class="btn btn-outline-info btn-sm mx-2" href="https://wa.me/+91{{$bill->number}}"><i class="fa-brands fa-whatsapp"></i></a>
                                    </td>
                                    <td>{{$bill->created_at->format('d-m-Y')}}</td>
                                    <div class="modal fade" id="exampleModal{{$bill->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{$bill->name}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><b>Phone Number - </b>{{$bill->number}}</li>
                                                    <li class="list-group-item"><b>Total - </b>Rs. {{$bill->total}}</li>
                                                    <li class="list-group-item"><b>Paid - </b>Rs. {{$bill->total - $bill->pending}}</li>
                                                    <li class="list-group-item"><b>Pending - </b>Rs. {{$bill->pending}}</li>
                                                    <li class="list-group-item"><b>Mode - </b> {{$bill->mode_of_payment}}</li>
                                                    @if($bill->gst_number)
                                                        <li class="list-group-item"><b>GST Number - </b>{{$bill->gst_number}}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
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
            $('#bill_table').DataTable({
                "order": [[ 2, "desc" ], [ 3, "desc" ]],
            });
        } );
    </script>
@endsection