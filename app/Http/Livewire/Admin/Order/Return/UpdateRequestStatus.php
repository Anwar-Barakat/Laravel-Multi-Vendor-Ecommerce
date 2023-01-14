<?php

namespace App\Http\Livewire\Admin\Order\Return;

use App\Models\OrderProduct;
use App\Models\ReturnRequest;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdateRequestStatus extends Component
{
    public $request_status, $request_id, $product_code, $product_size;

    public function mount()
    {
        $returnRequest          = ReturnRequest::findOrFail($this->request_id);
        $this->request_status   = $returnRequest->status;
    }

    public function updatedRequestStatus()
    {
        try {
            $returnRequest          = ReturnRequest::with('order')->findOrFail($this->request_id);
            if ($returnRequest) {
                DB::beginTransaction();
                $returnRequest->update(['status' => $this->request_status]);

                $orderProduct           = OrderProduct::where(['order_id' => $returnRequest->order->id, 'product_code' => $this->product_code, 'product_size' => $this->product_size])->first();
                $orderProduct->update(['product_status' => 'Return ' . $this->request_status]);
                DB::commit();
                toastr()->success('Return Request Status Has Been Updated Successfully');
            } else
                abort(404);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.admin.order.return.update-request-status');
    }
}