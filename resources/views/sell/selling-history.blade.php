@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Selling History</div>
                    <div class="card-body">
                        <form action="{{ route('sellingHistory') }}" method="get">

                            <div class=" row align-items-center">

                                <div class="col-sm-3">
                                    <label>Date From</label>
                                    <div>
                                        <input class="form-control" type="date" name="date_from" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Date To</label>
                                    <div>
                                        <input class="form-control" type="date" name="date_to" id="changes_amount"
                                            required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group mt-5">
                                        <input class="btn btn-primary" type="submit" value="View Report">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <hr />
                        @if (request()->date_from && request()->date_to)
                            <div class="row mb-2">
                                <div class="col-md-1 mt-2">
                                    <b>Results:</b>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <b>Date from</b>: {{ request()->date_from }}
                                </div>
                                <div class="col-md-2 mt-2">
                                    <b>Date to</b>: {{ request()->date_to }}
                                </div>
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
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->invoice_no }}</td>
                                                <td>
                                                    <b>V.Model: </b>{{ $item->vehicle_model }},<br>
                                                    <b>V.Number: </b>{{ $item->vehicle_number }},<br>
                                                    <b>V.Type:</b> {{ $item->vehicle_type }},<br>
                                                    @if ($item->vehicle_supervisor_name)
                                                        <b>S.Name: </b>{{ $item->vehicle_supervisor_name }},<br>
                                                    @endif
                                                    @if ($item->vehicle_supervisor_mobile)
                                                        <b>S.Mobile: </b>{{ $item->vehicle_supervisor_mobile }}
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
