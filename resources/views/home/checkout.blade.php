<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('assets1/css/checkout.css')}}">


</head>

<body>

  <h1> Checkout Form</h1>
  <div class="row">
    <div class="col-75">
      <div class="container">
        <form action="{{url('checkout/post')}}" method="post">
          @csrf
          <div class="row">
            <div class="col-50">
              <h3>Shipping Address</h3>
              <label for="fname"><i class="fa fa-user"></i> Full Name</label>
              <input type="text" id="fname" name="firstname" placeholder="Full Name">
              @if ($errors->has('firstname'))
              <span class="alert">{{ $errors->first('firstname') }}</span>
              @endif
              <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
              <input type="text" id="adr" name="address" placeholder="Address">
              <label for="city"><i class="fa fa-institution"></i> City</label>
              <input type="text" id="city" name="city" placeholder="City">
              <div class="row">
                <div class="col-50">
                  <label for="state">State</label>
                  <input type="text" id="state" name="state" placeholder="State">
                </div>
                <div class="col-50">
                  <label for="zip">Zip</label>
                  <input type="text" id="zip" name="zip" placeholder="ZIP Code">
                </div>
              </div>
              <label for="email"><i class="fa fa-phone"></i> Mobile No.</label>
              <input type="text" id="phone" name="phone" placeholder="Contact Number">
              <label for="email"><i class="fa fa-circle"></i> Near by place</label>
              <input type="text" id="email" name="nearby" placeholder="Near By Place">
            </div>


          </div>

          <label>
            <input id="checkbox" type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
          </label>
          <hr>
          <div id="myForm" style="display: none; ">
            <!-- Your form fields go here -->
            <div class="col-50">
              <h3>Billing Address</h3>
              <label for="fname"><i class="fa fa-user"></i> Full Name</label>
              <input type="text" id="fname" name="billing_name" placeholder="Full Name">
              @if ($errors->has('firstname'))
              <span class="alert">{{ $errors->first('firstname') }}</span>
              @endif
              <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
              <input type="text" id="adr" name="billing_address" placeholder="Address">
              <label for="city"><i class="fa fa-institution"></i> City</label>
              <input type="text" id="city" name="billing_city" placeholder="City">
              <div class="row">
                <div class="col-50">
                  <label for="state">State</label>
                  <input type="text" id="state" name="billing_state" placeholder="State">
                </div>
                <div class="col-50">
                  <label for="zip">Zip</label>
                  <input type="text" id="zip" name="billing_zip" placeholder="ZIP Code">
                </div>
              </div>
              <label for="email"><i class="fa fa-phone"></i> Mobile No.</label>
              <input type="text" id="phone" name="billing_phone" placeholder="Contact Number">
              <label for="email"><i class="fa fa-circle"></i> Near by place</label>
              <input type="text" id="email" name="billing_nearby" placeholder="Near By Place">
            </div>
          </div>


          <input type="submit" value="Continue to checkout" class="btn">
          <div class="col-25">
            <div class="container">{{$buy->id}}
              <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>4</b></span></h4>
              <p>
                <a href="#">
                  <img src="{{asset('uploads/'.$buy->product_image)}}" alt="image" style="border-radius: 20%; height:50px; width:50px;" />
                </a>
                <span class="price">{{$buy->product_price}}</span>
              </p>
              <!-- <p>
                <a href="#">Product 2</a>
                <span class="price">$5</span>
              </p>
              <p>
                <a href="#">Product 3</a>
                <span class="price">$8</span>
              </p>
              <p>
                <a href="#">Product 4</a>
                <span class="price">$2</span>
              </p> -->
              <hr>
              <p>Total <span class="price" style="color:black"><b>${{$buy->product_price}}</b></span></p>
            </div>
          </div>
        </form>
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


</body>

</html>