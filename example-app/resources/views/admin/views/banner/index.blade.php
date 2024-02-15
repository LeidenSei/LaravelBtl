<style>
    table,
    table td {
      border: 1px solid #cccccc;
    }
    td {
      height: 80px;
      width: 160px;
      text-align: center;
      vertical-align: middle;
    }
  </style>
@php
    $count = 1;
@endphp
@extends('admin/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Banner</h1>
        <div class="d-flex justify-content-between">
            <div class="">
                <div>
                    <form action="{{ route('banner.create') }}" method="get">
                        <button class="btn btn-primary mb-3" type="submit">
                            Add Banner
                        </button>
                    </form>
                </div>
                <div>
                    <form action="{{route('banner.trash')}}" method="get">
                        <button class="btn btn-danger mb-3" type="submit">
                            Trash
                        </button>
                    </form>
                </div>

            </div>
            <div class="p-3 mb-5 shadow-lg  bg-body rounded">
                <form action="{{route('banner.find')}}" method="GET"
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-shadow border-0 small"
                            placeholder="Search for name or id" aria-label="Search"
                            aria-describedby="basic-addon2"  name="keyword" value="{{Request::get('keyword')}}">
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
                            <th scope="col">Banner name</th>
                            <th scope="col">Banner Image</th>
                            <th scope="col">Create at</th>
                            <th scope="col">Banner Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($banner as $item)
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td>{{ $item->name }}</td>
                                <td><img src="{{asset('storage/images')}}/{{$item->image}}" width="400px"    alt=""></td>
                                <td>{{date("d/m/Y", strtotime($item->created_at))}}</td>
                                <td>
                                    <span
                                        class="badge badge-{{ $item->status == 1 ? 'success' : 'danger' }}">{{ $item->status == 1 ? 'active' : 'hide' }}</span>
                                </td>


                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{route('banner.edit',$item)}}" method="get">

                                            <button class="btn btn-warning btn-sm mr-1" type="submit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </form>
                                        <form action="{{route('banner.destroy',$item)}}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm mr-1" type="submit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>


                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                        @endforeach
                    </tbody>
                </table>
                {{ $banner->links() }}
            </div>
        </div>
    </div>
@endsection

