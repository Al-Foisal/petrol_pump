@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">Create New Vehicle</div>
                    <div class="card-body">
                        <a href="{{ url('/vehicle') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/vehicle') }}" accept-charset="UTF-8" class="form-horizontal"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('backend.vehicle.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#group_id").hide();

        function toggleGroup(e) {
            console.log($(e).val());
            if ($(e).val() == 2) {
                $("#group_id").show();
            } else {
                $("#group_id").hide();
            }
        }
    </script>
@endsection
