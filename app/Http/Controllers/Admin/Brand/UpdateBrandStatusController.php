<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class UpdateBrandStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->only(['status', 'brand_id']);
            $data['status'] == 1 ? $status = 0 : $status = 1;
            Brand::where('id', $data['brand_id'])->update([
                'status'            => $status
            ]);
            return response()->json([
                'status'            => $status,
                'brand_id'          => $data['brand_id']
            ]);
        }
    }
}