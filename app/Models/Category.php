<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model  implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'section_id', 'parent_id',
        'name', 'discount', 'description', 'url',
        'meta_title', 'meta_description', 'meta_keywords',
        'status',
    ];

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
            }
        );
    }

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(1920)
            ->height(720);
    }

    public function scopeActive($query)
    {
        return $query->where(['status' => 1]);
    }

    public function scopeParent($query)
    {
        return $query->where(['parent_id' => 0, 'status' => 1]);
    }

    public static function categoryDetails($url)
    {
        $category   = Category::with([
            'subCategories' => fn ($q) => $q->select('id', 'parent_id', 'name', 'url', 'description')
        ])->where('url', $url)->active()->first();

        $catIds     = [];
        $catIds[]   = $category->id;
        foreach ($category->subCategories as $sub) :
            $catIds[]   = $sub->id;
        endforeach;

        if ($category->parent_id == 0) :
            $breadcrumb = "
                <li class='is-marked'>
                    <a href=" . route('front.shop.category.products', $category->url) . ">$category->name</a>
                </li>";
        else :
            $parent     = $category->parentCategory;
            $breadcrumb = "
                <li class='has-separator'>
                    <a href=" . route('front.shop.category.products', $parent->url) . ">$parent->name</a>
                </li>
                <li class='is-marked'>
                    <a href=" . route('front.shop.category.products', $category->url) . ">$category->name</a>
                </li>";
        endif;

        $categoryDetails = ['category' => $category, 'catIds' => $catIds, 'breadcrumb' => $breadcrumb];
        return $categoryDetails;
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id')->select('id', 'name', 'url');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->withCount('products')->where('status', 1);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}