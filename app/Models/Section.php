<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
            }
        );
    }

    public function categories()
    {
        return $this->hasMany(Category::class)->with('subCategories')->where('parent_id', 0);
    }

    public function parentCategories()
    {
        return $this->hasMany(Category::class)->where(['categories.parent_id' => 0])->select('id', 'name');
    }
}