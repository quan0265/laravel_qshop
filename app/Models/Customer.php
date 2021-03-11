<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard= 'customer';
    protected $table= 'customers';


    protected $fillable = [
        'user_name',
        'full_name',
        'email',
        'password',
        'phone',
        'address',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function order(){
        return $this->hasMany('App\Models\Order', 'customer_id', 'id');
    }

    public function cart(){
        return $this->hasMany('App\Models\Cart', 'customer_id', 'id');
    }

    public function cartCount(){
        return $this->hasMany('App\Models\Cart', 'customer_id', 'id')->where('order_id', null)->sum('quanlity');
    }


}
