<?php

namespace App\Http\Controllers\Admin\Section;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class UpdateSectionStatusController extends Controller
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
            $data = $request->only(['status', 'section_id']);
            if ($data['status'] == 1)
                $status = 0;
            else
                $status = 1;
            Section::where('id', $data['section_id'])->update([
                'status'            => $status
            ]);
            return response()->json([
                'status'            => $status,
                'section_id'        => $data['section_id']
            ]);
        }
    }
}