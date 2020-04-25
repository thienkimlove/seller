<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'title',
        'seo_title',
        'slug',
        'desc',
        'keywords',

        'content',
        'image',
        'views',
        'status',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getTagListAttribute()
    {
        return $this->tags->pluck('title')->all();
    }

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getProductListAttribute()
    {
        return $this->products->pluck('id')->all();
    }
}
