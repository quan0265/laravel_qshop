@extends('backend.layouts.master')

@section('title')
Brand
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">brand</h6>
    </div>
    <form role="form" action="{{route('brand.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" placeholder="Enter text">
            @if($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name')}}</div>
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

@endsection