@extends('layouts.app')

@section('content')

    <div class="row px-4 border-bottom border-2 border-dark">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/vendor">Vendors</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('vendorDetails', $vendor->id)}}">Vendor Detail</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Vendor</li>
                    </ol>
                </nav>
                <a href="/vendor"><button class="btn btn-dark btn-sm">Back</button></a>
            </div>
        </div>
    </div>
    
    <div class="container mt-4 border rounded p-3">
        <div class="row">
            <div class="col-12">
                <form action="{{route('updateVendor', $vendor->id)}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ $vendor->name }}" name="name" type="text" class="form-control" id="name">
                            </div>
                            @error('name')
                                <div class="text-danger my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="number" class="form-label">Number</label>
                                <input value="{{ $vendor->number }}" name="number" type="text" class="form-control" id="number">
                                @error('number')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input value="{{ $vendor->address }}" name="address" type="text" placeholder="" class="form-control" id="address">
                                <!-- @error('address')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror -->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="pinCode" class="form-label">Pin Code</label>
                                <input value="{{ $vendor->pinCode }}" name="pinCode" type="text" placeholder="" class="form-control" id="pinCode">
                                <!-- @error('pinCode')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bankName" class="form-label">Bank Name</label>
                                <input value="{{ $vendor->bankName }}" name="bankName" type="text" placeholder="" class="form-control" id="bankName">
                                <!-- @error('bankAccountName')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="accountName" class="form-label">Account Name</label>
                                <input value="{{ $vendor->accountName }}" name="accountName" type="text" placeholder="" class="form-control" id="accountName">
                                <!-- @error('bankAccountName')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="accountNumber" class="form-label">Account Number</label>
                                <input value="{{ $vendor->accountNumber }}" name="accountNumber" type="text" placeholder="" class="form-control" id="accountNumber">
                                <!-- @error('bankAccountNumber')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="ifscCode" class="form-label">IFSC Code</label>
                                <input value="{{ $vendor->ifscCode }}" name="ifscCode" type="text" placeholder="" class="form-control" id="ifscCode">
                                <!-- @error('bankIfscCode')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="branch" class="form-label">Branch</label>
                                <input value="{{ $vendor->branch }}" name="branch" type="text" placeholder="" class="form-control" id="branch">
                                <!-- @error('bankBranch')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="gstNumber" class="form-label">GST Number</label>
                                <input value="{{ $vendor->gstNumber }}" name="gstNumber" type="text" class="form-control" id="gstNumber">
                                <!-- @error('gstNumber')
                                    <div class="text-danger my-1">{{ $message }}</div>
                                @enderror -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phonePeNumber" class="form-label">phonePe Number</label>
                                <input value="{{ $vendor->phonePeNumber }}" name="phonePeNumber" type="text" class="form-control" id="phonePeNumber">
                            </div>
                            <!-- @error('phonePeNumber')
                                <div class="text-danger my-1">{{ $message }}</div>
                            @enderror -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-end">
                            <button type="submit" class="btn btn-success">Update Vendor</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
@endsection