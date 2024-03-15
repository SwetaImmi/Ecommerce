@extends('admin.layouts.frontend')
@section('content')




<div class="container-fluid page-body-wrapper full-page-wrapper">

    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0" style="margin-top:-150px;">
            <div class="col-lg-6 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <form action="{{route('imageUpload')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="user-image mb-3 text-center">
                            <div class="imgPreview"> </div>
                        </div>
                        <div class="form-group">
                            <!-- <label>Product Name</label> -->
                            <div class="input-group">

                                <select name="product_gallery_id" id="product_gallery_id" class="form-control form-control-lg border-left-0">
                                <option>Select Product Name OR Id</option>
  
                                @foreach($prdt as $item)
                                    <option value="{{$item->id}}">{{$item->id}} OR {{$item->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="custom-file">

                            <input type="file" name="imageFile[]" class="custom-file-input" id="images" multiple="multiple">
                            <label class="custom-file-label" for="images">Choose image</label>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-inverse-primary btn-fw">ADD GALLERY IMAGE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<!-- page-body-wrapper ends -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img style=" height:50px; width:50px;">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        // $($.parseHTML('<img>')).setAttribute('style', 'height:20px;').appendTo(imgPreviewPlaceholder);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
    });
</script>
@endsection