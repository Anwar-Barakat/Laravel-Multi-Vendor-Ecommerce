<?php

namespace App\Http\Controllers\Admin\ShippingCharges;

use App\Http\Requests\Admin\StoreShippingChargesRequest;
use App\Http\Requests\Admin\UpdateShippingChargesRequest;
use App\Models\ShippingCharges;
use App\Http\Controllers\Controller;

class ShippingChargesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chargers    =   ShippingCharges::with(['country'])->latest()->get();
        return view('admin.shipping-charges.index', ['chargers' => $chargers]);
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
    public function update(UpdateShippingChargesRequest $request, ShippingCharges $shipping_charge)
    {
        if ($request->isMethod('put')) {
            try {
                $data   = $request->only(['zero_500g', '_501_1000g', '_1001_2000g', '_2001_5000g', 'above_5000g']);
                $shipping_charge->update($data);
                toastr()->success('Shipping Charges Has Been Updated Successfully');
                return back();
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['error', $th->getMessage()]);
            }
        }
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