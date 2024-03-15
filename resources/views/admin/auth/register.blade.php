@extends('admin.layouts.auth')
@section('content')
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
              <img src="{{asset('assets/images/logo.png')}}" alt="logo">
            </div>
            <h4>New here?</h4>
            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
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

            <form action="register_store" method="post" class="pt-3">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control form-control-lg" id="name" placeholder="Username" name="name" autocomplete="OFF">
                <span> @error('name')
                  <span class="text-danger">{{$message}}</span>
                  @enderror</span>
              </div>
              <div class="form-group">
                <input type="email" class="form-control form-control-lg" id="email" placeholder="Email" name="email" autocomplete="off">
                <span> @error('email')
                  <span class="text-danger">{{$message}}</span>
                  @enderror</span>
              </div>
              <div class="form-group">
                <select class="form-control form-control-lg" id="role" name="role">
                  <option>Select Role</option>
                  <option value="Admin">Admin</option>
                  <option value="User">User</option>
                </select>
                <span> @error('role')
                  <span class="text-danger">{{$message}}</span>
                  @enderror</span>
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="password" placeholder="Password" name="password">
                <span> @error('password')
                  <span class="text-danger">{{$message}}</span>
                  @enderror</span>
              </div>
              <div class="mb-4">
                <div class="form-check">
                  <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input">
                    I agree to all Terms & Conditions
                  </label>
                </div>
              </div>
              <div class="mt-3">
                <button type="submit" class="btn btn-inverse-primary btn-fw">SIGN UP</button>
              </div>
              <div class="text-center mt-4 font-weight-light">
                Already have an account? <a href="login" class="text-primary">Login</a>
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