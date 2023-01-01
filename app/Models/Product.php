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

    protected $guarded = [];

    const  COLORS = [
        'red', 'green', 'yellow', 'olive', 'orange',
        'teal', 'blue', 'violet', 'purple', 'pink', 'white', 'gray', 'black'
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

    public function scopeActive($query)
    {
        return $query->where(['status' => 1]);
    }

    public static function applyDiscount($prod_id)
    {
        $prod               = Product::select('category_id', 'price', 'discount')->where('id', $prod_id)->first();
        $category           = Category::select('discount')->where('id', $prod->category_id)->first();

        if ($prod->discount > 0) :
            $final_price    = self::discountingPrice($prod->price, $prod->discount);
        elseif ($category->discount > 0) :
            $final_price    = self::discountingPrice($prod->price, $prod->category->discount);
        else :
            $final_price    = $prod->price;
        endif;

        return $final_price;
    }

    public static function discountingPrice($price, $discount)
    {
        return $price - ($price * $discount / 100);
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
        return $this->belongsTo(Admin::class, 'admin_id')->with('vendor');
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}