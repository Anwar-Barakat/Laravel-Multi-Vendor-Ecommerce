<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class UpdateCategoryStatusController extends Controller
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
            $data = $request->only(['status', 'category_id']);
            $data['status'] == 1 ? $status = 0 : $status = 1;
            Category::where('id', $data['category_id'])->update(['status' => $status]);

            return response()->json([
                'status'            => $status,
                'category_id'       => $data['category_id']
            ]);
        }
    }
}