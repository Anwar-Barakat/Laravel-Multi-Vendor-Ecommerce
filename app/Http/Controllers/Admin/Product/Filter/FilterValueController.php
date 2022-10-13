<?php

namespace App\Http\Controllers\Admin\Product\Filter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFilterValueRequest;
use App\Http\Requests\Admin\UpdateFilterValueRequest;
use App\Models\FilterValue;

class FilterValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter_values = FilterValue::active()->get();
        return view('admin.products.filter-values.index', ['filter_values' => $filter_values]);
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
     * @param  \App\Http\Requests\StoreFilterValueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFilterValueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FilterValue  $filterValue
     * @return \Illuminate\Http\Response
     */
    public function show(FilterValue $filterValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FilterValue  $filterValue
     * @return \Illuminate\Http\Response
     */
    public function edit(FilterValue $filterValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFilterValueRequest  $request
     * @param  \App\Models\FilterValue  $filterValue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFilterValueRequest $request, FilterValue $filterValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FilterValue  $filterValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(FilterValue $filterValue)
    {
        //
    }
}