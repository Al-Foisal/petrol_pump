@extends('layouts.app')

@section('css')
    <style>
        span {
            display: block;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">


            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Product List
                    </div>
                    <div class="card-body" style="background: rgb(249 249 246);">
                        <div class="row">
                            @foreach ($products as $item)
                                <div class="col-sm-4" onclick="getProductDetails(this,'{{ $item->id }}')">
                                    <div class="product_box_section">
                                        <div class="product_image_section">
                                            <img class="product_pos_img" src="{{ asset($item->image) }}" alt="">
                                        </div>
                                        <div class="product_info">
                                            <p class="product_name">{{ $item->name }}</p>
                                            <p class="product_price">{{ $item->price }} TK</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Order Details
                    </div>
                    <form action="{{ route('saveOrder') }}" method="post">
                        @csrf
                        <div class="card-body pos_order_details">
                            <div class="row">
                                <div class="mb-4 row align-items-center">
                                    <div class="row align-items-center">
                                        <label>Vehicle type</label>
                                        <div class="col-sm-6">
                                            <div class="form-check user-checkbox ps-0">
                                                <input class="checkbox_animated check-it" type="radio" value="1"
                                                    id="flexCheckDefault1" name="vehicle_type" checked>
                                                <label class="form-label-title col-sm-6 mb-0" for="flexCheckDefault1">
                                                    Nabil Paribahan</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-check user-checkbox ps-0">
                                                <input class="checkbox_animated check-it" type="radio" value="2"
                                                    id="flexCheckDefault2" name="vehicle_type">
                                                <label class="form-label-title col-sm-6 mb-0" for="flexCheckDefault2">
                                                    Others</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="">Customer</label>
                                        <select class="js-example-basic-single w-100" name="vehicle_id">
                                            @foreach ($nabil as $n_item)
                                                <option value="{{ $n_item->id }}">
                                                    {{ $n_item->vehicle_number }}({{ $n_item->supervisor_name ?? 'Not set yet' }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="{{ route('vehicle.create') }}"
                                            class="align-items-center btn btn-theme mt-4">
                                            <i data-feather="plus-square"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center" id="setProductDetails">
                                    <div>
                                        <div class="table-responsive">
                                            <table class="table coupon-list-table table-bordered" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Quantity (L)</th>
                                                        <th>Amount (TK)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="addProductDetails">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <div class="col-sm-4">
                                        <label>Total amount</label>
                                        <div>
                                            <input class="form-control" type="text" name="total_amount" id="total_amount"
                                                value="0" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Received amount</label>
                                        <div>
                                            <input class="form-control" type="text" name="received_amount"
                                                id="received_amount">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Changes amount</label>
                                        <div>
                                            <input class="form-control" type="text" name="changes_amount"
                                                id="changes_amount" value="0" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group mt-5">
                                        <input class="btn btn-primary" type="submit" value="Create">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[name="vehicle_type"]').on('change', function() {
                var vehicle_type = $(this).val();
                if (vehicle_type) {
                    $.ajax({
                        url: "{{ url('get-vehicle-details/') }}/" +
                            vehicle_type,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="vehicle_id"]')
                                .empty();
                            $.each(data, function(key, value) {
                                $('select[name="vehicle_id"]')
                                    .append(
                                        '<option value="' +
                                        value.id + '">' + value
                                        .vehicle_number + '(' + value.supervisor_name +
                                        ')</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });

        function getProductDetails(e, product_id) {
            if (product_id) {
                $.ajax({
                    url: "{{ url('get-product-details/') }}/" +
                        product_id,
                    type: "GET",
                    dataType: "html",
                    success: function(data) {
                        $("#addProductDetails").append(data);
                        getTotalSummation();

                    },
                });
            } else {
                alert('danger');
            }
        };

        function removeThisProduct(val) {
            $("#" + val).remove();
            getTotalSummation();
        }
    </script>

    <script>
        function changeAmount(e, price, id) {
            var amount = $("#singlePrice_" + id).val();
            var litter = $("#product_quantity_" + id).val();
            var total = 0;
            total = amount * litter;
            $("#product_amount_" + id).val(total.toFixed(2));
            getTotalSummation();
        }

        function changeLitter(e, price, id) {
            var amount = $("#product_amount_" + id).val();
            var total = 0;
            total = amount / price;
            $("#product_quantity_" + id).val(total.toFixed(2));
            getTotalSummation();
        }

        function getTotalSummation() {
            var sumv1 = 0;
            $(".amount").bind().each(function(index, obj) {
                sumv1 += parseInt($(this).val());
            });
            $("#total_amount").val(sumv1.toFixed(2));
        }
        $("#received_amount").on("keyup", function() {
            var total_amount = Number($("#total_amount").val());
            var received_amount = Number($("#received_amount").val());
            $("#changes_amount").val((received_amount - total_amount).toFixed(2));
        })
    </script>
@endsection
