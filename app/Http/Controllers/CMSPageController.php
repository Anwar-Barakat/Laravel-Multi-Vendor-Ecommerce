<?php

namespace App\Http\Controllers;

use App\Models\CMSPage;
use App\Http\Requests\StoreCMSPageRequest;
use App\Http\Requests\UpdateCMSPageRequest;

class CMSPageController extends Controller
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
     * @param  \App\Http\Requests\StoreCMSPageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCMSPageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CMSPage  $cMSPage
     * @return \Illuminate\Http\Response
     */
    public function show(CMSPage $cMSPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CMSPage  $cMSPage
     * @return \Illuminate\Http\Response
     */
    public function edit(CMSPage $cMSPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCMSPageRequest  $request
     * @param  \App\Models\CMSPage  $cMSPage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCMSPageRequest $request, CMSPage $cMSPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CMSPage  $cMSPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CMSPage $cMSPage)
    {
        //
    }
}
