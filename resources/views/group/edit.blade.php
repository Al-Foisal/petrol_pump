@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">Edit Group #{{ $group->name }}</div>
                    <div class="card-body">
                        <a href="{{ url('/group') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/group/' . $group->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name" class="control-label">{{ 'Name' }}</label>
                                <input class="form-control" name="name" value="{{ $group->name }}" type="text" id="name" placeholder="Enter group name" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value=" Create">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
