@extends('home.layout.app')
@section('content')
<h1> Checkout Form</h1>
<div class="container" style=" margin-top: 50px;">
  <div class="row">
    <div class="container">
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Shipping address</h4>
        <form class="needs-validation" action="{{url('checkout/post')}}" method="post">
          @csrf
          <div class="mb-3">
            <label for="username">Username</label>
            <div class="input-group">
              <input type="text" class="form-control" id="username" name="shipping_name" placeholder="Username">
            </div>
            <span>
              @error('shipping_name')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </span>
          </div>

          <div class="mb-3">
            <label for="email">Email <span class="text-muted"></span></label>
            <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}">
          </div>

          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="shipping_address">
            <span>
              @error('shipping_address')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </span>
          </div>

          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="country">City</label>
              <input type="text" class="form-control" id="address2" name="shipping_city">
              <span>
              @error('shipping_city')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </span>
            </div>
            <div class="col-md-4 mb-3">
              <label for="state">State</label>
              <input type="text" class="form-control" id="address2" name="shipping_state">
              <span>
              @error('shipping_state')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </span>
            </div>
            <div class="col-md-3 mb-3">
              <label for="zip">Zip</label>
              <input type="text" class="form-control" id="zip" name="shipping_zip">
              <span>
              @error('shipping_zip')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </span>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="contact">Contact No.</label>
              <input type="text" class="form-control" id="shipping_mobile" name="shipping_mobile">
              <span>
              @error('shipping_mobile')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </span>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Near By </label>
              <input type="text" class="form-control" id="shipping_nearby" name="shipping_nearby">
              <span>
              @error('shipping_nearby')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </span>
            </div>
          </div>


          <hr class="mb-4">
          <div class="custom-control custom-checkbox">
            <input id="checkbox" type="checkbox" checked="checked" name="sameadr">
            <label for="same-address">Shipping address is the same as my billing address</label>
           
          </div>

          <hr class="mb-4">
          <div id="myForm" style="display: none; ">

            <h4 class="mb-3">Billing address</h4>
            <hr class="mb-4">

            <div class="mb-3">
              <label for="username">Username</label>
              <div class="input-group">
                <input type="text" class="form-control" id="billing_name" name="billing_name" placeholder="Username">
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}">
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="billing_address" name="billing_address">
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">City</label>
                <input type="text" class="form-control" id="billing_city" name="billing_city">

              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <input type="text" class="form-control" id="billing_state" name="billing_state">

              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="billing_zip" name="billing_zip">

              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="contact">Contact No.</label>
                <input type="text" class="form-control" id="billing_mobile" name="billing_mobile">
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Near By </label>
                <input type="text" class="form-control" id="billing_nearby" name="billing_nearby">
              </div>
            </div>


          </div>
          <!-- <hr class="mb-4"> -->
          <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
      </div>
    </div>
  </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
  $(document).ready(function() {


    $('[type="checkbox"]').change(function() {

      if (this.checked) {
        $('[type="checkbox"]').not(this).prop('checked', false);
      }
    });

  });
</script>

<script>
  document.getElementById('checkbox').addEventListener('change', function() {
    var form = document.getElementById('myForm');
    var checkbox = document.getElementById('checkbox');

    if (checkbox.checked) {
      form.style.display = 'none'; // Hide the form if the checkbox is checked
    } else {
      form.style.display = 'block'; // Show the form if the checkbox is unchecked
    }
  });
</script>


@endsection