<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'category_id',
        'brand_id',
        'admin_id',
        'name',
        'url',
        'code',
        'color',
        'price',
        'discount',
        'weight',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_featured',
        'status',
    ];
}