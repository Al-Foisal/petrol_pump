<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
}
