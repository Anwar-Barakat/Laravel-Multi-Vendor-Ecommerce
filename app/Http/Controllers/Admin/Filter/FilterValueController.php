<?php

namespace App\Http\Controllers\Admin\Filter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFilterValueRequest;
use App\Http\Requests\Admin\UpdateFilterValueRequest;
use App\Models\Filter;
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
        $data['filter_values']  = FilterValue::active()->get();
        $data['filters']        = Filter::active()->get();
        return view('admin.filter-values.index', $data);
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
        try {
            if ($request->isMethod('post')) {
                $data   = $request->only(['filter_id', 'filter_value', 'status']);
                FilterValue::create($data);

                toastr()->success('Filter Value Has Been Added Successfully');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
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