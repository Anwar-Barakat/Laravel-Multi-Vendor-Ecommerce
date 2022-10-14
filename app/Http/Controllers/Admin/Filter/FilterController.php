<?php

namespace App\Http\Controllers\Admin\Filter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFilterRequest;
use App\Http\Requests\Admin\UpdateFilterRequest;
use App\Models\Filter;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections   = Section::activeSections();
        $filters    = Filter::active()->get();
        return view('admin.filters.index', ['filters' => $filters, 'sections' => $sections]);
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
        try {
            if ($request->isMethod('post')) {
                $data                   = $request->only(['category_ids', 'filter_name',  'status']);
                $data['filter_column']  = Str::slug($data['filter_name'], '_');
                $data['category_ids']   = implode(',', $data['category_ids']);

                Filter::create($data);

                DB::statement('ALTER TABLE products ADD ' . $data['filter_column'] . ' varchar(255) AFTER description');

                toastr()->success('Filter Has Bee Added Successfully');
                return redirect()->route('admin.filters.index');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
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
        try {
            if ($request->isMethod('put')) {
                $data                   = $request->only(['category_ids', 'status']);
                $data['category_ids']   = implode(',', $data['category_ids']);

                $filter->update($data);

                toastr()->success('Filter Has Bee Updated Successfully');
                return redirect()->route('admin.filters.index');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
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