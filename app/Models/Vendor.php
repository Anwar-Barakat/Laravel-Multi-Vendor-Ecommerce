<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Vendor extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'country_id',
        'pincode',
        'mobile',
        'email',
        'status',
    ];

    const ADDRESSPROOF = [
        '1' => 'passport',
        '2' => 'voting_card',
        '3' => 'pan',
        '4' => 'driving_license',
        '5' => 'aader_card'
    ];

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300);
    }

    public function businessInfo()
    {
        return $this->hasOne(VendorBusinessDetail::class);
    }

    public function bankInfo()
    {
        return $this->hasOne(VendorBankDetail::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}