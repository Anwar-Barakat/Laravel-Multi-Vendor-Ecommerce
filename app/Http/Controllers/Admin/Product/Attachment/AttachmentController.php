<?php

namespace App\Http\Controllers\Admin\Product\Attachment;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AttachmentController extends Controller
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
    public function create(Product $product)
    {
        return view('admin.products.attachments.add', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {

        try {
            if ($request->isMethod('post')) {
                $product = Product::findOrFail($product->id);
                $validatedData = $request->validate([
                    'image'             => 'required|array',
                    'image.*'           => 'required|image|mimes:jpeg,png,jpg|max:1048',
                ]);

                if ($request->hasFile('image')) {
                    $product->addMultipleMediaFromRequest(['image'])->each(function ($image) {
                        $image->toMediaCollection('product_attachments');
                    });
                }
                toastr()->success('Attachments Has Been Added Successfully');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $media = Media::whereId($id)->first();
            $media->delete();
            toastr()->info('Attachment Has Been Deleted Successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
        }
    }
}