<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //
    public function getLogin(){

    	return view('backend.login');
    }

    public function postLogin(Request $request){
    	$this->validate($request, [
    		'email'=> 'required',
    		'password'=> 'required',
    	]);

    	// dd($request->all());
    	if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password])){
    		return redirect()->route('category.index')->with('thongbao', 'login thành công');
    	}
    	else{
    		return redirect()->back()->with('error', 'sai email hoặc password');
    	}
    }

    public function logout(){
    	Auth::logout();

    	return redirect()->route('get.admin.login')->with('thongbao', 'đăng xuất thành công');
    }

}
