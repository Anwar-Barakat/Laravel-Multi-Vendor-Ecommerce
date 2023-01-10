<?php

namespace App\Http\Controllers\Admin\Currency;

use App\Models\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCurrencyRequest;
use App\Http\Requests\Admin\UpdateCurrencyRequest;
use Illuminate\Support\Str;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies     = Currency::latest()->get();
        return view('admin.currencies.index', ['currencies' => $currencies]);
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
     * @param  \App\Http\Requests\StoreCurrencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurrencyRequest $request)
    {
        try {
            if ($request->isMethod('post')) {
                $data                   = $request->only(['code', 'exchange_rate']);

                Currency::create($data);
                toastr()->success('Currency Has Been Added Successfully');
                return back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error', $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCurrencyRequest  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        try {
            if ($request->isMethod('put')) {
                $data                   = $request->only(['code', 'exchange_rate']);

                $currency->update($data);
                toastr()->success('Currency Has Been Added Successfully');
                return back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error', $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();
        toastr()->info('Currency Has Been Deleted');
        return redirect()->back();
    }
}