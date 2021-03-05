<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products= Product::all();
        return view('backend.product.index', compact('products'));
    }

    public function editStatus($id){
        $product= Product::find($id);
        if($product->status==1){
            $product->status=0;
            $product->save();
            return redirect()->back()->with('thongbao', 'status is inactive');
        }
        else{
            $product->status=1;
            $product->save();
            return redirect()->back()->with('thongbao', 'status is active');
        }
    }

    public function ajaxCategory(Request $request){
        $brands= Brand::where('category_id', $request->category_id)->get();

        return response()->json($brands, 200);
        // echo '2222';

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories= Category::all();
        $brands= Brand::all();

        return view('backend.product.add', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name'=> 'required|unique:products,name',
            'price'=> 'required|numeric',
            'price'=> 'numeric',
            'image'=> 'required|image',
            'status'=> 'required',
        ]);
        $data= $request->all();
        $data['image']= date('h-m-s-d-m-Y').'.'.$request->image->getClientOriginalExtension();
        $data['slug']= Str::slug($request->name, '-');
        // dd($data);
        Product::create($data);
        $request->image->move('public/uploads/product', $data['image']);

        return redirect()->route('product.index')->with('thongbao', 'thêm product thành công');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories= Category::all();
        $brands= Brand::all();
        $product= Product::find($id);
        
        return view('backend.product.edit', compact('categories', 'brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name'=> 'required|unique:products,name,'.$id,
            'price'=> 'required|numeric',
            'price'=> 'numeric',
            'image'=> 'image',
            'status'=> 'required',
        ]);

        $data= $request->all();
        $data['slug']= Str::slug($request->name, '-');

        $product= Product::find($id);
        // dd($data);
        if($request->hasFile('image')){
            $data['image']= date('H-i-s-d-m-Y').'.'.$request->image->getClientOriginalExtension();
            $request->image->move('public/uploads/product', $data['image']);

        
            if(file_exists('public/uploads/product/'.$product->image)){
                unlink('public/uploads/product/'.$product->image);
            }
        }
        else{
            unset($data['image']);
        }

        $product->update($data);

        return redirect()->route('product.index')->with('thongbao', 'sửa product thành công');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product= Product::find($id);
        $image= $product->image;
        if($product->delete()){
            if(file_exists('public/uploads/product/'.$image)){
                unlink('public/uploads/product/'.$image);
            }
            return response()->json(['result'=> 'xóa product thành công']);
        }
        else{
            return response()->json(['result'=> 'không thể xóa product']);
        }
    }
}
