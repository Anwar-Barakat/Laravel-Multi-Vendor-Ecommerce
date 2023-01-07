<?php

namespace App\Http\Controllers;

use App\Models\ShippingCharges;
use App\Http\Requests\StoreShippingChargesRequest;
use App\Http\Requests\UpdateShippingChargesRequest;

class ShippingChargesController extends Controller
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
     * @param  \App\Http\Requests\StoreShippingChargesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShippingChargesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingCharges  $shippingCharges
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingCharges $shippingCharges)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingCharges  $shippingCharges
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingCharges $shippingCharges)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShippingChargesRequest  $request
     * @param  \App\Models\ShippingCharges  $shippingCharges
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShippingChargesRequest $request, ShippingCharges $shippingCharges)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingCharges  $shippingCharges
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingCharges $shippingCharges)
    {
        //
    }
}
