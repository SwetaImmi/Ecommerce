@extends('admin.layouts.auth')
@section('content')

<!-- aklert -->
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif

<!-- alert -->
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
              <img src="{{asset('assets/images/logo.png')}}" alt="logo">
            </div>
            <!-- <h4>Hello! let's get started</h4> -->
            <h6 class="font-weight-light">Sign in to continue.</h6>
            <form class="pt-3" action="{{url('login_post')}}" method="post">
              @csrf
              <div class="form-group">

                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" autocomplete="off">
              </div>
              <div class="mt-3">
                <button type="submit" class="btn btn-inverse-primary btn-fw">LOGIN</button>
              </div>
              <div class="my-2 d-flex justify-content-between align-items-center">
                <!-- <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div> -->
                <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
              </div>
              <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook me-2"></i>Connect using facebook
                  </button>
                </div> -->
              <div class="text-center mt-4 font-weight-light">
                @if(Auth::user() != NULL)
                Don't have an account? <a href="{{url('register')}}" class="text-primary">Create</a>

                @else
                Don't have an account? <a href="{{url('signin')}}" class="text-primary">Create</a>
                @endif
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
<!-- container-scroller -->
@endsection