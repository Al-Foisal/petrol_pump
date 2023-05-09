@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">Tank Stock Report</div>
                    <div class="card-body">
                        <form action="{{ route('tankWiseStock') }}" method="get">

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
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tankInfo->name }}</td>
                                            <td>{{ $item->date }}</td>
                                            <td>{{ $item->oil_amount }}</td>
                                        </tr>
                                    @endforeach
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
