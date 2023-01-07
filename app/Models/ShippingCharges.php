<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharges extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'zero_500g', '_501_1000g', '_1001_2000g', '_2001_5000g', 'above_5000g', 'status'];


    public function createdAt(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d');
            }
        );
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}