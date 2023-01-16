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

    public static function getAverageRating($product_id)
    {
        $data['rating_count']           = ProductRating::where('product_id', $product_id)->count();
        if ($data['rating_count'] > 0) {
            $data['rating_sum']             = ProductRating::ratingProduct($product_id)->sum('rating');
            $data['average_rating']         = round($data['rating_sum'] / $data['rating_count'], 1);
            $data['average_rating_star']    = round($data['rating_sum'] / $data['rating_count'], 1);
        } else
            $data['average_rating']     = 0;

        return $data;
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