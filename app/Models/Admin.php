<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Admin extends Authenticatable implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'type',
        'mobile',
        'email',
        'password',
        'status',
        'about_me',
        'vendor_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function registerMediaCollections(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150);
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
            }
        );
    }


    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}