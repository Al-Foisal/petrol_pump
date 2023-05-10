@extends('layouts.app')

@section('content')
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Today Sell Quantity(L)</span>
                                <h4 class="mb-0 counter">
                                    {{ number_format($todays_quantity, 2) }}
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-database-2-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Today Sell Amount</span>
                                <h4 class="mb-0 counter">
                                    ৳{{ number_format($todays_amount, 2) }}
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-database-2-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Sell Quantity(L)</span>
                                <h4 class="mb-0 counter">
                                    {{ number_format($total_quantity, 2) }}
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-database-2-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Sell Amount</span>
                                <h4 class="mb-0 counter">
                                    ৳{{ number_format($total_amount, 2) }}
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-database-2-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Monthly Sell Quantity(L) - ({{ date("F") }})</span>
                                <h4 class="mb-0 counter">
                                    {{ number_format($this_month_quantity, 2) }}
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-database-2-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Monthly Sell Amount - ({{ date("F") }})</span>
                                <h4 class="mb-0 counter">
                                    ৳{{ number_format($this_month_amount, 2) }}
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-database-2-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Oil Strategy</h5>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package order-table theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Todays In(L)</th>
                                            <th>Todays Out(L)</th>
                                            <th>Total In(L)</th>
                                            <th>Total Out(L)</th>
                                            <th>Present Stock(L)</th>
                                            <th>Present Unit Price</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>


                                                <td> {{ $product->name }}</td>
                                                @php
                                                    $today_in = DB::table('stocks')
                                                        ->where('product_id', $product->id)
                                                        ->whereDate('created_at', today())
                                                        ->sum('oil_amount');
                                                @endphp
                                                <td>{{ number_format($today_in, 2) }}</td>
                                                @php
                                                    $today_out = DB::table('order_details')
                                                        ->where('product_id', $product->id)
                                                        ->whereDate('created_at', today())
                                                        ->sum('product_quantity');
                                                @endphp
                                                <td>{{ number_format($today_out, 2) }}</td>
                                                @php
                                                    $total_in = DB::table('stocks')
                                                        ->where('product_id', $product->id)
                                                        ->sum('oil_amount');
                                                @endphp
                                                <td>{{ number_format($total_in, 2) }}</td>
                                                @php
                                                    $total_out = DB::table('order_details')
                                                        ->where('product_id', $product->id)
                                                        ->sum('product_quantity');
                                                @endphp
                                                <td>{{ number_format($total_out, 2) }}</td>

                                                <td>{{ number_format($product->stock, 2) }}</td>

                                                <td>৳{{ number_format($product->price, 2) }}</td>


                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
