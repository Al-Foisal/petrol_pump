<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Tank;
use Illuminate\Http\Request;

class StockController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $stock = Stock::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('tank_id', 'LIKE', "%$keyword%")
                ->orWhere('oil_amount', 'LIKE', "%$keyword%")
                ->orWhere('date', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $stock = Stock::latest()->paginate($perPage);
        }

        return view('backend.stock.index', compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('backend.stock.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        // dd($request->all());
        $requestData = $request->all();

        Stock::create($requestData);

        $product        = Product::find($requestData['product_id']);
        $product->stock = $product->stock + $requestData['oil_amount'];
        $product->save();

        return redirect('stock')->with('flash_message', 'Stock added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $stock = Stock::findOrFail($id);

        return view('backend.stock.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $stock = Stock::findOrFail($id);

        return view('backend.stock.edit', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id) {

        $requestData = $request->all();

        $stock = Stock::findOrFail($id);
        $stock->update($requestData);

        return redirect('stock')->with('flash_message', 'Stock updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Stock::destroy($id);

        return redirect('stock')->with('flash_message', 'Stock deleted!');
    }

    public function tankWiseStock() {

        $data = Stock::orderBy('id', 'desc');

        if (request()->tank_id && request()->date_from && request()->date_to) {
            $data = $data->where('tank_id', request()->tank_id)
                ->where('date', '>=', request()->date_from)
                ->where('date', '<=', request()->date_to);
        }

        $data = $data->paginate(100);

        $tanks = Tank::where('status', 1)->get();

        return view('stock-report.tank-wise-report', compact('data', 'tanks'));
    }

    public function lowStockAlert() {

    }

    public function stockReport() {

    }

}
