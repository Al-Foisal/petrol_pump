@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Vat area</h2>
            </div>
            <div class="pull-right">
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('vatStoreUpdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">


                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <strong>Vat(%)</strong>
                                    <input type="text" name="vat" class="form-control" placeholder="5"
                                        value="{{ $vat->vat ?? 0 }}">
                                </div>
                            </div>
                            <div class="col-xs-9 col-sm-9 col-md-9">
                                <div class="mb-4 row align-items-center">
                                    <div class="row align-items-center">
                                        <label>Status</label>
                                        <div class="col-sm-6 mt-2">
                                            <div class="form-check user-checkbox ps-0">
                                                <input class="checkbox_animated check-it" type="radio" value="1"
                                                    id="flexCheckDefault1" name="status"
                                                    @if ($vat && $vat->status == 1) {{ 'checked' }} @endif>
                                                <label class="form-label-title col-sm-6 mb-0" for="flexCheckDefault1">
                                                    Active</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-2">
                                            <div class="form-check user-checkbox ps-0">
                                                <input class="checkbox_animated check-it" type="radio" value="0"
                                                    id="flexCheckDefault2" name="status"
                                                    @if ($vat && $vat->status == 0) {{ 'checked' }} @endif>
                                                <label class="form-label-title col-sm-6 mb-0" for="flexCheckDefault2">
                                                    Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <div class="form-group" style="margin-top: 25px">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
