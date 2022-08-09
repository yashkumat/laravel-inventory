@extends('layouts.app')

@section('content')

    <div class="row px-4 border-bottom border-2 border-dark">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/inventory">Inventory</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Item</li>
                    </ol>
                </nav>
                <a href="/inventory"><button class="btn btn-dark btn-sm">Back</button></a>
            </div>
        </div>
    </div>
    
    <div class="container mt-4 border rounded p-3">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('storeItem') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="brand" class="form-label">Brand</label>
                                <input value="{{ old('brand') }}" name="brand" type="text" class="form-control" id="brand">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ old('name') }}" name="name" type="text" class="form-control" id="name">
                                @error('name')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="cost_price" class="form-label">Cost Price</label>
                                <input value="{{ old('cost_price') }}" name="cost_price" type="text" placeholder="Rs. " class="form-control" id="cost_price">
                                @error('cost_price')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="selling_price" class="form-label">Selling Price</label>
                                <input value="{{ old('selling_price') }}" name="selling_price" type="text" placeholder="Rs. " class="form-control" id="selling_price">
                                @error('selling_price')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="expense" class="form-label">Expense</label>
                                <input value="{{ old('expense') }}" name="expense" type="text" placeholder="Rs. " class="form-control" id="expense">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input value="{{ old('quantity') }}" name="quantity" type="text" class="form-control" id="quantity" onchange="calculate_total()">
                                @error('quantity')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="size" class="form-label">Size</label>
                                <input value="{{ old('size') }}" name="size" type="text" class="form-control" id="size">
                            </div>
                            @error('size')
                                <div class="text-danger my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="storage" class="form-label">Storage</label>
                                <input value="{{ old('storage') }}" name="storage" type="text" placeholder="Rack no." class="form-control" id="storage">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="vendor" class="form-label">Vendor</label>
                                <select class="form-select" id="vendor" name="vendor" aria-label="Default select example">
                                    <option selected>Select vendor</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="total" class="form-label">Bill Total</label>
                                <input value="{{ old('total') }}" name="total" type="text" placeholder="Rs. " class="form-control" id="total">
                                @error('total')
                                <div class="text-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="balance" class="form-label">Balance</label>
                                <input value="{{ old('balance') }}" name="balance" type="text" placeholder="Rs. " class="form-control" id="balance">
                                @error('balance')
                                <div class="text-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="details" class="form-label">Details</label>
                                <textarea value="{{ old('details') }}" name="details" class="form-control" id="details" placeholder="Searchable keywords" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-end">
                            <button type="submit" class="btn btn-success">Add Item</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function calculate_total() {
            var cost_price = parseFloat(document.getElementById('cost_price').value)
            var expense = parseFloat(document.getElementById('expense').value)
            var quantity = parseFloat(document.getElementById('quantity').value)
            document.getElementById('total').value = parseFloat((cost_price + expense) * quantity)
        }
    </script>
    
@endsection