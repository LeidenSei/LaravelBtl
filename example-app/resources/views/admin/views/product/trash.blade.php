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
        <h1>Product</h1>
        <div class="d-flex justify-content-between">
            <form action="{{route('product.index')}}" method="get">

              
                <button class="btn btn-primary mb-3" type="submit">
                  Back
                </button>
            </form>
        </div>


        <div class="row">


            <div class="col-lg-12 p-3 mb-5 shadow-lg  bg-body rounded">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Product price</th>
                            <th scope="col">Sale Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $item)
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price}}</td>
                                <td>{{ $item->sale_price }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td><span
                                        class="badge badge-{{ $item->status == 1 ? 'success' : 'danger' }}">{{ $item->status == 1 ? 'active' : 'hide' }}</span>
                                </td>

                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{route('product.restore',$item->id)}}"
                                            method="get">
                                            <button class="btn btn-warning btn-sm mr-1" type="submit">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{route('product.forcedelete',$item->id)}}"
                                            method="get">
                                            <button class="btn btn-danger btn-sm mr-1" type="submit">
                                                <i class="fas fa-trash"></i>
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
                                                <label for="name" class="form-label">Product Name:</label>
                                                <input type="text" disabled id="emp_name" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Product slug:</label>
                                                <input type="text" disabled id="emp_slug" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Price:</label>
                                                <input type="text" disabled id="emp_email" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Sale Price:</label>
                                                <input type="text" disabled id="emp_phone" class="form-control">
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{ $product->links() }}
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
        var items = @json($product);
        console.log(items);
        function show_info(element) {
            var emp_found = items.data.find(x => x.id == element.value);
            console.log(emp_found);
            $("#emp_image").attr("src","/storage/images/"+emp_found.image);
            document.getElementById("emp_name").value = emp_found.name;
            document.getElementById("emp_slug").value = emp_found.slug;
            document.getElementById("emp_email").value = emp_found.price;
            document.getElementById("emp_phone").value = emp_found.sale_price;
        }
    </script>
@endsection
