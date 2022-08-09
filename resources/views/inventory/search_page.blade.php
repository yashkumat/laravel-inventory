@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <div class="row px-4 border-bottom border-2 border-dark">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                      <li class="breadcrumb-item"><a href="/inventory">Inventory</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Search Page</li>
                    </ol>
                </nav>
                <a href="/bill"><button class="btn btn-dark btn-sm">Bill</button></a>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <table id="search-table"  class="table table-bordered table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Storage</th>
                            <th>Selling Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td><h5>{{$item->name}} <a href="#" data-bs-toggle="modal" data-bs-target="#infoModal{{$item->id}}" class="btn"><i class="fa-solid fa-info-circle text-info"></i></a></td>
                                    <td>{{$item->storage}}</td>
                                    <td>Rs. {{$item->selling_price}}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">Cart <i class="fa-solid fa-cart-shopping text-success"></i></a>
                                        <a class="btn btn-sm btn-outline-dark" href="#" data-bs-toggle="modal" data-bs-target="#warehouseModal{{$item->id}}">Warehouse <i class="fa-solid fa-warehouse text-dark"></i></a>
                                        <a class="btn btn-sm btn-outline-primary" href="{{route('editItem', $item)}}">Edit <i class="fa-solid mx-1 fa-edit text-primary"></i></a>
                                        <a href="{{ route('deleteItem', $item) }}" class="btn btn-sm @if($item->visibility) btn-outline-danger @else btn-outline-secondary @endif">@if($item->visibility) Hide @else Unhide @endif <i class="fa-solid @if($item->visibility) text-danger @else text-secondary @endif fa-eye"></i></a>
                                        
                                    </td>
                                    <div class="modal fade" id="infoModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{$item->name}}</h5>
                                                        <button type="button" class="close btn-danger btn" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul class="list-group">
                                                            <li class="list-group-item"><b>Brand - </b>{{$item->brand}}</li>
                                                            <li class="list-group-item"><b>Quantity - </b>{{$item->quantity}}</li>
                                                            <li class="list-group-item"><b>Size - </b>{{$item->size}}</li>
                                                            @if(Auth::user()->isAdmin)
                                                            <li class="list-group-item"><b>Cost Price - </b>Rs. {{$item->cost_price}}</li>
                                                            <li class="list-group-item"><b>Expense - </b>Rs. {{ $item->expense }}</li>
                                                            @endif
                                                            <li class="list-group-item"><b>Details - </b>{{$item->details}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add item to cart</h5>
                                                    <button type="button" class="close btn-danger btn" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('addToBill', $item )}}" method="post">
                                                    <div class="modal-body">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="quantity" class="form-label">Quantity</label>
                                                                <input placeholder="less than equal to {{$item['quantity']}}" name="quantity" type="text" class="form-control" id="quantity">
                                                                @error('quantity')
                                                                    <div class="text-danger my-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Add Item</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal fade" id="warehouseModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="warehouseModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add  item to Inventory</h5>
                                                    <button type="button" class="close btn-danger btn" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('addItemToInventory', $item )}}" method="post">
                                                    <div class="modal-body">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="quantity" class="form-label">Quantity</label>
                                                                <input name="quantity" type="text" class="form-control" id="quantity">
                                                                @error('quantity')
                                                                    <div class="text-danger my-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="vendor" class="form-label">Vendor</label>
                                                                <select class="form-select" id="vendor" name="vendor" aria-label="Default select example">
                                                                    <option selected>Select vendor</option>
                                                                    @foreach($vendors as $vendor)
                                                                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="total" class="form-label">Bill Total</label>
                                                                <input value="{{ old('total') }}" name="total" type="text" placeholder="Rs. " class="form-control" id="total">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="balance" class="form-label">Balance</label>
                                                                <input value="{{ old('balance') }}" name="balance" type="text" placeholder="Rs. " class="form-control" id="balance">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Add Item</button>
                                                    </div>
                                                </form>
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
            $('#search-table').DataTable({
                "order": [[ 0, "desc" ]],
            });
        } );
    </script>
@endsection