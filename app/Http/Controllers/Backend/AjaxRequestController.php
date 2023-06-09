<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vat;
use App\Models\Vehicle;

class AjaxRequestController extends Controller {
    public function getVehicleDetails($vehicle_type) {
        $vehicle = Vehicle::where('vehicle_type', $vehicle_type)->get();

        return json_encode($vehicle);
    }

    public function getProductDetails($id) {
        $single_product = Product::find($id);

        $pp = session('product', ['id' => $single_product->id, 'price' => $single_product->price]);

        return view('pos.product-details', compact('single_product', 'pp'));
    }

    public function getSingleProductDetails($id) {
        $single_product = Product::find($id);

        return $single_product;
    }

    public function getVat() {
        $vat = Vat::where('status', 1)->where('id', 1)->first();

        return $vat;
    }
}
