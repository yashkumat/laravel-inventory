@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <div class="row px-4 border-bottom border-2 border-dark">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Billing Counter</li>
                    </ol>
                </nav>
                <form action="{{route('search_item')}}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-sm typeahead" placeholder="Search item" id="search">
                        <button class="btn btn-sm btn-outline-secondary"  type="submit" id="search-button"><i class="fa-solid fa-search"></i></button>
                    </div>
                </form>
                <a href="{{ route('billBook') }}"><button class="btn btn-dark btn-sm">Bill Book</button></a>
            </div>
        </div>
    </div>

    <div class="container my-4">
        
        <form action="{{ route('saveBill') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <p>Bill No.: <b>{{$bill_number}}</b></p>
                        <p>@php $dt = new DateTime(); echo "Date: <b>". $dt->format('d-m-Y'); @endphp</b></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Customer Name</label>
                        <input value="{{ old('name') }}" name="name" type="text" class="form-control form-control-sm" id="name">
                        @error('name')
                            <div class="text-danger my-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="number" class="form-label">Number</label>
                        <input value="{{ old('number') }}" name="number" type="text" class="form-control form-control-sm" id="number">
                        @error('number')
                            <div class="text-danger my-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table id="billTable"  class="table table-bordered table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>Item id</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @if(session('bill'))
                                @foreach(session('bill') as $id => $item)
                                        <tr>
                                            <td>{{$id}}</td>
                                            <td><b>{{$item['name']}} <a href="{{ route('removeFromBill', $id) }}"><i class="fa-solid fa-trash text-danger"></i></a></b></td>
                                            <!-- <td>Rs. {{$item['price']}}</td> -->
                                            <td><input type="text" name="price" class="form-control" value="{{$item['price']}}" id='price{{$id}}' onchange="add_amount({{$id}})"></td>
                                            <td><span id="quantity{{$id}}">{{$item['quantity']}}</span> <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$id}}"><i class="fa-solid fa-edit mx-2"></i></a></td>
                                            <td>
                                                <span id="amount{{$id}}" class="amount">{{$item['price'] * $item['quantity']}}</span>
                                            </td>


                                            <!-- <td>{{$item['price'] * $item['quantity']}}</td> -->
                                            <!-- @php 
                                                $total+=($item['price'] * $item['quantity']);
                                            @endphp -->
                                        </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <div class="input-group input-group-sm my-1 justify-content-center">
                                            <span class="input-group-text">No items added!</span>
                                            <a href="/inventory"><button class="btn btn-sm btn-outline-secondary" type="button" id="button-addon2">Add now</button></a>
                                        </div>
                                    </td>
                                </tr>  
                            @endif

                            @if(session('bill'))
                            <tr>
                                <td colspan="4" class="h5">Discount</td>
                                <td class="h5">{{session('discount') ? session('discount') : 0}}% <a href="#"><i class="fa-solid fa-edit mx-2" data-bs-toggle="modal" data-bs-target="#discount_model"></i></a></td>
                                
                            </tr>

                            @php

                            $grandtotal = $total - (( $total * session('discount') ) / 100 );

                            @endphp

                            <tr>
                                <td colspan="4" class="h5" >Total</td>
                                <td class="h5" id="grandTotal">Rs. {{ $grandtotal  }} </td>
                                <input type="hidden" name="total" id="total" value="{{$total}}">
                            </tr>

                            <tr>
                                <td class="text-end" colspan="5"><small class="text-end">You Saved Rs. {{ $total - $grandtotal}}</small></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <label for="" class="input-group-text" for="mode_of_payment">Mode of payment</label>
                        <select class="form-select" id="mode_of_payment" name="mode_of_payment">
                            <option value="Cash">Cash</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <label for="gst_number" class="input-group-text">GST Number</label>
                        <input placeholder="" name="gst_number" type="text" class="form-control" id="gst_number">
                    </div>
                </div>
                <div class="col-md-3">
                        <div class="input-group mb-3">
                        <label for="gst_number" class="input-group-text">Paid Amount</label>
                        <input placeholder="" type="text" name="pending" class="form-control" placeholder="Pending Amount">
                        </div>
                        @error('pending')
                            <div class="text-danger my-1">{{ $message }}</div>
                        @enderror
                </div>
                <div class="col-md-3">    
                            <button class="btn btn-outline-success" type="submit">Save</button>
                            <a href="{{ route('resetBill') }}"><button class="btn btn-outline-danger"  type="button">Reset</button></a>
                            <button class="btn btn-outline-secondary" onclick="print()" type="button">Print</button>
                    </div>
                </div>
                
            </div>
            @endif
        </form>
    </div>

    @if(session('bill'))
        @foreach(session('bill') as $id => $item)
            <div class="modal fade" id="exampleModal_{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Quantity</h5>
                            <button type="button" class="close btn-outline-danger btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-close"></i></button>
                        </div>
                        <form action="{{route('editQuantity', $id )}}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input placeholder="less than equal to {{$item['available']}}" name="quantity" type="text" class="form-control" id="quantity">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="modal fade" id="discount_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Discount</h5>
                    <button type="button" class="close btn-outline-danger btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-close"></i></button>
                </div>
                <form action="{{route('addDiscount' )}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount</label>
                            <input value="{{session('discount')}}" placeholder="Enter discount percentage" name="discount" type="text" class="form-control" id="discount">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add Discount</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var path = "{{ route('autocomplete') }}";

        $('input.typeahead').typeahead({
            source: function(terms, process){
                return $.get(path, {terms:terms}, function(data){
                    return process(data);
                })
            }
        });

        function print(){
            var prtContent = document.getElementById("billTable");
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }

        function add_amount(id){
            var total = 0
            var price = document.getElementById("price"+id).value
            var quantity = document.getElementById("quantity"+id).innerHTML
            document.getElementById("amount"+id).innerHTML = price*quantity
            var spans = document.getElementsByClassName("amount");
            for (let index = 0; index < spans.length; index++) {
                const element = spans[index].innerHTML;
                total += parseInt(element)
            }
            // console.log(total)
            document.getElementById('grandTotal').innerHTML = "Rs. " + total
            document.getElementById('total').value = total
        }

    </script>
    
@endsection