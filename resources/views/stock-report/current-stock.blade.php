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
                    <div class="card-header">Tank Wise Current Report</div>
                    <div class="card-body">
                        {{-- <form action="{{ route('tankWiseStock') }}" method="get">

                            <div class=" row align-items-center">
                                <div class="col-sm-3">
                                    <label>Tank Name</label>
                                    <select class="js-example-basic-single w-100" name="tank_id" required>
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
                        @if (request()->tank_id && request()->date_from && request()->date_to)
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <b>Tank</b>: {{ request()->tank_id }}
                                </div>
                                <div class="col-md-4">
                                    <b>Date from</b>: {{ request()->date_from }}
                                </div>
                                <div class="col-md-4">
                                    <b>Date to</b>: {{ request()->date_to }}
                                </div>
                            </div>
                        @endif --}}
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tank Name</th>
                                        {{-- <th>Refilled Date</th> --}}
                                        <th>Fuel Amount(L)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data->count() > 0)
                                        @foreach ($data as $item)
                                        {{-- @php
                                            $fuel = DB::table('stocks')->where('tank_id',$item->id)->sum
                                        @endphp --}}
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                {{-- <td>{{ $item->date }}</td> --}}
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
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
