@php
    $count = 1;
@endphp
@extends('admin/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Edit Category</h1>
        <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <form action="{{route('category.update',$category) }}" method="post"
            enctype="multipart/form-data" onsubmit="return validate()">
            <div class="row">
                <div class="col-lg-4">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Category name:</label>
                        <input type="text" onkeyup="ChangeToSlug()" onkeydown="ChangtoSlug()" value="{{old('name')?old('name'):$category->name}}" name="name"  id="name" class="form-control">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Slug Category</label>
                        <input type="text" id="slug" value="{{$category->slug}}" name='slug' class="form-control">
                        @error('slug')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Image: </label>
                        <input type="file" name="photo" id="image" class="form-control" onchange="previewImage(this)">
                        @error('photo')
                        <span class="mt-2 text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                </div>
                <div class="col-lg-3 img">
                    <img style="height: 100%; width: 100%; border: 1px solid black;" src="{{asset('storage/images')}}/{{$category->image}}"
                    alt="image of academic level" id="imagePreview">
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="mb-3">
                            <div class="custom-control custom-switch mb-3">
                                <input type="checkbox" {{$category->status==1?'checked':''}} name="status" class="custom-control-input form-control-lg"
                                    id="status">
                                <label class="custom-control-label" for="status">Status</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
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


        function ChangeToSlug() {
            var name, slug;
            //Lấy text từ thẻ input name 
            name = document.getElementById("name").value;

            //Đổi chữ hoa thành chữ thường
            slug = name.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        }
    </script>
@endsection
