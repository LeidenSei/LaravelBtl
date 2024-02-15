@php
    $count = 1;
@endphp
@extends('admin/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Add Product</h1>
        <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <form action="{{ route('product.update', $product) }}" enctype="multipart/form-data" method="POST"
                onsubmit="return validate()">
                @method('PUT')
                <div class="row">
                    @csrf
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product name:</label>
                                <input type="text" onkeyup="ChangeToSlug()" onkeydown="ChangtoSlug()" name="name"
                                    value="{{ old('name') ? old('name') : $product->name }}" id="name"
                                    class="form-control">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Product slug:</label>
                                <input type="text" name="slug" id="slug" value="{{ $product->slug }}"
                                    class="form-control">
                                @error('slug')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Image:</label>
                                <input type="file" name="photo" id="image" class="form-control"
                                    onchange="previewImage(this)">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-5 mb-5">
                                <label for=""></label>
                                <img style="height: 100%; width: 100%; border: 1px solid black;"
                                    src="{{ asset('storage/images') }}/{{ $product->image }}" alt="image of product"
                                    id="imagePreview">
                            </div>
                            <div class="col-lg-7">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product price:</label>
                                        <input type="text" name="price"
                                            value="{{ old('price') ? old('price') : $product->price }}" id="price"
                                            class="form-control">
                                        @error('price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Sale Price:</label>
                                        <input type="text" name="sale_price"
                                            value="{{ old('sale_price') ? old('sale_price') : $product->sale_price }} "
                                            id="sale_price" class="form-control">
                                        @error('sale_price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="custom-control custom-switch mb-3">
                                        <input type="checkbox" name="status" {{ $product->status == 1 ? 'checked' : '' }}
                                            class="custom-control-input form-control-lg" id="status">
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Stock:</label>
                                        <input type="checkbox"{{$product->stock == 1 ? 'checked' : ''}} name="stock">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label for="name" class="form-label">Description:</label>
                        <textarea name="description" id="editor1" rows="10" cols="80">
                            {{ old('description') ? old('description') : $product->description }}
                            </textarea>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image Description</label>
                            <div class="box pt-2">
                                <input type="file" name="photos[]" class="form-control" id="input" multiple
                                    onchange="preview(this)">
                            </div>
                            <div class="row" id="imgs">
                                @if ($product->images)
                                    @foreach ($product->images as $item)
                                        <div class="col-md-3" id="img-old">

                                            <div class="card ">
                                                <img class="card-img-bottom"
                                                    src="{{ asset('storage/images') }}/{{ $item->image }}" alt=""
                                                    width="100%">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            @error('photos')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <div class="row ">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">List Category</h6>
                                        <select class="form-control " name="category_id" id="category_id"
                                            onchange="updateEmpInfo()">
                                            <option value="">Select Category</option>
                                            @foreach ($data as $item)
                                                @if ($item->status == 1)
                                                    <option value="{{ $item->id }}"
                                                        {{ $product->category_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->id }}:
                                                        {{ $item->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                            <div class="col-lg-6">
                                <div class="ml-4" style="margin-top: 20px;">
                                    <img style="height: 200px; width: 90%;object-fit: cover;"
                                        src="{{ asset('storage/images') }}/{{ $product->category->image }}"
                                        alt="image of academic level">
                                </div>

                            </div>

                        </div>
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
        let name = $('#name');
        let slug = $('#slug');
        let price = $('#price');
        let sale_price = $('#sale_price');
        let category_id = $('#category_id');
        let image = $('#imagePreview');
        console.log('place_certificate', place_certificate);
        if (isInputEmpty(name)) {
            notification('warning', 'Name cant be empty');
            return false
        }
        if (isInputEmpty(slug)) {
            notification('warning', 'Slug cant be empty');
            return false
        }
        if (image.attr('src') === '') {
            notification('warning', 'Image cant be empty');
            image.focus();
            return false
        }
        if (isInputEmpty(price)) {
            notification('warning', 'Price period place cant be empty');
            return false
        }
        if (isInputEmpty(sale_price)) {
            notification('warning', 'Sale price cant be empty');
            return false
        }
        if (isInputEmpty(category_id)) {
            notification('warning', 'Category cant be empty');
            return false
        }
        return true;
    </script>

    <script>
        var data = @json($data);

        function updateEmpInfo() {
            var categoryId = $("#category_id").val();
            var category = data.find((element) => element.id == categoryId);

            $("#img_cate").attr("src", "/storage/images/" + category.image);
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


    function preview(elem, output = '') {
        const i = 0;
        Array.from(elem.files).map((file) => {
            const blobUrl = window.URL.createObjectURL(file)
            output +=
                `<div class="col-md-3" id="img-add">
                            
                            <div class="card "> 
                                <img class="card-img-bottom" src=${blobUrl} alt="" width="100%" >
                            </div>
                        </div>`
            })
            document.getElementById('imgs').innerHTML += output
        }
    </script>
@endsection
@section('CustomJs')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
    </script>
@endsection
