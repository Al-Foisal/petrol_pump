<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $vehicle = Vehicle::where('model', 'LIKE', "%$keyword%")
                ->orWhere('vehicle_number', 'LIKE', "%$keyword%")
                ->orWhere('supervisor_name', 'LIKE', "%$keyword%")
                ->orWhere('supervisor_mobile', 'LIKE', "%$keyword%")
                ->orWhere('supervisor_mobile', 'LIKE', "%$keyword%")
                ->orWhere('vehicle_type', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $vehicle = Vehicle::latest()->paginate($perPage);
        }

        return view('backend.vehicle.index', compact('vehicle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $groups = Group::all();

        return view('backend.vehicle.create',compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {

        $requestData = $request->all();

        Vehicle::create($requestData);

        return redirect('vehicle')->with('flash_message', 'Vehicle added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $vehicle = Vehicle::findOrFail($id);

        return view('backend.vehicle.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $vehicle = Vehicle::findOrFail($id);
        $groups = Group::all();

        return view('backend.vehicle.edit', compact('vehicle','groups'));
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

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($requestData);

        return redirect('vehicle')->with('flash_message', 'Vehicle updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Vehicle::destroy($id);

        return redirect('vehicle')->with('flash_message', 'Vehicle deleted!');
    }

}
