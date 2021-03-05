@extends('backend.layouts.master')

@section('title')
Order detail
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header1 card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Order detail</h6>
        {{-- <button class="btn btn-primary buttonAdd" data-toggle="modal" data-target="#addModal">Add</button> --}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quanlity</th>
                        <th>Money</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $key => $cart)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td><img width="60" src="{{ asset('public/uploads/product/'.$cart->product->image) }}" alt=""></td>
                        <td>{{ $cart->product->name }}</td>
                        <td>{{ number_format($cart->product->price) }}</td>
                        <td>{{ $cart->quanlity }}</td>
                        <td>{{ number_format($cart->money) }}</td>
                        <td>{{ date_format($cart->created_at, 'H:i:s d-m-Y') }}</td>
                    </tr>
                    @endforeach
                    <td>{{count($carts)+1}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>total money: {{ number_format($carts[0]->order->total_money) }}</td>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection