<?php

namespace App\Http\Controllers\Admin\Product\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAttributeRequest;
use App\Http\Requests\Admin\UpdateAttributeRequest;
use App\Models\Attribute;
use App\Models\Product;

class AttributeController extends Controller
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
        return view('admin.products.attributes.add', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttributeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttributeRequest $request, Product $product)
    {
        try {
            $data = $request->only(['size', 'sku', 'price', 'stock']);

            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    // SKU Must Be Unique :
                    $skuCount = Attribute::where('sku', $value)->count();
                    if ($skuCount > 0) {
                        toastr()->info('SkU Has Already Existed');
                        return back();
                    }
                    // Size of Product Must Be Unique :
                    $sizeCount = Attribute::where(['size' => $data['size'][$key], 'product_id' => $product->id])->count();
                    if ($sizeCount > 0) {
                        toastr()->info('Size Has Already Existed');
                        return back();
                    }

                    Attribute::create([
                        'product_id'    => $product->id,
                        'sku'           => $value,
                        'size'          => $data['size'][$key],
                        'price'         => $data['price'][$key],
                        'stock'         => $data['stock'][$key],
                        'status'        => 1,
                    ]);
                }
            }
            toastr()->success('Attributes Has Been Added Successfuly');
            return back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttributeRequest  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttributeRequest $request, Product $product)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}