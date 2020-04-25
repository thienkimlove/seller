<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = [
        'code',
        'coupon_id',
        'is_used',
        'discount',
        'is_discount_percent',
        'valid_from',
        'valid_to'
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
