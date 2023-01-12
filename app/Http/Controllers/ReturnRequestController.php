<?php

namespace App\Http\Controllers;

use App\Models\ReturnRequest;
use App\Http\Requests\StoreReturnRequestRequest;
use App\Http\Requests\UpdateReturnRequestRequest;

class ReturnRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreReturnRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnRequest  $returnRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnRequest $returnRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnRequest  $returnRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnRequest $returnRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnRequestRequest  $request
     * @param  \App\Models\ReturnRequest  $returnRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnRequestRequest $request, ReturnRequest $returnRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnRequest  $returnRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnRequest $returnRequest)
    {
        //
    }
}
