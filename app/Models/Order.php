<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'city',
        'state',
        'country_id',
        'email',
        'mobile',
        'shipping_charges',
        'coupon_code',
        'coupon_amount',
        'order_status',
        'paymeny_method',
        'paymeny_gateway',
        'grand_total',
    ];
}