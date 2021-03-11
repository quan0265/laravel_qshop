<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories= Category::all();
        $brand= Brand::orderBy('category_id', 'asc')->get();
        // dd($brand);
        return view('backend.brand.index', compact('brand', 'categories'));
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
        return view('backend.brand.add', compact('categories'));
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
            'name'=> 'required|unique:categories,name',
            'status'=> 'numeric|required',
        ]);

        $data= $request->all();
        $data['slug']= Str::slug($request->name, '-');

        Brand::create($data);
        // dd($data);
        return redirect()->route('brand.index')->with('thongbao', 'thêm brand thành công');

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
        $brand= Brand::find($id);

        return view('backend.brand.edit', compact('brand', 'categories'));
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
            'name'=> 'required|unique:categories,name,'.$id,
            'status'=> 'numeric|required',
        ]);

        $data= $request->all();
        $data['slug']= Str::slug($request->name, '-');
        // dd($data);
        $brand= Brand::find($id);
        $brand->update($data);

        return redirect()->route('brand.index')->with('thongbao', 'sửa brand thành công');
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
        $brand= Brand::find($id);
        if($brand->delete()){
            return response()->json(['result'=> 'xóa brand thành công']);
        }
        else{
            return response()->json(['result'=> 'không thể xóa brand']);
        }
    }
}
