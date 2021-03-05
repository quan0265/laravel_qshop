@extends('backend.layouts.master')

@section('title')
Product
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">product</h6>
    </div>
    <form role="form" action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="text-danger">{{$error}}</div>
            @endforeach
        @endif
        <div class="form-group">
            <label>Category</label>
            <select id="cateProduct" name="brand_id" class="form-control">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Brand</label>
            <select id="brandProduct" name="brand_id" class="form-control">
                {{-- @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach --}}
            </select>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" placeholder="Enter text">
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" type="number" name="price" placeholder="Enter text">
        </div>
        <div class="form-group">
            <label>Price old</label>
            <input class="form-control" type="number" value="0" name="price_old" placeholder="may be empty">
        </div>
        <div class="form-group">
            <label>image</label>
            <input class="d-none" type="file" id="fileInput" name="image" onchange="changeImage(this)">
            <img width="150" id="fileImage" src="{{asset('public/backend/img/upload-image.png')}}" alt="your image" />
        </div>
        <div class="form-group">
            <label>description</label>
            <textarea id="editor" class="form-control" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1">active</option>
                <option value="0">inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add</button>
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
                html += '<option value='+$value['id']+'>';
                    html += $value['name'];
                html += '</option>';    
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
                    html += '<option value='+$value['id']+'>';
                        html += $value['name'];
                    html += '</option>';    
                });
                $('#brandProduct').html(html);
            }
        });



    })
});



</script>

@endsection