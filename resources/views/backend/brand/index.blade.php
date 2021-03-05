@extends('backend.layouts.master')

@section('title')
Brand
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header1 card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Brand</h6>
        {{-- <button class="btn btn-primary buttonAdd" data-toggle="modal" data-target="#addModal">Add</button> --}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brand as $key => $brand)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $brand->category->name }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->slug }}</td>
                        @if($brand->status==1)
                        <td><a class="text-primary font-weight-bold" href="{{ route('brand.status', $brand->id) }}">active</a></td>
                        @else
                        <td><a class="text-danger font-weight-bold" href="{{ route('brand.status', $brand->id) }}">inactive</a></td>
                        @endif
                        <td>
                            <a href="{{ route('brand.edit', $brand->id )}}" class="btn btn-primary edit" ><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger delete btnDelete" data-id="{{ $brand->id }}" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
     <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <p>bạn có chắc muốn xóa?</p>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnDeleteYes">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script type="text/javascript">

$(document).ready(function(){

// alert(22);
// toastr.success('skksksk', {timeOut: 5000});
// toastr.success('skksksk', 'Thông báo', {timeOut: 5000});


    $('.btnDelete').click(function(){

        let id= $(this).data('id');
        // let url= "brand/"+id;
        // console.log(url);
        let url= "{{asset('admin/brand')}}/"+$(this).data('id');
        $('.btnDeleteYes').click(function(){
            // console.log(22);
            $.ajax({
                url: url,
                type: 'delete',
                dataType: 'json',
                success: function(result){
                    // console.log($result.result);
                    toastr.success(result.result, 'Thông báo', {timeOut: 5000});
                    location.reload();
                }

            });
        });

    });


});

</script>
@endsection