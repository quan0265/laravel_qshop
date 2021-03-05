<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table= 'orders';

    protected $fillable= [
    	'customer_id',
    	'quanlity',
    	'total_money',
    	'full_name',
    	'email',
    	'phone',
    	'address',
    	'status',
    ];

    public function cart(){
        return $this->hasMany('App\Models\Cart', 'order_id', 'id');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }


}
