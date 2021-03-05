<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table= 'carts';
    protected $fillable= [
    	'product_id',
    	'customer_id',
    	'order_id',
    	'quanlity',
    	'money',
    ];

    public function order(){
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }


}
