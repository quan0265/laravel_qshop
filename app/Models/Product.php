<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table= 'products';

    protected $fillable= [
    	'brand_id',
    	'name',
    	'slug',
    	'price',
    	'price_old',
        'image',
    	'description',
    	'status'
    ];

    public function brand(){
    	return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }
}
