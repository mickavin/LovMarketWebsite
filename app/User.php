<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phoneNumber','is_admin', 'shopId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeSearchName($query, $name){
        if(isset($name)){
        return $query->orWhere('name', 'LIKE', '%' . $name . '%');
        }
    }

    public function scopeSearchEmail($query, $email){
        if(isset($email)){
        return $query->orWhere('email', 'LIKE', '%' . $email . '%');
        }
    }

    public function scopeSearchId($query, $id){
        if(isset($id)){
        return $query->orWhere('id', $id);
        }
    }

    public function scopeSearchShop($query, $shop){
        if(isset($shop)){
        return $query->orWhereHas('shop', function($q) use($shop) {
            $q->where('name', 'like', '%'.$shop.'%');
        });
        }
    }

    public function shop() {
        return $this->belongsTo(Shop::class, 'shopId');
    }

    public function isAdmin(){
        return $this->is_admin === 1;
    }
}
