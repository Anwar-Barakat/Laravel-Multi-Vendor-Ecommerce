<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class VendorBusinessDetail extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'vendor_id', 'shop_name', 'shop_address', 'shop_city', 'shop_state', 'shop_country_id', 'shop_pincode', 'shop_mobile', 'shop_website', 'shop_email',
        'address_proof',
        'business_license_number',
        'gst_number',
        'pan_number',
    ];

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'shop_country_id');
    }
}