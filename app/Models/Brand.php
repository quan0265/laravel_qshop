<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table= 'brands';

    protected $fillable= ['category_id', 'name', 'slug', 'status'];

    public function product(){
    	return $this->hasMany('App\Models\Product', 'brand_id', 'id');
    }

    public function category(){
    	return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}
