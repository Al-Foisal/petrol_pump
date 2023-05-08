@extends('layouts.app')

@section('css')
@endsection
@section('content')
    <div id="invoice-POS">

        <center id="top">
            <div class="logo"></div>
            <div class="info">
                <h2>Nabil Paribahan Ltd.</h2>
            </div>
            <!--End Info-->
        </center>
        <!--End InvoiceTop-->

        <div id="mid">
            <div class="info">
                <h2>Contact Info</h2>
                <p>
                    Name: {{ $order->vehicle_supervisor_name }}</br>
                    Phone: {{ $order->vehicle_supervisor_mobile }}</br>
                    Vehicle Number: {{ $order->vehicle_number }}</br>
                    Vehicle Type: {{ $order->vehicle_type }}</br>
                </p>
            </div>
        </div>
        <!--End Invoice Mid-->

        <div id="bot">

            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Item</h2>
                        </td>
                        <td class="Hours">
                            <h2>Qty</h2>
                        </td>
                        <td class="Rate">
                            <h2>Sub Total</h2>
                        </td>
                    </tr>
                    @foreach ($order->orderDetails as $details)
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext">{{ $details->product_name }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ $details->product_quantity }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">${{ number_format($details->product_amount, 2) }}</p>
                            </td>
                        </tr>
                    @endforeach


                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate">
                            <h2>Total</h2>
                        </td>
                        <td class="payment">
                            <h2>${{ number_format($order->total_amount, 2) }}</h2>
                        </td>
                    </tr>

                </table>
            </div>
            <!--End Table-->

            <div id="legalcopy">
                <p class="legal"><strong>Thank you for your business!</strong>  <br>
                    This is an autometic generated invoice.
                    Developed by: www.wiztecbd.com
                </p>
            </div>

        </div>
        <!--End InvoiceBot-->
    </div>
    <!--End Invoice-->
@endsection
