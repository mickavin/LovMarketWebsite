<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id', 'shop_id', 'is_prepared', 'is_delivered'
    ];
}
