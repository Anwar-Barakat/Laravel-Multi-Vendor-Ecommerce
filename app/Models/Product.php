<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'section_id', 'category_id', 'brand_id', 'admin_id',
        'name', 'code', 'color', 'price', 'discount', 'weight',
        'description', 'meta_title', 'meta_description', 'meta_keywords',
        'is_featured', 'is_best_seller', 'status',
    ];

    const  COLORS = [
        'red', 'green', 'yellow', 'olive', 'orange', 'teal', 'blue', 'violet', 'purple', 'pink', 'white', 'gray', 'black'
    ];

    public function createdAt(): CastsAttribute
    {
        return new CastsAttribute(
            get: function ($value) {
                return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
            }
        );
    }

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaConversion('small')
            ->width(250)
            ->height(250);

        $this->addMediaConversion('midium')
            ->width(500)
            ->height(500);

        $this->addMediaConversion('large')
            ->width(1000)
            ->height(1000);
    }

    public static function applyDiscount($product_id)
    {
        $product    = Product::select('category_id', 'price', 'discount')->where('id', $product_id)->first();
        $category   = Category::select('discount')->where('id', $product->category_id)->first();

        if ($product->discount > 0) :
            $final_price = $product->price - ($product->price * $product->discount / 100);
        elseif ($category->discount > 0) :
            $final_price = $product->price - ($product->price * $category->discount / 100);
        else :
            $final_price = 0;
        endif;

        return $final_price;
    }


    public function scopeMaxPrice(Builder $query, $max_price): Builder
    {
        return $query->where("price", "<=", $max_price);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(fn ($query)  => $query->where('name', 'LIKE', $term))->orWhere('color', 'LIKE', $term);
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}