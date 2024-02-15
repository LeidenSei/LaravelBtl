@php
    $count = 1;
@endphp
@extends('admin/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Edit Order</h1>
        <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <form action="{{route('order.update',$order->id)}}" method="post"
            enctype="multipart/form-data" onsubmit="return validate()">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">User name:</label>
                        <input type="text"  value="{{old('name')?old('name'):$order->cus->name}}" disabled  id="name" class="form-control">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Method Payment</label>
                        <input type="text"  value="{{$order->payType==1?'Cash':'Credit'}}" disabled class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Note: </label>
                        <textarea name="" id="" disabled cols="50" rows="10">
                            {{$order->order_note}}
                        </textarea>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="exampleSelectGender">Status</label>
                        <select class="form-control js-example-basic-single" id="exampleSelectGender" name="status">
                                <option value="0" {{$order->Status==0?'selected':''}}>The payment is pending confirmation</option>
                                <option value="1" {{$order->Status==1?'selected':''}}>The order will be shipped as soon as the goods are prepared.</option>
                                <option value="2" {{$order->Status==2?'selected':''}}>The goods are being delivered to your address</option>
                                <option value="3" {{$order->Status==3?'selected':''}}>Your order has been delivered successfully. </option>
                                <option value="4" {{$order->Status==4?'selected':''}}>The order has been canceled</option>
                        </select>
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
