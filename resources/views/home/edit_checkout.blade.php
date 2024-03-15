<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('assets1/css/checkout.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>

  <h1> Edit Checkout Form</h1>
  <div class="row">
    <div class="col-75">
      <div class="container">
        <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
          @csrf
          <div class="row">
            <div class="col-50">
              <h3>Shipping Address</h3>
              <label for="fname"><i class="fa fa-user"></i> Full Name</label>
              <input type="text" value="{{$Order->order_name}}" name="firstname" placeholder="Full Name">
              @if ($errors->has('firstname'))
              <span class="alert">{{ $errors->first('firstname') }}</span>
              @endif
              <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
              <input type="text" value="{{$Order->order_address}}" name="address" placeholder="Address">
              <label for="city"><i class="fa fa-institution"></i> City</label>
              <input type="text" value="{{$Order->order_city}}" name="city" placeholder="City">
              <div class="row">
                <div class="col-50">
                  <label for="state">State</label>
                  <input type="text" value="{{$Order->order_state}}" name="state" placeholder="State">
                </div>
                <div class="col-50">
                  <label for="zip">Zip</label>
                  <input type="text" value="{{$Order->order_zip}}" name="zip" placeholder="ZIP Code">
                </div>
              </div>
              <label for="email"><i class="fa fa-phone"></i> Mobile No.</label>
              <input type="text" value="{{$Order->order_mobile}}" name="phone" placeholder="Contact Number">
              <label for="email"><i class="fa fa-circle"></i> Near by place</label>
              <input type="text" value="{{$Order->order_nearby}}" name="nearby" placeholder="Near By Place">
            </div>

            <div class="col-50">
              <h3>Payment</h3>
              <label for="email"><i class="fa fa-email"></i> Full Email</label>
              <input type="text" value="{{Auth()->user()->email}}" name="email" placeholder="Full Email">
              @if ($errors->has('email'))
              <span class="alert">{{ $errors->first('email') }}</span>
              @endif
              <label for="fname">Accepted Cards</label>
              <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
                <input type="checkbox" value="{{$Order->paymentmode}}" {{ $Order->paymentmode == 'visa' ? 'checked' : null }} name="paymentmode">
                <i class="fa fa-cc-amex" style="color:blue;"></i>
                <input type="checkbox" value="{{$Order->paymentmode}}" {{ $Order->paymentmode == 'amex' ? 'checked' : null }} name="paymentmode">
                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                <input type="checkbox" value="{{$Order->paymentmode}}" {{ $Order->paymentmode == 'mastercard' ? 'checked' : null }} name="paymentmode">
                <i class="fa fa-cc-discover" style="color:orange;"></i>
                <input type="checkbox" value="{{$Order->paymentmode}}" {{ $Order->paymentmode == 'discover' ? 'checked' : null }} name="paymentmode">
                <i class="fa fa-money" style="color:green;"></i>
                <input type="checkbox" value="{{$Order->paymentmode}}" {{ $Order->paymentmode == 'cash' ? 'checked' : null }} name="paymentmode">


              </div>
              <label for="cname">Name on Card</label>
              <input class='form-control' size='4' type="text" value="{{$Order->card_name}}" name="cardname" placeholder="John More Doe">
              <label for="ccnum">Credit card number</label>
              <input autocomplete='off' class='form-control card-number' size='20' type="text" value="{{$cardNumber}}" name="cardnumber" placeholder="1111-2222-3333-4444">
              <label for="expmonth">Exp Month</label>
              <input class='form-control card-expiry-month' placeholder='MM' size='2' type="text" value="{{$Order->card_month}}" name="expmonth" placeholder="September">
              <div class="row">
                <div class="col-50">
                  <label for="expyear">Exp Year</label>
                  <input class='form-control card-expiry-year' placeholder='YY' size='2' type="text" value="{{$Order->card_year}}" name="expyear" placeholder="2018">
                </div>
                <div class="col-50">
                  <label for="cvv">CVV</label>
                  <input class='form-control card-cvc' placeholder='ex. 311' size='4' type="text" value="{{$Order->card_cvv}}" name="cvv" placeholder="352">
                </div>
              </div>
              <input type="hidden" value="{{Auth()->user()->id}}" name="uid" placeholder="352">
              <input type="hidden" value="{{$buy->id}}" name="pid" placeholder="352">
              <input type="hidden" value="1" name="product_quantity" placeholder="352">
              <input type="hidden" value="{{$buy->product_price - $buy->product_price/10}}" name="price" placeholder="352">

            </div>

          </div>
          <!-- <button>Add Address</button> -->
          <div class='form-row row'>
            <div class='col-md-12 error form-group hide'>
              <div class='alert-danger alert'>Please correct the errors and try
                again.</div>
            </div>
          </div>

          <label>
            <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
          </label>
          <input type="submit" value="Continue to checkout" class="btn">
        </form>
      </div>
    </div>
    <div class="col-25">
      <div class="container">
        <!-- {{$buy->id}} -->
        <!-- <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>4</b></span></h4> -->
        <p>
          <a href="#">
            <img src="{{asset('uploads/'.$buy->product_image)}}" alt="image" style="border-radius: 20%; height:50px; width:50px;" />
          </a>
          <span class="price">{{$buy->product_price}}</span>
        </p>
        <p>
          <span>Discount price</span>
          <span class="price">{{$buy->product_price/10}}</span>
        </p>
        <hr>
        <p>Total <span class="price" style="color:black"><b>${{$buy->product_price - $buy->product_price/10}}</b></span></p>
     
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript">
    $(function() {

      /*------------------------------------------
      --------------------------------------------
      Stripe Payment Code
      --------------------------------------------
      --------------------------------------------*/

      var $form = $(".require-validation");

      $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
          inputSelector = ['input[type=email]', 'input[type=password]',
            'input[type=text]', 'input[type=file]',
            'textarea'
          ].join(', '),
          $inputs = $form.find('.required').find(inputSelector),
          $errorMessage = $form.find('div.error'),
          valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
        //  var card =  $('.card-expiry-year').unmask();
        //  alert(card)
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }

      });

      /*------------------------------------------
      --------------------------------------------
      Stripe Response Handler
      --------------------------------------------
      --------------------------------------------*/
      function stripeResponseHandler(status, response) {
        if (response.error) {
          $('.error')
            .removeClass('hide')
            .find('.alert')
            .text(response.error.message);
        } else {
          /* token contains id, last4, and card type */
          var token = response['id'];

          $form.find('input[type=text]').empty();
          $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
          $form.get(0).submit();
        }
      }

    });
  </script>

  <script>
    $(document).ready(function() {


      $('[type="checkbox"]').change(function() {

        if (this.checked) {
          $('[type="checkbox"]').not(this).prop('checked', false);
        }
      });



    });
  </script>
</body>

</html>