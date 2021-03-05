<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table= 'categories';

    protected $fillable= ['name', 'slug', 'status'];

    public function brand(){
    	return $this->hasMany('App\Models\Brand', 'category_id', 'id');
    }

    public function brandOderby(){
    	return $this->hasMany('App\Models\Brand', 'category_id', 'id')->orderBy('name', 'asc');
    }

    public function product(){
    	return $this->hasManyThrough('App\Models\Product', 'App\Models\Brand', 'category_id', 'brand_id', 'id', 'id');
    }
}
