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
        "performance or quality adequate",
        "product damaged but shipping box ok",
        "item arrived too late",
        "wrong item was send",
        "item defective or does not work",
        "required smaller size",
        "required larger size",
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