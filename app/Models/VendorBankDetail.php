<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorBankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'account_holder_name',
        'bank_name',
        'account_number',
        'bank_ifsc_code',
    ];


    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}