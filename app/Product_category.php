<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_category extends Model
{
    protected $fillable = [
        'category', 'shopId'
    ];

    public function scopeSearchCategory($query, $category){
        if(isset($category)){
        return $query->where('category', 'LIKE', '%' . $category . '%');
        }
    }

    public function scopeSearchShopId($query, $id){
        if(isset($id)){
        return $query->where('shopId', $id);
        }
    }
}
