<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'filter_id',
        'filter_value',
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

    public function scopeActive($query)
    {
        return $query->where(['status' => 1]);
    }

    public function filter()
    {
        return $this->belongsTo(Filter::class, 'filter_id');
    }
}