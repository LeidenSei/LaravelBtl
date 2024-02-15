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
    <h1>User View</h1>
    <div class="d-flex justify-content-between">
        <div class="p-3 mb-5 shadow-lg  bg-body rounded">
            <form action="{{route('user.index')}}" method="get"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-shadow border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2" name="keyword">
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
                        <th scope="col">User phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <th scope="row">{{ $count++ }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>

                            <td>
                                <div class="btn-group" role="group">
                                    <form action="{{route('user.edit',$item)}}"
                                        method="get">
                                        <button class="btn btn-warning btn-sm mr-1" type="submit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </form>
                                    <button type="button" style="height:23.6px;width:33.35px"
                                        class="btn btn-info btn-sm mr-1" data-toggle="modal"
                                        value="{{ $item->id }}" data-target="#modelId" onclick="show_info(this)">
                                        <i class="fas fa-info-circle"></i>
                                    </button>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Modal -->
            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                More Detail
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="" class="font-weight-bold text-primary">Employee</label>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">User Name:</label>
                                            <input type="text" disabled id="emp_name" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">User email:</label>
                                            <input type="text" disabled id="emp_slug" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">User mobile:</label>
                                            <input type="text" disabled id="emp_email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="">Image Product</label>
                                        <img style="height: 100%; width: 100%; border: 1px solid black;" src=""
                                            id="emp_image" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            {{ $data->links() }}
        </div>
    </div>
</div>
<script>
    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
        // Use above variables to manipulate the DOM

    });
</script>
<script>
    var items = @json($data);
    
    function show_info(element) {
        var emp_found = items.data.find(x => x.id == element.value);
        console.log(emp_found);
        $("#emp_image").attr("src","/storage/images/"+emp_found.avatar);
        document.getElementById("emp_name").value = emp_found.name;
        document.getElementById("emp_slug").value = emp_found.email;
        document.getElementById("emp_email").value = emp_found.mobile;
    }


    

</script>
@endsection