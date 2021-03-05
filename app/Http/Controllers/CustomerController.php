<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\Order;
use View;
use DB;
use Auth;
use Hash;

class CustomerController extends Controller
{
    //
    public function __construct(){
		$categories= Category::all();

		View::share('categories', $categories);
	}

    public function index(){

        $customers= Customer::all();

        return view('backend.customer.index', compact('customers'));
    }

    public function destroy($id){
        $customer= Customer::find($id);
        if($customer->delete()){
            return response()->json(['result'=> 'xóa customer thành công']);
        }
        else{
            return response()->json(['result'=> 'không thể xóa customer']);
        }
    }

	public function getLogin(){

    	return view('frontend.pages.login');
    }

    public function postLogin(Request $request){
        $this->validate($request, [
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        $remember=$request->remember=='on' ?? true|false;
        
        if(Auth::guard('customer')->attempt(['email'=> $request->email, 'password'=> $request->password], $remember)){
            return redirect('')->with('thongbao', 'login thành công');
        }
        else{
            return redirect('login')->with('error', 'sai email hoặc password');
        }
    }

    public function getRegister(){

    	return view('frontend.pages.register');
    }


    public function postRegister(Request $request){

        $this->validate($request, [
            'full_name'=> 'required',
            'user_name'=> 'required',
            'email'=> 'required|email|unique:customers,email',
            'password'=> 'required',
            'phone'=> 'required',
            'address'=> 'required',
        ]);

        // dd($request->all());
        $data= $request->all();
        $data['password']= Hash::make($request->password);
        Customer::create($data);

        return redirect('login')->with('thongbao', 'đăng kí thành công');

    }

    public function getLogout(){
        Auth::guard('customer')->logout();

        return redirect('')->with('thongbao', 'logout thành công');
    }


    public function getSetting(){
    	$customer= Auth::guard('customer')->user();

    	return view('frontend.pages.setting', compact('customer'));
    }

    public function postSetting(Request $request){

    	$customer_id= Auth::guard('customer')->user()->id;

    	$this->validate($request, [
    		'full_name'=> 'required',
            'user_name'=> 'required',
            'email'=> 'required|email|unique:customers,email,'.$customer_id,
            'phone'=> 'required',
            'address'=> 'required',
    	]);

    	$data= $request->all();

    	Customer::find($customer_id)->update($data);

    	return redirect('')->with('thongbao', 'update thành công');

    }


    public function getChangePassword(){

    	return view('frontend.pages.change_password');
    }

    public function postChangePassword(Request $request){

    	$this->validate($request, [
    		'old_password'=> 'required',
    		'new_password'=> 'required',
    		'confirm_password'=> 'required|same:new_password',
    	]);

    	$data['password']= Hash::make($request->new_password);

    	if($data['password'] != Auth::guard('customer')->user()->password){
    		return redirect()->back()->with('error', 'password không đúng');
    	}

    	Customer::find(Auth::guard('customer')->user()->id)->update($data);

    	return redirect('')->with('thongbao', 'update password thành công');
    }

    public function getOrder(){

        $customer= Auth::guard('customer')->user();

        $orders= Order::where('customer_id', $customer->id)->orderBy('id', 'desc')->get();

        return view('frontend.pages.order', compact('orders'));
    }

    public function getOrderDetail($order_id){
        $customer= Auth::guard('customer')->user();

        $carts= Cart::where('customer_id', $customer->id)->where('order_id', $order_id)->get();
        $total_money= Cart::where('order_id', $order_id)->where('customer_id', $customer->id)->sum('money');

        return view('frontend.pages.order_detail', compact('carts', 'total_money'));
    }


}
