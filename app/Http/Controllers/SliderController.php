<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Str;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders= Slider::all();

        return view('backend.slider.index', compact('sliders'));

    }

    public function editStatus($id){
        $slider= Slider::find($id);
        if($slider->status==1){
            $slider->status=0;
            $slider->save();
            return redirect()->back()->with('thongbao', 'status is inactive');
        }
        else{
            $slider->status=1;
            $slider->save();
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
        return view('backend.slider.add');
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
            'name'=> 'required|unique:sliders,name',
            'image'=> 'required|image',
            'status'=> 'required',
        ]);

        $data= $request->all();
        $data['image']= date('h-m-s-d-m-Y').'.'.$request->image->getClientOriginalExtension();
        // dd($data);
        Slider::create($data);
        $request->image->move('public/uploads/slider', $data['image']);

        return redirect()->route('slider.index')->with('thongbao', 'thêm slider thành công');
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
        $slider= Slider::find($id);

        return view('backend.slider.edit', compact('slider'));
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
            'name'=> 'required|unique:sliders,name,'.$id,
            'image'=> 'image',
            'status'=> 'required',
        ]);

        $data= $request->all();

        $slider= Slider::find($id);
        // dd($data);
        if($request->hasFile('image')){
            $data['image']= date('H-i-s-d-m-Y').'.'.$request->image->getClientOriginalExtension();
            $request->image->move('public/uploads/slider', $data['image']);

        
            if(file_exists('public/uploads/slider/'.$slider->image)){
                unlink('public/uploads/slider/'.$slider->image);
            }
        }
        else{
            unset($data['image']);
        }

        $slider->update($data);

        return redirect()->route('slider.index')->with('thongbao', 'sửa slider thành công');
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
        $slider= Slider::find($id);
        $image= $slider->image;
        if($slider->delete()){
            if(file_exists('public/uploads/slider/'.$image)){
                unlink('public/uploads/slider/'.$image);
            }
            return response()->json(['result'=> 'xóa slider thành công']);
        }
        else{
            return response()->json(['result'=> 'không thể xóa slider']);
        }
    }
}
