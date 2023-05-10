<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $data = Group::orderBy('id', 'desc')->get();

        return view('group.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        Group::create($request->all());

        return back()->withToastSuccess('New vehicle created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group) {
        return view('group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group) {
        $group->update($request->all());

        return to_route('group.index')->withToastSuccess('Vehicle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group) {
        //
    }
}
