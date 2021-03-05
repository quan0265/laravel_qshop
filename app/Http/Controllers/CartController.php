<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use View;
use Auth;
use Mail;
use App\Mail\CartMail;
class CartController extends Controller
{
    //

	public function __construct(){
		$categories= Category::all();

		View::share('categories', $categories);
	}

    public function index(){

    	$customer= Auth::guard('customer')->user();
    	if(count($customer->cart)==0){
    		return redirect('')->with('error', 'bạn chưa có sản phẩm nào trong giỏ hàng');
    	}
    	
		$carts= Cart::where('customer_id', $customer->id)->where('order_id', null)->get();

		$total_money= Auth::guard('customer')->user()->cart->where('order_id', null)->sum('money');

		return view('frontend.pages.cart', compact('carts', 'total_money'));
	}

	public function addCart($id){

		$customer= Auth::guard('customer')->user();
		$product= Product::find($id);

		$cart= Cart::where('product_id', $id)->where('customer_id', $customer->id)->where('order_id', null)->first();

		if(!empty($cart)){

			$data['quanlity']= $cart->quanlity+1;
			$data['money']= $data['quanlity']*$product->price;

			$cart->update($data);
		}
		else{
			$data['product_id']= $id;
			$data['customer_id']= $customer->id;
			$data['quanlity']= 1;
			$data['money']= $data['quanlity']*$product->price;

			Cart::create($data);
		}

		return redirect('cart/index');

	}

	public function updateCart(Request $request){

		$cart= Cart::find($request->id);
		$data['money']=$cart->product->price*$request->quanlity;
		$data['quanlity']= $request->quanlity;

		$cart->update($data);

	}

	public function deleteCart($id){

		if($id=='all'){
			$customer= Auth::guard('customer')->user();
			Cart::where('customer_id', $customer->id)->where('order_id', null)->delete();
		}
		else{
			Cart::find($id)->delete();
		}
		return redirect('')->with('thongbao', 'xòa hết tất cả sản phẩm trong giỏ hàng thành công');
	}


	public function getConfirm(){
		$customer= Auth::guard('customer')->user();

		$carts= Cart::where('customer_id', $customer->id)->where('order_id', null)->get();

		$total_money= Auth::guard('customer')->user()->cart->where('order_id', null)->sum('money');

		return view('frontend.pages.cart_confirm', compact('carts', 'total_money', 'customer'));

	}

	public function complete(){

		$customer= Auth::guard('customer')->user();
		$total_money= Auth::guard('customer')->user()->cart->where('order_id', null)->sum('money');
		$carts= Cart::where('customer_id', $customer->id)->where('order_id', null)->get();

		$data['customer_id']= $customer->id;		
		$data['quanlity']= Auth::guard('customer')->user()->cart->sum('quanlity')		;
		$data['total_money']= $total_money;		
		$data['full_name']= $customer->full_name;		
		$data['email']= $customer->email;		
		$data['phone']= $customer->phone;		
		$data['address']= $customer->address;
		$data['status']= 1;

		Order::create($data);
		$order_id= Order::orderBy('id', 'desc')->first()->id;
		
		foreach($carts as $cart){
			Cart::find($cart->id)->update(['order_id'=> $order_id]);
		}

		unset($data);
		$data['customer']= $customer;
		$data['total_money']= $total_money;
		$data['carts']= $carts;

		Mail::to($customer->email)->send(new CartMail($data));

		return redirect('')->with('thongbao', 'mua hàng thành công');
	}




}
