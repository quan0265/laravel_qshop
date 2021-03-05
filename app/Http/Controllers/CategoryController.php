<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category= Category::all();
        // dd($category);
        return view('backend.category.index', compact('category'));

    }

    public function editStatus($id){
        $category= Category::find($id);
        if($category->status==1){
            $category->status=0;
            $category->save();
            return redirect()->back()->with('thongbao', 'status is inactive');
        }
        else{
            $category->status=1;
            $category->save();
            return redirect()->back()->with('thongbao', 'status is active');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.category.add');
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

        Category::create($data);
        // dd($data);
        return redirect()->route('category.index')->with('thongbao', 'thêm category thành công');

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
        $category= Category::find($id);

        return view('backend.category.edit', compact('category'));
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
        $category= Category::find($id);
        $category->update($data);

        return redirect()->route('category.index')->with('thongbao', 'sửa category thành công');
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
        $category= Category::find($id);
        if($category->delete()){
            return response()->json(['result'=> 'xóa category thành công']);
        }
        else{
            return response()->json(['result'=> 'không thể xóa category']);
        }
    }
}
