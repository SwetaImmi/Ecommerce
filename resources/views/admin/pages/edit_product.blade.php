@extends('admin.layouts.frontend')
@section('content')

<div class="container-scroller">
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
            <form  id="forms" action="{{ url('product_update').'/'. $product->id  }}"  method="post"enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Product Name</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="ti-circle text-primary"></i>
                    </span>
                  </div>
                  <input value="{{$product->product_name}}" type="text" class="form-control form-control-lg border-left-0" placeholder="Product Name" name="product_name" id="product_name">
                </div>
              </div>
              <div class="form-group">
                <label>Product Quantity</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="ti-circle text-primary"></i>
                    </span>
                  </div>
                  <input value="{{$product->product_quantity}}" type="number" class="form-control form-control-lg border-left-0" placeholder="Product Quantity" name="product_quantity" id="product_quantity">
                </div>
              </div>
              <div class="form-group">
                <label>Product Category</label>
                <select class="form-control form-control-lg" id="category" name="category" placeholder="Category">
                  <option>{{$product->category}}</option>
                  <option value="men">Men's</option>
                  <option value="women">Women's</option>
                  <option value="kid girl">Kid's Girl</option>
                  <option value="kid boy">Kid's Boy</option>
                </select>
              </div>
              <div class="form-group">
                <label>Price</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="ti-circle text-primary"></i>
                    </span>
                  </div>
                  <input value="{{$product->product_price}}" type="number" class="form-control form-control-lg border-left-0" id="product_price" name="product_price" placeholder="Product price">
                </div>
              </div>
              <div class="form-group">
                <label>Product Description</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="ti-circle text-primary"></i>
                    </span>
                  </div>
                  <textarea value="{{$product->product_description}}" name="product_description" id="product_description" cols="10" rows="1" class="form-control form-control-lg border-left-0" placeholder="Product Description">{{$product->product_description}}</textarea>
                  <!-- <textarea type="text" class="form-control form-control-lg border-left-0" placeholder="Product Description" name="product_quantity" id="product_quantity" > -->
                </div>
              </div>
              <div class="form-group">
                <label>Product Image</label>
                <div class="input-group">
                  <!-- <div class="input-group-prepend bg-transparent"  style=" padding: 5.25rem 0.75re">
                    <span class="input-group-text bg-transparent border-right-0"  style=" padding: 5.25rem 0.75re">
                      <i class="ti-email text-primary"></i>
                    </span>
                  </div> -->
                  <input type="file" id="image" name="image" class="form-control">
                  <img src="{{asset('uploads/'.$product->image)}}" alt="">

                  <!-- <input type="file" class="form-control form-control-lg border-left-0" placeholder="Product Image" name="image" id="image" > -->
                </div>
              </div>

              <div class="mt-3">
                <button type="submit" class="btn btn-inverse-primary btn-fw">UPDATE PRODUCT</button>
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
</div>
@endsection