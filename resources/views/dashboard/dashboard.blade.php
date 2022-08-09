@extends('layouts.app')

@section('content')

    <div class="container pt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Items Overview</h5>
                      <hr>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="d-flex justify-content-evenly my-3">
                                  <div class="text-end">
                                      <h1 class="text-success">{{ $total_items }}</h1>
                                      <small>Total Items</small>
                                  </div>
                                  <div class="text-end">
                                      <h1 class="text-danger">{{ $low_quantity }}</h1>
                                      <small>Low Quantity</small>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-12 text-end">
                              <a href="{{ route('inventory') }}" class="btn btn-sm btn-secondary">Inventory</a>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Customer Overview</h5>
                      <hr>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="d-flex justify-content-evenly my-3">
                                  <div class="text-end">
                                      <h1 class="text-success">{{$all_customer}}</h1>
                                      <small>Total Customer</small>
                                  </div>
                                  <!-- <div class="text-end">
                                      <h1 class="text-danger">{{$pending_bill}}</h1>
                                      <small>Pending Bill</small>
                                  </div> -->
                                  <div class="text-end">
                                      <h1 class="text-danger">Rs. {{$credit_amount}}</h1>
                                      <small>Credit Amout</small>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-12 text-end">
                              <a href="{{ route('billBook') }}" class="btn btn-sm btn-secondary">Bill book</a>
                          </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 my-4">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Vendor Overview</h5>
                      <hr>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="d-flex justify-content-evenly my-3">
                                  <!-- <div class="text-end">
                                      <h1 class="text-success">Rs. {{$total_sale}}</h1>
                                      <small>Total Sale</small>
                                  </div>
                                  <div class="text-end">
                                      <h1 class="text-success">Rs. {{$credit_amount}}</h1>
                                      <small>Credit Amout</small>
                                  </div> -->
                                  <div class="text-end">
                                      <h1 class="text-danger">Rs. {{$debt_amount}}</h1>
                                      <small>Debt Amout</small>
                                  </div>
                                  <div class="text-end">
                                      <h1 class="text-success">Rs. {{$total_purchase}}</h1>
                                      <small>Total Purchase</small>
                                  </div>
                                  <!-- <div class="text-end">
                                      <h1 class="{{ $total_profit > 0 ? 'text-success' : 'text-danger' }}">Rs. {{$total_profit}}</h1>
                                      <small>Total Profit</small>
                                  </div> -->
                              </div>
                          </div>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-12 text-end">
                              <a href="{{ route('vendorBills') }}" class="btn btn-sm btn-secondary">Vendor Bills</a>
                          </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 my-4">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Sale Overview</h5>
                      <hr>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="d-flex justify-content-evenly my-3">
                                  <div class="text-end">
                                      <h1 class="text-success">Rs. {{$total_sale}}</h1>
                                      <small>Total Sale</small>
                                  </div>
                                  <!-- <div class="text-end">
                                      <h1 class="text-success">Rs. {{$credit_amount}}</h1>
                                      <small>Credit Amout</small>
                                  </div>
                                  <div class="text-end">
                                      <h1 class="text-danger">Rs. {{$debt_amount}}</h1>
                                      <small>Debt Amout</small>
                                  </div>
                                  <div class="text-end">
                                      <h1 class="text-danger">Rs. {{$total_purchase}}</h1>
                                      <small>Total Purchase</small>
                                  </div> -->
                                  <div class="text-end">
                                      <h1 class="{{ $total_profit > 0 ? 'text-success' : 'text-danger' }}">Rs. {{$total_profit}}</h1>
                                      <small>Total Profit</small>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-12 text-end">
                              <a href="{{ route('bill') }}" class="btn btn-sm btn-secondary">Counter</a>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection