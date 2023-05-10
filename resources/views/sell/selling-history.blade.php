@extends('layouts.app')
@section('css')
    <style>
        span {
            display: block;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Selling History</div>
                    <div class="card-body">
                        <form action="{{ route('sellingHistory') }}" method="get">

                            <div class=" row align-items-center">

                                <div class="col-md-3">
                                    <label for="">Company Name</label>
                                    <select class="js-example-basic-single w-100" name="company_name">
                                        <option>Select</option>
                                        <option value="Nabil Paribahan">Nabil Paribahan</option>
                                        <option value="Others">Others</option>
                                        @foreach ($group as $n_item)
                                            <option value="{{ $n_item->name }}">
                                                {{ $n_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Product Name</label>
                                    <select class="js-example-basic-single w-100" name="product_id">
                                        <option value="">Select</option>
                                        @foreach ($product as $n_item)
                                            <option value="{{ $n_item->id }}">
                                                {{ $n_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Date From</label>
                                    <div>
                                        <input class="form-control" type="date" name="date_from">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Date To</label>
                                    <div>
                                        <input class="form-control" type="date" name="date_to" id="changes_amount">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mt-5">
                                        <input class="btn btn-primary" type="submit" value="View Report">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <hr />
                        @if (request()->company_name || request()->product_id || (request()->date_from && request()->date_to))
                            <div class="row mb-2">
                                @if (request()->company_name)
                                    <div class="col-md-2 mt-2">
                                        <b>Company name</b>: <br> {{ request()->company_name }}
                                    </div>
                                @endif
                                @if (request()->product_id !== null)
                                    @php
                                        $product = DB::table('products')->find(request()->product_id);
                                    @endphp
                                    <div class="col-md-2 mt-2">
                                        <b>Product name</b>: <br> {{ $product->name ?? '' }}
                                    </div>
                                @endif
                                @if (request()->date_from && request()->date_to)
                                    <div class="col-md-2 mt-2">
                                        <b>Date from</b>: <br> {{ request()->date_from }}
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <b>Date to</b>: <br>{{ request()->date_to }}
                                    </div>
                                @endif
                                <div class="col-md-2">
                                    <a href="{{ route('sellingHistory') }}" class="btn btn-sm btn-primary">X</a>
                                </div>
                            </div>
                        @endif

                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice</th>
                                        <th>Vechile Information</th>
                                        <th>Total</th>
                                        <th>Product Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data->count() > 0)
                                        @foreach ($data as $item)
                                            @if ($item->orderDetails->count() > 0)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->invoice_no }}</td>
                                                    <td>
                                                        @if ($item->vehicle_model)
                                                            <b>V.Model: </b>{{ $item->vehicle_model }},<br>
                                                        @endif
                                                        <b>V.Number: </b>{{ $item->vehicle_number }},<br>
                                                        <b>V.Type:</b> {{ $item->vehicle_type }},<br>
                                                        @if ($item->vehicle_supervisor_name)
                                                            <b>S.Name: </b>{{ $item->vehicle_supervisor_name }},<br>
                                                        @endif
                                                        @if ($item->vehicle_supervisor_mobile)
                                                            <b>S.Mobile: </b>{{ $item->vehicle_supervisor_mobile }}
                                                        @endif
                                                        @if ($item->group_id)
                                                            <b>Group: </b>{{ $item->group->name }}
                                                        @endif
                                                    </td>
                                                    <td>৳{{ number_format($item->total_amount, 2) }}</td>
                                                    <td>
                                                        @foreach ($item->orderDetails as $details)
                                                            <b>Item:</b> {{ $details->product_name }}
                                                            &nbsp;&nbsp;||&nbsp;&nbsp;
                                                            <b>Qty:</b> {{ $details->product_quantity }}(L)
                                                            &nbsp;&nbsp;||&nbsp;&nbsp;
                                                            <b>Total:</b>
                                                            ৳{{ number_format($details->product_amount, 2) }},<br>
                                                            @if (!$loop->last)
                                                                <hr>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="text-center">
                                                    No data found
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{ $data->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
