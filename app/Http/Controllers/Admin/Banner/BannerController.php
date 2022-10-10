<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.banners.index', ['banners' => Banner::latest()->get()]);
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
     * @param  \App\Http\Requests\StoreBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        try {
            if ($request->isMethod('post')) {
                $data           = $request->only(['title', 'status', 'alternative', 'image']);
                $data['link']   = Str::slug($data['title'], '-');
                $banner         = Banner::create($data);

                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $banner->addMediaFromRequest('image')->toMediaCollection('banners');
                }

                toastr()->success('Banner Has Been Added Successfully');
                return back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBannerRequest  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        try {
            if ($request->isMethod('put')) {
                $data           = $request->only(['title', 'alternative', 'image', 'status']);
                $data['link']   = Str::slug($data['title'], '-');
                $banner->update($data);

                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $banner->clearMediaCollection('banners');
                    $banner->addMediaFromRequest('image')->toMediaCollection('banners');
                }

                toastr()->success('Category Has Been Updated Successfully');
                return back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        try {
            $banner->clearMediaCollection('categories');
            Media::where(['model_id' => $banner->id, 'collection_name' => 'categories'])->delete();
            $banner->delete();
            toastr()->info('Banner Has Been Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error', $th->getMessage()]);
        }
    }
}