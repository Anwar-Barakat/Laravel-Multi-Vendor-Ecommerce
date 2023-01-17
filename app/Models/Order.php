<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'address', 'city', 'state', 'country_id', 'email', 'mobile',
        'shipping_charges', 'coupon_code', 'coupon_amount',
        'order_status', 'paymeny_method', 'paymeny_gateway', 'final_price', 'courier_name', 'tracking_number',
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];

    const STATUSES = [
        'New', 'Pending', 'Hold', 'In-Process', 'Paid', 'Shipped', 'Delivered', 'Cancelled'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}