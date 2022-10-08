<?php

namespace App\Http\Controllers\Admin\Product\Attribute;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class UpdateAttributeStatusController extends Controller
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
            $data = $request->only(['status', 'attribute_id']);
            $data['status'] == 1 ? $status = 0 : $status = 1;
            Attribute::where('id', $data['attribute_id'])->update(['status' => $status]);

            return response()->json([
                'status'            => $status,
                'attribute_id'      => $data['attribute_id']
            ]);
        }
    }
}