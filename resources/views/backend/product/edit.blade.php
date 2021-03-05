@extends('backend.layouts.master')

@section('title')
Product
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">product</h6>
    </div>
    <form role="form" action="{{route('product.update', $product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="text-danger">{{$error}}</div>
            @endforeach
        @endif
        <div class="form-group">
            <label>Category</label>
            <select id="cateProduct" name="category_id" class="form-control">
                @foreach($categories as $category)
                <option @if($category->id==$product->brand->category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Brand</label>
            <select id="brandProduct" data-id="{{$product->brand_id}}" name="brand_id" class="form-control">
                {{-- @foreach($brands as $brand)
                <option @if($brand->id==$product->brand_id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" value="{{ $product->name }}" placeholder="Enter text">
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" type="number" name="price" value="{{ $product->price }}" placeholder="Enter text">
        </div>
        <div class="form-group">
            <label>Price old</label>
            <input class="form-control" type="number" value="0" name="price_old" value="{{ $product->price_old }}" placeholder="may be empty">
        </div>
        <div class="form-group">
            <label>image</label>
            <input class="d-none" type="file" id="fileInput" name="image" onchange="changeImage(this)">
            <img width="150" id="fileImage" src="{{ asset('public/uploads/product') }}/{{$product->image}}" alt="your image" />
        </div>
        <div class="form-group">
            <label>description</label>
            <textarea id="editor" class="form-control" name="description" rows="3">{!! $product->description !!}</textarea>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option @if($product->status==1) selected="" @endif value="1">active</option>
                <option @if($product->status!=1) selected="" @endif value="0">inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Edit</button>
        <button type="reset" class="btn btn-primary">Reset</button>
    </form>
</div>
@endsection

@section('js')
<script type="text/javascript">

CKEDITOR.replace('editor');

function changeImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#fileImage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$(document).ready(function() {
    $('#fileImage').click(function(){
        $('#fileInput').click();
    });
    // console.log($('#brandProduct').data('id'));
    let category_id= $('#cateProduct').val();
    // console.log(category_id);
    $.ajax({
        url: "{{route('product.ajax')}}",
        data: {category_id:category_id},
        method: "post",
        dataType: "json",
        success: function(data){
            // console.log(data[0]);
            let html = '';
            $.each(data,function($key,$value){
                if($value['id']==$('#brandProduct').data('id')){
                    html+= '<option selected value='+$value['id']+'>'+$value['name']+'</option>'; 
                }
                else{
                    html+= '<option value='+$value['id']+'>'+$value['name']+'</option>'; 
                }
            });
            $('#brandProduct').html(html);
        }
    });

    $('#cateProduct').change(function(){
        let category_id= $('#cateProduct').val();
        // console.log(category_id);
        $.ajax({
            url: "{{route('product.ajax')}}",
            data: {category_id:category_id},
            method: "post",
            dataType: "json",
            success: function(data){
                // console.log(data[0]);
                let html = '';
                $.each(data,function($key,$value){
                    if($value['id']==$('#brandProduct').data('id')){
                        html+= '<option selected value='+$value['id']+'>'+$value['name']+'</option>'; 
                    }
                    else{
                        html+= '<option value='+$value['id']+'>'+$value['name']+'</option>'; 
                    }
                });
                $('#brandProduct').html(html);
            }
        });
    })


});




</script>

@endsection