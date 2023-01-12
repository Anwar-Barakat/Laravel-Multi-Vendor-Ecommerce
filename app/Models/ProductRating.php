<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'review',
        'rating',
        'status',
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d h:m:s A',
    ];

    public function scopeActive($query)
    {
        return $query->where(['status' => true]);
    }

    public function scopeRatingProduct($query, $id)
    {
        return $query->where('product_id', $id)->active();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}