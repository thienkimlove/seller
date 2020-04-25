<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'delivery_name',
        'delivery_email',
        'delivery_phone',
        'delivery_address',
        'account_id',
        'note',
        'coupon_code',
        'final_price',
        'status'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
