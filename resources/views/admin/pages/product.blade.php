@extends('admin.layouts.frontend')
@section('content')
<!-- aklert -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
  <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
  <strong>{{ $message }}</strong>
</div>
@endif

<!-- alert -->




<div class="container-fluid page-body-wrapper full-page-wrapper">

  <div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
      <div class="col-lg-6 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
          <div class="brand-logo">
            <img src="{{asset('assets/images/logo.png')}}" alt="logo">
          </div>
          <div class="alert" id="message" style="display: none"></div>

          <h4>Add Your Products</h4>
          <!-- <h6 class="font-weight-light">Join us today! It takes only few steps</h6> -->

          <!-- <form class="pt-3"  action="product_add" method="post" > -->
          <!-- alert -->

          <div class="alert  print-error-msg " style="display:none " role="alert">
            <span style="color: red;">
              <strong>Error!</strong> Please Fill all feild with the valid information...
            </span>
          </div>
          <!-- alert -->
          <form action="product" method="post" id="forms" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Product Name</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-circle text-primary"></i>
                  </span>
                </div>
                <input type="text" class="form-control form-control-lg border-left-0" placeholder="Product Name" name="product_name" id="product_name">
              </div>
              <span>
                @error('product_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </span>
            </div>
            <div class="form-group">
              <label>Product Quantity</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-circle text-primary"></i>
                  </span>
                </div>
                <input type="number" class="form-control form-control-lg border-left-0" placeholder="Product Quantity" name="product_quantity" id="product_quantity">
              </div>
              <span>
                @error('product_quantity')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </span>
            </div>
            <div class="form-group">
              <label>Product Category</label>
              <select class="form-control form-control-lg" id="category" name="category" placeholder="Category">
                @foreach($category as $item)
                <option value="{{$item->id}}">{{$item->category}}</option>
                @endforeach
              </select>
              <span>
                @error('category')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </span>
            </div>
            <div class="form-group">
              <label>Price</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-circle text-primary"></i>
                  </span>
                </div>
                <input type="number" class="form-control form-control-lg border-left-0" id="product_price" name="product_price" placeholder="Product price">
              </div>
              <span>
                @error('product_price')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </span>
            </div>
            <div class="form-group">
              <label>Product Description</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-circle text-primary"></i>
                  </span>
                </div>
                <textarea name="product_description" id="product_description" cols="10" rows="1" class="form-control form-control-lg border-left-0" placeholder="Product Description"></textarea>
                <!-- <textarea type="text" class="form-control form-control-lg border-left-0" placeholder="Product Description" name="product_quantity" id="product_quantity" > -->
              </div>
              <span>
                @error('product_description')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </span>
            </div>
            <div class="form-group">
              <label>Product Image</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-circle text-primary"></i>
                  </span>
                </div>
                <input type="file" id="image" name="image" class="form-control form-control-lg border-left-0">
                <!-- <input type="file" class="form-control form-control-lg border-left-0" placeholder="Product Image" name="image" id="image" > -->
              </div>
              <span>
                @error('image')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </span>
            </div>
            <!-- <div class="mb-4">
              <div class="form-check">
                <label class="form-check-label text-muted">
                  <input type="checkbox" class="form-check-input">
                  I agree to all Terms & Conditions
                </label>
              </div>
            </div> -->
            <div class="mt-3">
              <button type="submit" class="btn btn-inverse-primary btn-fw">ADD PRODUCT</button>
            </div>
            <div class="text-center mt-4 font-weight-light">
              <!-- Already have an account? <a href="login.html" class="text-primary">Login</a> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
</div>
<!-- page-body-wrapper ends -->







<!-- ajax $ not defined -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- ajax $ not defined -->


<!-- <script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#forms').on('submit', function(e) {
    // alert();
    e.preventDefault();
    $.ajax({
      url: 'product',
      method: "post",
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: function(data) {
        $('#message').css('display', 'block');
        $('#message').html(data.message);
        $('#message').addClass(data.class_name);

        $('#uploaded_image').html(data.uploaded_image);
        // location.reload();

      }

    });

  });
</script>
</body>

</html> -->



@endsection