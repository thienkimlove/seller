<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
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

        'medicine_id',
        'disease_id',
        'delivery_id',
        'price',
        'old_price',
        'product_currency',
        'available',
        'product_code',
        'hamluong',
        'congdung',
        'content1',
        'content2',
        'loai_san_pham',
        'quycach'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getTagListAttribute()
    {
        return $this->tags->pluck('title')->all();
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }


    public function getNewPriceAttribute()
    {

    }

    public function getOldPriceAttribute()
    {

    }
}
