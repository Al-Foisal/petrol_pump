@extends('layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <style>
        span {
            display: block;
        }

        .dt-button {
            border: none;
            background: #0da487;
            border-radius: 3px;
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Others Selling History</div>
                    <div class="card-body">

                        <form action="{{ route('otherSell') }}" method="get">

                            <div class=" row align-items-center">

                                <div class="col-md-2">
                                    <label for="">Company Name</label>
                                    <select class="js-example-basic-single w-100" name="company_name">
                                        <option value="">Select</option>
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
                                    <label for="">Vehicle number</label>
                                    <select class="js-example-basic-single w-100" name="vehicle_type">
                                        <option value="">Select</option>
                                        @foreach ($vehicle as $n_item)
                                            <option value="{{ $n_item->vehicle_number }}">
                                                {{ $n_item->vehicle_number }}
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
                                @if (request()->vehicle_type)
                                    <div class="col-md-2 mt-2">
                                        <b>Vehicle number</b>: <br> {{ request()->vehicle_type }}
                                    </div>
                                @endif
                                @if (request()->date_from && request()->date_to)
                                    <div class="col-md-2">
                                        <b>Date from</b>: {{ request()->date_from }}
                                    </div>
                                    <div class="col-md-2">
                                        <b>Date to</b>: {{ request()->date_to }}
                                    </div>
                                @endif

                            </div>
                            @php
                                $total_amount = 0;
                                $total_quantity = 0;
                                $total_vehicle = 0;
                                foreach ($data as $a_item) {
                                    if ($a_item->orderDetails->count() > 0) {
                                        $total_amount += $a_item->total_amount;
                                        $total_vehicle++;
                                        foreach ($a_item->orderDetails as $a_d) {
                                            $total_quantity += $a_d->product_quantity;
                                        }
                                    }
                                }
                            @endphp
                            <div class="row mb-2">
                                <div class="col-md-2 mt-2">
                                    <b>Total vehicle</b>: <br> {{ $total_vehicle }}
                                </div>
                                <div class="col-md-2 mt-2">
                                    <b>Total amount</b>: <br> ৳{{ $total_amount }}
                                </div>
                                <div class="col-md-2 mt-2">
                                    <b>Total quantity</b>: <br> {{ $total_quantity }} L
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <a href="{{ route('sellingHistory') }}" class="btn btn-sm btn-primary">Clear</a>
                                </div>
                            </div>
                        @endif
                        <br />
                        <div class="table-responsive">
                            <table class="table" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice</th>
                                        <th>Vechile Information</th>
                                        <th>Total</th>
                                        <th>Vat</th>
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
                                                        <b>V.Type: </b>{{ $item->vehicle_type }},<br>
                                                        @if ($item->group_id)
                                                            <b>Group: </b>{{ $item->group_id }},<br>
                                                        @endif
                                                        @if ($item->vehicle_supervisor_name)
                                                            <b>S.Name: </b>{{ $item->vehicle_supervisor_name }},<br>
                                                        @endif
                                                        @if ($item->vehicle_supervisor_mobile)
                                                            <b>S.Mobile: </b>{{ $item->vehicle_supervisor_mobile }}
                                                        @endif
                                                    </td>
                                                    <td>৳{{ number_format($item->total_amount, 2) }}</td>
                                                    <td>৳{{ number_format($item->vat_amount, 2) }}</td>
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
@section('js')
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "bPaginate": false,
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        });
    </script>
    {{-- 'copy', 'csv', 'excel', 'pdf', 'print' --}}
@endsection
