
<style>
    table {
        width: 100%;
    }

    .table th,
    .table td {
        text-align: center;
        margin: 0 auto;
    }
</style>
@php
    $count = 1;
@endphp
@extends('admin/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Order detail</h1>
        <div class="d-flex justify-content-between">
            <div class="p-3 mb-5 shadow-lg  bg-body rounded">
                <form action="{{route('order.find')}}" method="get"
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-shadow border-0 small" placeholder="Date from"
                            aria-label="Search" aria-describedby="basic-addon2" name="from">
                        <input type="text" class="form-control bg-shadow border-0 small" placeholder="To..."
                            aria-label="Search" aria-describedby="basic-addon2" name="to">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">


            <div class="col-lg-12 p-3 mb-5 shadow-lg  bg-body rounded">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Order Id</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Product image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->order_id}}</td>
                            <td>{{$item->product->name}}</td>
                            <td><img src="{{asset('storage')}}/images/{{$item->product->image}}" style="width:100px !important;height:120px !important"></td>
                            <td>{{number_format(($item->product->sale_price>0)
                            ?$item->product->sale_price:$item->product->price,2)}}$</td>   
                            <td>{{$item->quantity}}</td>         
                            <td>{{number_format($item->total_price,2)}}$</td>
                            <td>{{date("d/m/Y", strtotime($item->created_at))}}</td>
                                                   
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $detail->links() }}
            </div>
        </div>
    </div>

@endsection


