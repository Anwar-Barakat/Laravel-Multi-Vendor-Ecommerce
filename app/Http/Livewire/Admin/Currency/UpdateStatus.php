<?php

namespace App\Http\Livewire\Admin\Currency;

use App\Models\Currency;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status, $currency_id;

    public function updateStatus($currency_id)
    {
        $currency       =  Currency::findOrFail($currency_id);
        $currency->update(['status' => !$this->status]);
        $this->status   = $currency->status;
    }

    public function render()
    {
        return view('livewire.admin.currency.update-status');
    }
}