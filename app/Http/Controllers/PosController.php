<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Vat;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class PosController extends Controller {
    public function dashboard() {
        $data            = [];
        $todays_sell     = Order::whereDate('created_at', today())->get();
        $todays_quantity = 0;
        $todays_amount   = 0;

        foreach ($todays_sell as $sell) {
            $todays_amount += $sell->total_amount;

            foreach ($sell->orderDetails as $details) {
                $todays_quantity += $details->product_quantity;
            }

        }

        $data['todays_quantity'] = $todays_quantity;
        $data['todays_amount']   = $todays_amount;

        $total_sell     = Order::all();
        $total_quantity = 0;
        $total_amount   = 0;

        foreach ($total_sell as $sell) {
            $total_amount += $sell->total_amount;

            foreach ($sell->orderDetails as $details) {
                $total_quantity += $details->product_quantity;
            }

        }

        $data['total_quantity'] = $total_quantity;
        $data['total_amount']   = $total_amount;
        $this_month             = Order::whereYear('created_at', date("Y"))->whereMonth('created_at', date("m"))->get();

        $this_month_amount   = 0;
        $this_month_quantity = 0;

        foreach ($this_month as $sell) {
            $this_month_amount += $sell->total_amount;

            foreach ($sell->orderDetails as $details) {
                $this_month_quantity += $details->product_quantity;
            }

        }

        $data['this_month_amount']   = $this_month_amount;
        $data['this_month_quantity'] = $this_month_quantity;

        $data['products'] = Product::all();

        return view('home', $data);
    }

    public function index() {
        $data             = [];
        $data['products'] = $products = Product::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();
        $data['nabil']  = Vehicle::where('vehicle_type', 1)->get();
        $data['groups'] = Group::all();

        return view('pos.index', $data);
    }

    public function saveOrder(Request $request) {

        foreach ($request->product_id as $key => $product_id) {
            $product = Product::find($product_id);

            if ($product->stock > $request->product_quantity[$key]) {
                continue;
            } else {
                return back()->withToastError('Insufficient stock for - ' . $product->name . ', stock - ' . $product->stock . ', input - ' . $request->product_quantity[$key]);
            }

        }

        $data = [];

        $last_order = Order::orderBy('id', 'desc')->first();

        if ($last_order) {
            $invoice = $last_order->invoice_no + 1;
        } else {
            $invoice = 1;
        }

        $vehicle      = Vehicle::find($request->vehicle_id);
        $vehicle_type = $vehicle->vehicle_type == 1 ? 'Nabil Paribahan' : 'Others';

        if ($vehicle->vehicle_type == 1) {
            $group_id = null;
        } else {
            $group_id = $vehicle->group_id;
        }

        $order = Order::create([
            'invoice_no'                => $invoice,
            'vehicle_model'             => $vehicle->model,
            'vehicle_number'            => $vehicle->vehicle_number,
            'vehicle_supervisor_name'   => $vehicle->supervisor_name,
            'vehicle_supervisor_mobile' => $vehicle->supervisor_mobile,
            'vehicle_type'              => $vehicle_type,
            'total_amount'              => $request->total_amount,
            'payable_amount'            => $request->payable_amount,
            'group_id'                  => $group_id,
        ]);

        foreach ($request->product_id as $key => $product_id) {
            $product        = Product::find($product_id);
            $updated_stock  = $product->stock - $request->product_quantity[$key];
            $product->stock = $updated_stock > 0 ? $updated_stock : 0;
            $product->save();

            OrderDetails::create([
                'order_id'         => $order->id,
                'product_name'     => $product->name,
                'product_quantity' => $request->product_quantity[$key],
                'product_amount'   => $request->product_amount[$key],
                'unit_price'       => $product->price,
                'product_id'       => $request->product_id[$key],
            ]);
        }

        $data['order'] = $order;

        return to_route('invoice', $order);
    }

    public function invoice($id) {
        $order = Order::find($id);

        return view('invoice', compact('order'));
    }

    public function createVat() {
        $vat = Vat::find(1);

        return view('vat', compact('vat'));
    }

    public function vatStoreUpdate(Request $request) {
        Vat::updateOrCreate(
            [
                'id' => 1,
            ],
            [
                'vat'    => $request->vat,
                'status' => $request->status,
            ]);

        return back()->withToastSuccess('Vat updated successfully!!');
    }

    public function sellingHistory() {
        $data = Order::orderBy('id', 'desc');

        if (request()->date_from && request()->date_to) {
            $data = $data->whereDate('created_at', '>=', request()->date_from)->whereDate('created_at', '<=', request()->date_to);
        }

        if (request()->company_name) {
            $data = $data->orWhere('vehicle_type', request()->company_name)->orWhere('group_id', request()->company_name);
        }

        if (request()->product_id) {
            $p_id = request()->product_id;
            $data = $data->with([
                'orderDetails' => function ($query) use ($p_id) {
                    return $query->where('product_id', $p_id);
                },

            ])->paginate(100);

        } else {
            $data = $data->with('orderDetails')->paginate(100);
        }

        $group   = Group::all();
        $product = Product::all();

        return view('sell.selling-history', compact('data', 'group', 'product'));
    }

    public function nabilSell() {
        $data = Order::orderBy('id', 'desc')->where('vehicle_type', 'Nabil Paribahan');

        if (request()->date_from && request()->date_to) {
            $data = $data->whereDate('created_at', '>=', request()->date_from)->whereDate('created_at', '<=', request()->date_to);
        }

        if (request()->product_id) {
            $p_id = request()->product_id;
            $data = $data->with([
                'orderDetails' => function ($query) use ($p_id) {
                    return $query->where('product_id', $p_id);
                },

            ])->paginate(100);

        } else {
            $data = $data->with('orderDetails')->paginate(100);
        }

        $product = Product::all();

        return view('sell.nabil-sell', compact('data', 'product'));
    }

    public function otherSell() {
        $data = Order::orderBy('id', 'desc')->where('vehicle_type', 'Others');

        if (request()->date_from && request()->date_to) {
            $data = $data->whereDate('created_at', '>=', request()->date_from)->whereDate('created_at', '<=', request()->date_to);
        }

        if (request()->company_name) {
            $data = $data->orWhere('vehicle_type', request()->company_name)->orWhere('group_id', request()->company_name);

        }

// dd(request()->product_id);

        if (request()->product_id) {
            $p_id = request()->product_id;
            $data = $data->with([
                'orderDetails' => function ($query) use ($p_id) {
                    return $query->where('product_id', $p_id);
                },

            ])->paginate(100);

        } else {
            $data = $data->with('orderDetails')->paginate(100);
        }

        $group   = Group::all();
        $product = Product::all();

        return view('sell.other-sell', compact('data', 'group', 'product'));
    }

}
