@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Selling History</div>
                    <div class="card-body">


                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice</th>
                                        <th>Vechile Information</th>
                                        <th>Supervisor Information</th>
                                        <th>Total</th>
                                        <th>Product Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($history as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->invoice_no }}</td>
                                            <td>
                                                <b>V.Model: </b>{{ $item->vehicle_model }},<br>
                                                <b>V.Number: </b>{{ $item->vehicle_number }},<br>
                                                <b>V.Type: {{ $item->vehicle_type }}</b>
                                            </td>
                                            <td><b>S.Name: </b>{{ $item->vehicle_supervisor_name }},<br>
                                                <b>S.Mobile: </b>{{ $item->vehicle_supervisor_mobile }}
                                            </td>
                                            <td>৳{{ number_format($item->total_amount, 2) }}</td>
                                            <td>
                                                @foreach ($item->orderDetails as $details)
                                                    <b>Item:</b> {{ $details->product_name }} &nbsp;&nbsp;||&nbsp;&nbsp;
                                                    <b>Qty:</b> {{ $details->product_quantity }}(L) &nbsp;&nbsp;||&nbsp;&nbsp;
                                                    <b>Total:</b> ৳{{ number_format($details->product_amount, 2) }},<br>
                                                    @if (!$loop->last)
                                                        <hr>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $history->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
