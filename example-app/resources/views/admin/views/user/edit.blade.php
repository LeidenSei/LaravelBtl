@php
    $count = 1;
@endphp
@extends('admin/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>User Role</h1>
        <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <form action="{{route('user.update',$user) }}" method="post"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">User name:</label>
                        <input type="text"  disabled value="{{old('name')?old('name'):$user->name}}"  id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Email User:</label>
                        <input type="text" id="slug" disabled  value="{{$user->email}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Mobile User:</label>
                        <input type="text" id="slug" disabled  value="{{$user->phone}}"  class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Address:</label>
                        <input type="text" id="slug" disabled  class="form-control" value="{{$user->phone}}" >
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Cancel Roles:</label>
                        <input type="radio" name="role"   id="" value="0" {{$user->role==0?'checked':""}}>
                        <label for="name" class="form-label">Accept Roles:</label>
                        <input type="radio" name="role"   id="" value="1" {{$user->role==1?'checked':""}}>
                        
                    </div>

                </div>
                <div class="col-lg-6 img">
                    <img style="height: 100%; width: 100%; border: 1px solid black;" src="{{asset('storage/images')}}/{{$user->image}}"
                    alt="image of user">

                </div>
                <div class="col-lg-7 mt-5">
                    <div class="mb-3 float-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>

        </div>
    </div>


    <script>
        function validate() {
            let name = $('#name');
            let image = $('#imagePreview');
            if (isInputEmpty(name)) {
                notification('warning', 'Name cant be empty');
                return false;
            }
            if (image.attr('src') === '') {
                notification('warning', 'Image cant be empty');
                image.focus();
                return false;
            }
            return true;
        }


    </script>
@endsection
