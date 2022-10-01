<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Section;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with(['section', 'parentCategory'])->latest()->get();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            if ($request->isMethod('post')) {
                $data       = $request->only(['section_id', 'parent_id', 'name', 'discount', 'description', 'url', 'meta_title', 'meta_description', 'meta_keywords', 'status']);
                $category   = Category::create($data);

                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $category->clearMediaCollection('categories');
                    $category->addMediaFromRequest('image')->toMediaCollection('categories');
                }

                toastr()->success('Category Has Been Added Successfully');
                return back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::with('subCategories')->where(['section_id' => $category->section_id, 'parent_id' => 0])->get();
        return view('admin.categories.edit', ['category' => $category, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            if ($request->isMethod('put')) {
                $data       = $request->only(['section_id', 'parent_id', 'name', 'discount', 'description', 'url', 'meta_title', 'meta_description', 'meta_keywords', 'status']);
                $category->update($data);

                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $category->clearMediaCollection('categories');
                    $category->addMediaFromRequest('image')->toMediaCollection('categories');
                }

                toastr()->success('Category Has Been Updated Successfully');
                return back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error', $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}