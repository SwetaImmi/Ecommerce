@extends('admin.layouts.frontend')
@section('content')



<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">


        <div class="row w-100 mx-0">
            <div class="col-lg-6 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <div class="brand-logo">
                        <img src="{{asset('assets/images/logo.png')}}" alt="logo">
                    </div>
                    <div class="alert" id="message" style="display: none"></div>

                    <h4>Add Your Banner</h4>
                    <!-- <h6 class="font-weight-light">Join us today! It takes only few steps</h6> -->

                    <!-- <form class="pt-3"  action="product_add" method="post" > -->
                    <!-- alert -->

                    <div class="alert  print-error-msg " style="display:none " role="alert">
                        <span style="color: red;">
                            <strong>Error!</strong> Please Fill all feild with the valid information...
                        </span>
                    </div>
                    <!-- alert -->
                    <form action="banner" method="post" id="forms" enctype="multipart/form-data">
                        @csrf
                        <p>Main Banner</p>
                        <div class="form-group">
                            <!-- <label>Banner Image</label> -->
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <span class="input-group-text bg-transparent border-right-0">
                                        <i class="ti-image text-primary"></i>
                                    </span>
                                </div>
                                <input type="file" id="image" name="main_image" class="form-control form-control-lg border-left-0">
                            </div>
                            <span>
                                @error('main_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <!-- <label>Banner Name</label> -->
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <span class="input-group-text bg-transparent border-right-0">
                                        <i class="ti-circle text-primary"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg border-left-0" placeholder="Banner Content" name="banner_content" id="banner_content">
                            </div>
                            <span>
                                @error('banner_content')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </span>
                        </div>
                        <p>Side Banner 1</p>
                        <div class="form-group">
                            <!-- <label>Banner Image</label> -->
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <span class="input-group-text bg-transparent border-right-0">
                                        <i class="ti-image text-primary"></i>
                                    </span>
                                </div>
                                <input type="file" id="first_banner_image" name="first_banner_image" class="form-control form-control-lg border-left-0">
                            </div>
                            <span>
                                @error('first_banner_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <span class="input-group-text bg-transparent border-right-0">
                                        <i class="ti-circle text-primary"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg border-left-0" placeholder="Banner Name" name="first_banner_content" id="first_banner_content">
                            </div>
                            <span>
                                @error('first_banner_content')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </span>
                        </div>
                        <p>Side Banner 2</p>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <span class="input-group-text bg-transparent border-right-0">
                                        <i class="ti-image text-primary"></i>
                                    </span>
                                </div>
                                <input type="file" id="second_banner_image" name="second_banner_image" class="form-control form-control-lg border-left-0">
                            </div>
                            <span>
                                @error('second_banner_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <span class="input-group-text bg-transparent border-right-0">
                                        <i class="ti-circle text-primary"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg border-left-0" placeholder="Banner Name" name="second_banner_content" id="second_banner_content">
                            </div>
                            <span>
                                @error('second_banner_content')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </span>
                        </div>
                        <p>Side Banner 3</p>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <span class="input-group-text bg-transparent border-right-0">
                                        <i class="ti-image text-primary"></i>
                                    </span>
                                </div>
                                <input type="file" id="third_banner_image" name="third_banner_image" class="form-control form-control-lg border-left-0">
                            </div>
                            <span>
                                @error('third_banner_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <span class="input-group-text bg-transparent border-right-0">
                                        <i class="ti-circle text-primary"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg border-left-0" placeholder="Banner Name" name="third_banner_content" id="banner_name">
                            </div>
                            <span>
                                @error('third_banner_content')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </span>
                        </div>
                        <p>Side Banner 4</p>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <span class="input-group-text bg-transparent border-right-0">
                                        <i class="ti-image text-primary"></i>
                                    </span>
                                </div>
                                <input type="file" id="last_banner_image" name="last_banner_image" class="form-control form-control-lg border-left-0">
                            </div>
                            <span>
                                @error('last_banner_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <span class="input-group-text bg-transparent border-right-0">
                                        <i class="ti-circle text-primary"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg border-left-0" placeholder="Last Banner Content" name="last_banner_content" id="banner_name">
                            </div>
                            <span>
                                @error('last_banner_content')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </span>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-inverse-primary btn-fw">ADD BANNER</button>
                        </div>
                        <div class="text-center mt-4 font-weight-light">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->

    <!-- page-body-wrapper ends -->
</div>




@endsection