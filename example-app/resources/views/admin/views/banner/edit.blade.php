@php
    $count = 1;
@endphp
@extends('admin/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Edit Banner</h1>
        <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <form action="{{route('banner.update',$banner)}}" enctype="multipart/form-data" method="POST" onsubmit="return validate()">
                <div class="row">
                    <div class="col-lg-6">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Banner name:</label>
                            <input type="text" id="name" name="name" value="{{$banner->name}}" class="form-control"
                                placeholder="Banner name...">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Image:</label>
                            <input type="file" id="image" name="photo" class="form-control" onchange="previewImage(this)" >
                            @error('photo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" {{$banner->status==1?'checked':''}} name="status" class="custom-control-input form-control-lg"
                                id="status">
                            <label class="custom-control-label" for="status">Status</label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img style="height: 100%; width: 100%; border: 1px solid black;" src="{{asset('storage/images')}}/{{$banner->image}}"
                            alt="image of banner" id="imagePreview">
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
