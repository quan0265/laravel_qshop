<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;

class OrderController extends Controller
{
    //

	public function index(){

		$orders= Order::all();

		return view('backend.order.index', compact('orders'));
	}

	public function editStatus($id){
		$order= Order::find($id);
		if($order->status<3){
			$order->status++;
			$order->save();
		}

		return redirect()->back();

	}

	public function destroy($id)
    {
        //
        $order= Order::find($id);
        if($order->delete()){
            return response()->json(['result'=> 'xóa order thành công']);
        }
        else{
            return response()->json(['result'=> 'không thể xóa order']);
        }
    }

    public function getOrderDetail($id){

    	$carts= Cart::where('order_id', $id)->get();

    	return view('backend.order.order_detail', compact('carts'));
    }


}
