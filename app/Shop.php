<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'description',
        'phoneNumber',
        'address',
        'image',
        'latitude',
        'longitude',
        'type',
        'category_id',
        'drop',
        'activated',
    ];

    public function category() {
        return $this->belongsTo(Shop_category::class, 'category_id');
    }

    public function scopeSearchName($query, $name){
        if(isset($name)){
        return $query->where('name', 'LIKE', '%' . $name . '%');
        }
    }

    public function scopeSearchShopName($query, $name){
        if(isset($name)){
        return $query->orWhere('name', 'LIKE', '%' . $name . '%');
        }
    }

    // public function scopeSearchCategory($query, $category){
    //     if(isset($category)){
    //     return $query->where('category_id', $category);
    //     }
    // }

    public function scopeSearchId($query, $id){
        if(isset($id)){
        return $query->orWhere('id', $id);
        }
    }

    public function scopeSearchPhone($query, $phone){
        if(isset($phone)){
        return $query->orWhere('phoneNumber', 'LIKE', '%' . $phone . '%');
        }
    }

    public function scopeSearchCategory($query, $category){
        if(isset($category)){
        return $query->orWhereHas('category', function($q) use($category) {
            $q->where('category',$category);
        });
        }
    }

    public function scopeSearchType($query, $type){
        if(isset($type)){
        return $query->where('type', $type);
        }
    }

    public function scopeIsActivated($query, $activated){
        if(isset($activated)){
        return $query->where('activated', $activated);
        }
    }

    public function scopeIsDrop($query, $drop){
        if(isset($drop)){
        return $query->where('drop', $drop);
        }
    }

}
