<?php

namespace App\Http\Controllers\Admin\CmsPage;

use App\Http\Requests\Admin\StoreCmsPageRequest;
use App\Http\Requests\Admin\UpdateCmsPageRequest;
use App\Models\CmsPage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms_pages      = CmsPage::latest()->get();
        return view('admin.cms-pages.index', ['cms_pages' => $cms_pages]);
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
     * @param  \App\Http\Requests\StoreCmsPageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCmsPageRequest $request)
    {
        try {
            if ($request->isMethod('post')) {
                $data                   = $request->only(['title', 'description', 'meta_title', 'meta_description', 'meta_keywords']);
                $data['url']            = Str::slug($data['title']);

                CmsPage::create($data);
                toastr()->success('CMS Page Has Been Added Successfully');
                return back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error', $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function edit(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCmsPageRequest  $request
     * @param  \App\Models\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCmsPageRequest $request, CmsPage $cmsPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CmsPage  $cmsPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsPage $cmsPage)
    {
        //
    }
}