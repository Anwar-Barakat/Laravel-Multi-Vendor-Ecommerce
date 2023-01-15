<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRequest;
use App\Http\Requests\StoreExchangeRequestRequest;
use App\Http\Requests\UpdateExchangeRequestRequest;

class ExchangeRequestController extends Controller
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
     * @param  \App\Http\Requests\StoreExchangeRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExchangeRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExchangeRequest  $exchangeRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ExchangeRequest $exchangeRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExchangeRequest  $exchangeRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ExchangeRequest $exchangeRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExchangeRequestRequest  $request
     * @param  \App\Models\ExchangeRequest  $exchangeRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExchangeRequestRequest $request, ExchangeRequest $exchangeRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExchangeRequest  $exchangeRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExchangeRequest $exchangeRequest)
    {
        //
    }
}
