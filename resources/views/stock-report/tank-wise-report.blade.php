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

            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">Tank Wise Stock</div>
                    <div class="card-body">
                        <form action="{{ route('tankWiseStock') }}" method="get">

                            <div class=" row align-items-center">
                                <div class="col-sm-3">
                                    <label>Tank Name</label>
                                    <select class="js-example-basic-single w-100" name="tank_id">
                                        @foreach ($tanks as $s_tank)
                                            <option value="{{ $s_tank->id }}">
                                                {{ $s_tank->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Date From</label>
                                    <div>
                                        <input class="form-control" type="date" name="date_from">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Date To</label>
                                    <div>
                                        <input class="form-control" type="date" name="date_to" id="changes_amount">
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
                        @if (request()->tank_id || (request()->date_from && request()->date_to))
                            <div class="row mb-2">
                                @if (request()->tank_id)
                                    <div class="col-md-4">
                                        @php
                                            $tank = DB::table('tanks')->find(request()->tank_id);
                                        @endphp
                                        <b>Tank</b>: {{ $tank->name }}
                                    </div>
                                @endif
                                @if (request()->date_from && request()->date_to)
                                    <div class="col-md-3">
                                        <b>Date from</b>: {{ request()->date_from }}
                                    </div>
                                    <div class="col-md-3">
                                        <b>Date to</b>: {{ request()->date_to }}
                                    </div>
                                @endif
                                <div class="col-md-2">
                                    <a href="{{ route('tankWiseStock') }}" class="btn btn-sm btn-primary">clear</a>
                                </div>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tank Name</th>
                                        <th>Refilled Date</th>
                                        <th>Fuel Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data->count() > 0)
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tankInfo->name }}</td>
                                                <td>{{ $item->date }}</td>
                                                <td>{{ $item->oil_amount }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="text-center">
                                                    <p>No data found!</p>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                                {{ $data->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
