
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
        <h1>Order</h1>
        <div class="d-flex justify-content-between">
            <div class="p-3 mb-5 shadow-lg  bg-body rounded">
                <form action="{{route('order.find')}}" method="get"
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="date" class="form-control bg-shadow border-0 small" placeholder="Date from"
                            aria-label="Search" aria-describedby="basic-addon2" name="from">
                        <input type="date" class="form-control bg-shadow border-0 small" placeholder="To..."
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
                            <th scope="col">User name</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Status</th>
                            <th scope="col">Method Payment</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $item)
                        <tr>
                            <th scope="row">{{ $count++ }}</th>
                            <td>{{ $item->cus->name }}</td>
                            <td>{{date("d/m/Y", strtotime($item->created_at))}}</td>
                            <td>
                                @if ($item->status==0)
                                <label class="badge">The payment is pending confirmation</label>
                                
                                @elseif($item->status==1)
                                <label class="badge">The order will be shipped as soon as the goods are prepared.</label>
                                @elseif($item->status==2)
                                <label class="badge">The goods are being delivered to your address</label>
                                @elseif($item->status==3)
                                <label class="badge">Your order has been delivered successfully.</label>
                                @elseif($item->status==4)
                                <label class="badge">The order has been canceled</label>
                                @endif
                                
                            </td>
                            <td>
                                <label class="badge badge-success">{{($item->payType==1)?"Cash":"Credit"}}</label>
                            </td>    
                           

                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{route('order.edit',$item->id)}}"
                                            method="get">
                                            <button class="btn btn-warning btn-sm mr-1" type="submit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </form>
                                        <form action="{{route('order.detail',$item->id)}}"
                                            method="get">
                                            <button class="btn btn-info btn-sm mr-1" type="submit">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </form>


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $order->links() }}
            </div>
        </div>
    </div>

@endsection


