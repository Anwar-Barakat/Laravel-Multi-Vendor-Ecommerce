<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Section;
use Illuminate\Pagination\Paginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.products.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try {
            if ($request->isMethod('post')) {
                $data                   = $request->except('image', 'video');
                $category               = Category::findOrFail($data['category_id']);
                $section_id             = Section::findOrFail($category->section_id)->id;
                $data['section_id']     = $section_id;


                $filters    = Filter::with(['filterValues'])->active()->get();
                foreach ($filters as $filter) {
                    if (in_array($category->id, explode(',', $filter->category_ids))) {
                        $data[$filter->filter_column]   = $data[$filter->filter_column];
                    }
                }

                $product = Product::create($data);

                if ($request->hasFile('image') && $request->file('image')->isValid())
                    $product->addMediaFromRequest('image')->toMediaCollection('main_img_of_product');

                if ($request->hasFile('video') && $request->file('video')->isValid())
                    $product->addMediaFromRequest('video')->toMediaCollection('main_video_of_product');

                toastr()->success('Product Has Been Added Successfully');
                return back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $sections = Section::with(['categories'])->get();
        return view('admin.products.edit', ['product' => $product, 'sections' => $sections]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            if ($request->isMethod('put')) {
                $data                   = $request->only(['category_id', 'brand_id', 'admin_id', 'name', 'code', 'color', 'price', 'discount', 'weight', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'is_featured', 'is_best_seller', 'status']);
                $category               = Category::findOrFail($data['category_id']);
                $section_id             = Section::findOrFail($category->section_id)->id;
                $data['section_id']     = $section_id;

                $product->update($data);

                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $category->clearMediaCollection('main_img_of_product');
                    $product->addMediaFromRequest('image')->toMediaCollection('main_img_of_product');
                }

                if ($request->hasFile('video') && $request->file('video')->isValid()) {
                    $category->clearMediaCollection('main_video_of_product');
                    $product->addMediaFromRequest('video')->toMediaCollection('main_video_of_product');
                }

                toastr()->success('Product Has Been Updated Successfully');
                return back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}