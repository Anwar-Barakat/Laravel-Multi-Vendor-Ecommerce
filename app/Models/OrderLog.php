<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'status',
        'reason',
        'updated_by',
    ];

    const CANCELLEDREASONS = [
        "Order Created By Mistake",
        "Item Not Arrive On Time",
        "Shipping Cost Too High",
        "Found Cheaper Somewhere Else",
        "Other",
    ];

    const RETURNREASONS = [
        "performance or quality adequate",
        "product damaged but shipping box ok",
        "item arrived too late",
        "wrong item was send",
        "item defective or does not work",
        "required smaller size",
        "required larger size",
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}