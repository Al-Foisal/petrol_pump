<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class PosController extends Controller {
    public function index() {
        $data             = [];
        $data['products'] = $products = Product::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();
        $data['nabil'] = Vehicle::where('vehicle_type', 1)->get();

        return view('pos.index', $data);
    }

    public function saveOrder(Request $request) {

        if (count($request->product_id)) {
            return back();
        }

        $vehicle      = Vehicle::find($request->vehicle_id);
        $vehicle_type = $vehicle->vehicle_type == 1 ? 'Nabil Paribahan' : 'Others';
        $order        = Order::create([
            'vehicle_model'             => $vehicle->model,
            'vehicle_number'            => $vehicle->vehicle_number,
            'vehicle_supervisor_name'   => $vehicle->supervisor_name,
            'vehicle_supervisor_mobile' => $vehicle->supervisor_mobile,
            'vehicle_type'              => $vehicle_type,
            'total_amount'              => $request->total_amount,
            'received_amount'           => $request->received_amount,
            'changes_amount'            => $request->changes_amount,
        ]);

        foreach ($request->product_id as $key => $product_id) {
            $product        = Product::find($product_id);
            $updated_stock  = $product->stock - $request->quantity[$key];
            $product->stock = $updated_stock > 0 ? $updated_stock : 0;
            $product->save();

            OrderDetails::create([
                'order_id'         => $order->id,
                'product_name'     => $product->name,
                'product_quantity' => $request->product_quantity[$key],
                'product_amount'   => $request->product_amount[$key],
                'unit_price'       => $product->price,
            ]);
        }

    }

}
