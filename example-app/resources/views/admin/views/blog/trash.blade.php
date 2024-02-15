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
        <h1>Blogs</h1>
        <div class="d-flex justify-content-between">
            <div class="">
                <div>
                    <form action="{{ route('blog.index') }}" method="get">
                        <button class="btn btn-primary mb-3" type="submit">
                           Back
                        </button>
                    </form>
                </div>


            </div>
        </div>


        <div class="row">


            <div class="col-lg-12 p-3 mb-5 shadow-lg  bg-body rounded">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Blog name</th>
                            <th scope="col">Blog slug</th>
                            <th scope="col">Blog Image</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody >
                        @foreach ($blog as $item)
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td><img src="{{asset('storage/images')}}/{{$item->image}}"style="height: 300px; width: 300px; border: 1px solid black;"    alt=""></td>
                                <td>{{date("d/m/Y", strtotime($item->created_at))}}</td>



                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{route('blog.forcedelete',$item->id)}}"
                                            method="get">
                                            <button class="btn btn-danger btn-sm mr-1" type="submit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <form action="{{route('blog.restore',$item->id)}}" method="get">

                                            <button class="btn btn-warning btn-sm mr-1" type="submit">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>


                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                        @endforeach
                    </tbody>
                </table>
                {{ $blog->links() }}
            </div>
        </div>
    </div>
@endsection

