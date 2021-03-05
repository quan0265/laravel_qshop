@extends('backend.layouts.master')

@section('title')
Order
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header1 card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">order</h6>
        {{-- <button class="btn btn-primary buttonAdd" data-toggle="modal" data-target="#addModal">Add</button> --}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>full name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>address</th>
                        <th>total money</th>
                        <th>date</th>
                        <th>status</th>
                        <th class="text-center">action</th>
                        <th>view</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key => $order)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $order->full_name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->total_money }}</td>
                        <td>{{ date_format($order->created_at, 'd-m-Y') }}</td>
                        <td>
                            @if($order->status==1)đang xử lý @elseif($order->status==2) đang gửi hàng @else đã nhận hàng @endif
                        </td>
                        <td class="text-center">
                            @if($order->status==1)
                            <a href="{{ asset('admin/order/status/'.$order->id)}}" class="btn btn-primary">shipping</a>
                            @elseif($order->status==2)
                            <a href="{{ asset('admin/order/status/'.$order->id)}}" class="btn btn-success">confirm</a>
                            @else
                            <button class="btn btn-danger delete btnDelete" data-id="{{ $order->id }}" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i></button>
                            @endif
                        </td>
                        <td>
                            <a href="{{ asset('admin/order-detail/'.$order->id)}}">detail</a>
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
        // let url= "order/"+id;
        // console.log(url);
        let url= "{{asset('admin/order')}}/"+$(this).data('id');
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