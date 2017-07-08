<?php

namespace App\Http\Controllers;

use App\{Resource, ResourceRecord};
use App\Http\Requests\ResourceStatusUpdateRequest as Request;

class ResourceController extends Controller
{
    /**
     * Generate records for the beacon to validate.
     *
     * @param  Resource $resource
     * @return array
     */
    public function generate(Resource $resource) : array
    {
        $resource->get()->each->generateNewRecord();

        return ['status' => 'success', 'message' => 'Records generated!'];
    }

    /**
     * Updates the status.
     *
     * @param  Resource $resource
     * @return
     */
    public function updateStatus(ResourceRecord $record, Request $request)
    {
        $updated = $record->updateAvailability($request);

        return [
            'status'  => ($updated ? 'success' : 'error'),
            'message' => ($updated ? 'Record updated.' : 'Record update failed.'),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Resource $resources)
    {
        return $resources->with('records')->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        //
    }
}
