<?php

namespace App\Http\Controllers\Admin\Product\Filter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFilterRequest;
use App\Http\Requests\Admin\UpdateFilterRequest;
use App\Models\Filter;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.filters.index', ['filters' => Filter::active()->get()]);
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
     * @param  \App\Http\Requests\StoreFilterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFilterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function show(Filter $filter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function edit(Filter $filter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFilterRequest  $request
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFilterRequest $request, Filter $filter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filter  $filter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filter $filter)
    {
        //
    }
}