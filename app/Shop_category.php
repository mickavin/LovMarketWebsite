<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop_category extends Model
{
    protected $fillable = [
        'category'
    ];

    public function scopeSearchCategory($query, $category){
        if(isset($category)){
        return $query->where('category', 'LIKE', '%' . $category . '%');
        }
    }
}
