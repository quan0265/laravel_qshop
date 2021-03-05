@extends('backend.layouts.master')

@section('title')
Slider
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">slider</h6>
    </div>
    <form role="form" action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" placeholder="Enter text">
            @if($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name')}}</div>
            @endif
        </div>
        <div class="form-group">
            <label>image</label>
            <input class="d-none" type="file" id="fileInput" name="image" onchange="changeImage(this)">
            <img width="150" id="fileImage" src="{{asset('public/backend/img/upload-image.png')}}" alt="your image" />
            @if($errors->has('image'))
                <div class="text-danger">{{ $errors->first('image')}}</div>
            @endif
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1">active</option>
                <option value="0">inactive</option>
            </select>
            @if($errors->has('status'))
                <div class="text-danger">{{ $errors->first('status')}}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Add</button>
        <button type="reset" class="btn btn-primary">Reset</button>
    </form>
</div>
@endsection

@section('js')
<script type="text/javascript">
    
function changeImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#fileImage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$(document).ready(function(){
    $('#fileImage').click(function(){
        $('#fileInput').click();
    });
});



</script>
@endsection