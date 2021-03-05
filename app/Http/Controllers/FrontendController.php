<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Customer;
use View;
use DB;
use Auth;
use Hash;

class FrontendController extends Controller
{
    //
	public function __construct(){
		$categories= Category::all();

		View::share('categories', $categories);
	}

    public function index(){

    	return view('frontend.pages.home');
    }

    public function getDetail($id, $slug){

    	$product= Product::find($id);
    	
    	return view('frontend.pages.detail', compact('product'));
    }

    public function getProductCategory($slug){
    	$category= Category::where('slug', $slug)->first();
    	$category_id= $category->id;

    	$products= DB::table('brands')->join('products', 'brands.id', '=', 'products.brand_id')->where('brands.category_id', $category_id)->paginate(6);

    	return view('frontend.pages.product_category', compact('products', 'category'));
    }

    public function getProductBrand($id, $slug){

    	$brand= Brand::find($id);

    	$products= Product::where('brand_id', $brand->id)->paginate(6);

    	return view('frontend.pages.product_brand', compact('products', 'brand'));
    }

    

    

    

}
