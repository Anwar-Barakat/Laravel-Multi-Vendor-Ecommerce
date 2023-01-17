<?php

namespace App\Http\Livewire\Admin\Order\Exchange;

use App\Models\ExchangeRequest;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdateRequestStatus extends Component
{
    public $request_status, $request_id, $product_code, $product_size;

    public function mount()
    {
        $returnRequest          = ExchangeRequest::findOrFail($this->request_id);
        $this->request_status   = $returnRequest->status;
    }

    public function updatedRequestStatus()
    {
        try {
            $returnRequest          = ExchangeRequest::with('order')->findOrFail($this->request_id);
            if ($returnRequest) {
                DB::beginTransaction();
                $returnRequest->update(['status' => $this->request_status]);

                $orderProduct           = OrderProduct::where(['order_id' => $returnRequest->order->id, 'product_code' => $this->product_code, 'product_size' => $this->product_size])->first();
                $orderProduct->update(['product_status' => 'Exchange ' . $this->request_status]);
                DB::commit();
                toastr()->success('Exchange Request Status Has Been Updated Successfully');
            } else
                abort(404);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.admin.order.exchange.update-request-status');
    }
}