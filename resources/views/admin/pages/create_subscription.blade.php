@extends('admin.layouts.frontend')
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


<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0" style="    margin-top: -250px;">
            <div class="col-lg-5 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="margin-top:180px;">
                    <div class="brand-logo">
                        <img src="{{asset('assets/images/logo.png')}}" alt="logo">
                    </div>
                    <h4>Hello! Add Your Subscription Plan</h4>
                    <!-- <h6 class="font-weight-light">Sign in to continue.</h6> -->
                    <form class="pt-3" action="{{url('admin/create_plans')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Name of Plan">
                            <span> @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror</span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="price" name="price" placeholder="Amount">
                            <span> @error('price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror</span>
                        </div>
                        <div class="form-group">
                            <select name="plan_interval" id="plan_interval" class="form-control form-control-lg">
                                <option>Select Interval</option>
                                <option value="day">Day</option>
                                <option value="week">Week</option>
                                <option value="month">Month</option>
                                <option value="year">Year</option>
                            </select>
                            <input type="hidden" class="form-control form-control-lg" value="This is for subscription testing" id="description" name="description" placeholder="Plan Description">
                            <span> @error('plan_interval')
                                <span class="text-danger">{{$message}}</span>
                                @enderror</span>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-inverse-primary btn-fw">Add Plan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<!-- page-body-wrapper ends -->
<!-- container-scroller -->
@endsection