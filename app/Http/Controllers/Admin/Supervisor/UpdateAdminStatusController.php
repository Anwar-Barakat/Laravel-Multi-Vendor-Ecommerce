<?php

namespace App\Http\Controllers\Admin\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class UpdateAdminStatusController extends Controller
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
            $data = $request->only(['status', 'admin_id']);
            if ($data['status'] == 1)
                $status = 0;
            else
                $status = 1;
            Admin::where('id', $data['admin_id'])->update([
                'status'            => $status
            ]);
            return response()->json([
                'status'            => $status,
                'admin_id'          => $data['admin_id']
            ]);
        }
    }
}