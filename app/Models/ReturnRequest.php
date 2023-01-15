<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'product_code',
        'product_size',
        'reason',
        'status',
        'comment',
    ];

    const RETURNREASONS = [
        "Performance Or Quality Adequate",
        "Product Damaged But Shipping Box Ok",
        "Item Arrived Too Late",
        "Wrong Item Was Send",
        "Item Defective Or Does Not Work",
        "Required Smaller Size",
        "Required Larger Size",
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}