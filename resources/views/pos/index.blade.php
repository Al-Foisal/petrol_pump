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
                                        <div class="col-sm-5">
                                            <div class="form-check user-checkbox ps-0">
                                                <input class="checkbox_animated check-it" type="radio" value="1"
                                                    id="flexCheckDefault1" name="vehicle_type" checked>
                                                <label class="form-label-title col-sm-6 mb-0" for="flexCheckDefault1">
                                                    Nabil Paribahan</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-check user-checkbox ps-0">
                                                <input class="checkbox_animated check-it" type="radio" value="2"
                                                    id="flexCheckDefault2" name="vehicle_type">
                                                <label class="form-label-title col-sm-6 mb-0" for="flexCheckDefault2">
                                                    Others</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4" id="group_id">
                                            <select class="js-example-basic-single w-100" name="group_id">
                                                <option>Select group</option>
                                                @foreach ($groups as $n_item)
                                                    <option value="{{ $n_item->name }}">
                                                        {{ $n_item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <div class="col-sm-6">
                                        <label for="">Customer</label>
                                        <select class="js-example-basic-single w-100" name="vehicle_id">
                                            @foreach ($nabil as $n_item)
                                                <option value="{{ $n_item->id }}"
                                                    @if ($n_item->type == 1) {{ 'selected' }} @endif>
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
                                    <input type="hidden" name="vat_amount" id="vat_amount">
                                    <div class="col-sm-6">
                                        <label>Total amount</label>
                                        <div>
                                            <input class="form-control" type="text" name="total_amount" id="total_amount"
                                                value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Payable amount</label>
                                        <div>
                                            <input class="form-control" type="text" name="payable_amount"
                                                id="payable_amount" value="0" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group mt-5 text-center">
                                        <input class="btn btn-primary px-5 pe-5" style="letter-spacing: 3px;" type="submit"
                                            value="Sell">
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
        $("#group_id").hide();
        $(document).ready(function() {
            $('input[name="vehicle_type"]').on('change', function() {
                var vehicle_type = $(this).val();
                if (vehicle_type) {
                    if (vehicle_type == 1) {
                        $("#group_id").hide();
                    } else {
                        $("#group_id").show();
                    }
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
                            getTotalSummation();
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });

        const arr = [];

        function getProductDetails(e, product_id) {
            if (product_id) {
                if (arr.includes(product_id) == true) {
                    $.ajax({
                        url: "{{ url('get-single-product-details/') }}/" +
                            product_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            var present_quantity = $("#product_quantity_" + product_id).val();
                            var present_amount = $("#product_amount_" + product_id).val();
                            $("#product_quantity_" + product_id).val(Number(present_quantity) + 1);
                            $("#product_amount_" + product_id).val(Number(present_amount) + Number(data.price));
                            getTotalSummation();
                        },
                    });
                } else {
                    arr.push(product_id);

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
                }
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
                sumv1 += Number($(this).val());
            });

            var type = document.querySelector('input[name="vehicle_type"]:checked').value;
            console.log(type);
            if (type == '2') {

                var vat = 0;
                var vat_amount = 0;
                var total_vat = 0;
                $.ajax({
                    url: "{{ url('get-vat') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        vat = Number(data.vat);
                        vat_amount = Number((sumv1 * vat) / 100);
                        $("#vat_amount").val(vat_amount);
                        if (vat) {
                            total_vat = sumv1 + Number((sumv1 * vat) / 100);

                            $("#total_amount").val(total_vat.toFixed(2));
                            var vehicle_type = document.querySelector('input[name="vehicle_type"]:checked')
                                .value;
                            if (vehicle_type == 1) {
                                $("#payable_amount").val(0);
                            } else {
                                $("#payable_amount").val(total_vat.toFixed(2));
                            }
                        } else {
                            $("#total_amount").val(sumv1.toFixed(2));
                            var vehicle_type = document.querySelector('input[name="vehicle_type"]:checked')
                                .value;
                            if (vehicle_type == 1) {
                                $("#payable_amount").val(0);
                            } else {
                                $("#payable_amount").val(sumv1.toFixed(2));
                            }
                        }

                    },
                });
            } else {
                $("#total_amount").val(sumv1.toFixed(2));
                var vehicle_type = document.querySelector('input[name="vehicle_type"]:checked').value;
                if (vehicle_type == 1) {
                    $("#payable_amount").val(0);
                } else {
                    $("#payable_amount").val(sumv1.toFixed(2));
                }
            }

        }
        $("#received_amount").on("keyup", function() {
            var total_amount = Number($("#total_amount").val());
            var received_amount = Number($("#received_amount").val());
            $("#changes_amount").val((received_amount - total_amount).toFixed(2));
        })
    </script>
@endsection
