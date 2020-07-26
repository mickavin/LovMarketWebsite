<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price','new_price' ,'units', 'category_id','shopId','activated'
    ];

    public function category() {
        return $this->belongsTo(Product_category::class, 'category_id');
    }

    public function shop() {
        return $this->belongsTo(Shop::class, 'shopId');
    }

    public function scopeSearchName($query, $name){
        if(isset($name)){
        return $query->where('name', 'LIKE', '%' . $name . '%');
        }
    }

    public function scopeSearchShopId($query, $id){
        if(isset($id)){
        return $query->where('shopId', $id);
        }
    }

    public function scopeIsActivated($query, $activated){
        if(isset($activated)){
        return $query->where('activated', $activated);
        }
    }
}
