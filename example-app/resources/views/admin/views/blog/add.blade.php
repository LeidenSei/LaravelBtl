@php
    $count = 1;
@endphp
@extends('admin/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Add Blogs</h1>
        <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <form action="{{route('blog.store')}}" enctype="multipart/form-data" method="post" onsubmit="return validate()">
                <div class="row">
                    <div class="col-lg-6">
                        @csrf
                        {{-- <input type="hidden" id="hidden" name="id" value="{{$hiddenId}}"> --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Product name:</label>
                            <input type="text" onkeyup="ChangeToSlug()" onkeydown="ChangtoSlug()"
                                value="{{ old('name') }}" name="name" id="name" class="form-control">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Product slug:</label>
                            <input type="text" name="slug" id="slug" class="form-control">
                            @error('slug')
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

                    </div>
                    <div class="col-lg-6">
                        <img style="height: 100%; width: 50%; border: 1px solid black;" src=""
                            alt="image of academic level" id="imagePreview">
                    </div>
                    
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleTextarea1">Description</label>
                              <textarea name="description" id="editor1"  rows="10" cols="80">
                              </textarea>
                              @error('description')
                              <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleTextarea1">Content</label>
                                <textarea name="content" id="editor2"  rows="10" cols="80"></textarea>
                                @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
            let slug = $('#slug');
            let editor1 = $('#editor1');
            let editor2 = $('#editor2');
            if (isInputEmpty(name)) {
                notification('warning', 'Name cant be empty');
                return false;
            }
            if (isInputEmpty(slug)) {
                notification('warning', 'slug cant be empty');
                return false;
            }
            if (isInputEmpty(editor1)) {
                notification('warning', 'Description cant be empty');
                return false;
            }
            if (isInputEmpty(editor2)) {
                notification('warning', 'Content cant be empty');
                return false;
            }
            if (image.attr('src') === '') {
                notification('warning', 'Image cant be empty');
                image.focus();
                return false;
            }
            return true;
        }

        CKEDITOR.replace('editor2');
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

    @section('CustomJs')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
    </script>
@endsection


@endsection
