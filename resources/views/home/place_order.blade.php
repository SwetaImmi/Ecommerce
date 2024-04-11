@extends('home.layout.app')
@section('content')
@php
$totalCount = 0;
$totalAmount = 0;
@endphp
@php
$totalCount += $buy->product_quantity;
@endphp

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">{{$productQnty}}</span>
            </h4>
            <ul class="list-group mb-3">


                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{$buy->product_name}}</h6>
                        <small class="text-muted">Quantity
                        <form action="{{ url('checkout').'/'. $buy->id}}" method="get">
                                    <input  min="1" type="number" name="product_quantity" id="increaseQuantityBtn" value="{{$productQnty}}" style="width: 35px; background-color:#cccccc; border-radius:5px;">
                                    <button type="submit" ><img src="{{url('assets1/images/updated.png')}}" alt="" style="width: 20px; "></button>
                                </form>    
                            </small>
                    </div>
                    <span class="text-muted">${{$buy->product_price}}</span>
                </li>
                @php $totalAmount += $buy->product_price; $totalCount += $buy->product_quantity;
                @endphp

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$ {{ $totalAmount*$productQnty  }} </strong>
                </li>
            </ul>
            <!-- Form -->
            <form class="card p-2">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </form>
            <!-- Form -->
        </div>
        <div class="col-md-8 order-md-1">

            <h4 class="mb-3">Shipppingg address</h4>

            <form id="checkout-cash" class="needs-validation" action="{{ route('single_placeOrder') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <input type="hidden" name="address_id" value="{{$address->id}}">
                        <input type="text" class="form-control" id="username" name="shipping_name" placeholder="Username" value="{{$address->shipping_name}}" disabled>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted"></span></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" disabled>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="shipping_address" value="{{$address->shipping_address}}" disabled>
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">City</label>
                        <input type="text" class="form-control" id="address2" name="shipping_city" value="{{$address->shipping_city}}" disabled>


                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="address2" name="shipping_state" value="{{$address->shipping_state}}" disabled>

                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name="shipping_zip" value="{{$address->shipping_zip}}" disabled>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact">Contact No.</label>
                        <input type="text" class="form-control" id="firstName" name="shipping_mobile" value="{{$address->shipping_mobile}}" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Near By </label>
                        <input type="text" class="form-control" id="lastName" name="shipping_nearby" value="{{$address->shipping_nearby}}" disabled>
                    </div>
                </div>
                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                    <input id="checkbox" type="checkbox" checked="checked" name="sameadr">
                    <label>Show Billing Address</label>
                    <a href="{{url('edit_adderess'.'/'.$address->id)}}" role="button" class="btn btn-primary" style="margin-left: 350px;">Edit</a>

                </div>
                <hr class="mb-4">
                <div id="myForm" style="display: none; ">

                    <h4 class="mb-3">Billing address</h4>
                    <hr class="mb-4">

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="billing_name" name="billing_name" placeholder="Username" value="{{$address->billing_name}}" disabled>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="billing_address" name="billing_address" value="{{$address->billing_address}}" disabled>
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">City</label>
                            <input type="text" class="form-control" id="billing_city" name="billing_city" value="{{$address->billing_city}}" disabled>

                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="billing_state" name="billing_state" value="{{$address->billing_state}}" disabled>

                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="billing_zip" name="billing_zip" value="{{$address->billing_zip}}" disabled>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contact">Contact No.</label>
                            <input type="text" class="form-control" id="billing_mobile" name="billing_mobile" value="{{$address->billing_mobile}}" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Near By </label>
                            <input type="text" class="form-control" id="billing_nearby" name="billing_nearby" value="{{$address->billing_nearby}}" disabled>
                        </div>
                    </div>


                </div>
                <h4 class="mb-3">Payment</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="cash" name="paymentMethod" type="radio" class="custom-control-input" value="cash_on_delivery" required>
                        <label class="custom-control-label" for="cash" style="padding-left: 25px;">Cash On Delivery</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <!-- for="show_payment"><input type="radio" name="payment_option" id="show_payment" value="show" -->
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" value="card_payment" required>
                        <label class="custom-control-label" for="credit" style="padding-left: 25px;">Credit card</label>

                    </div>
                    <!-- Product detail -->
                    <input type="hidden" name="address_id" value="{{$address->id}}">
                    <input type='hidden' name='pid' value="{{$buy->id}}">
                    <input type='hidden' name='order_name' value="{{$buy->product_name}}">
                    <input type='hidden' name='product_quantity' value="{{$productQnty}}">
                    <input type='hidden' name='product_price' value="{{$buy->product_price*$productQnty}}">
                    <!-- End product detail -->
                </div>
                <input type="hidden" name="total_amount" value="{{$totalAmount}}">
                <input type="hidden" name="total_quantity" value="{{ $totalCount }}">
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" id="cash_checkout">Continue to checkout</button>
            </form>

            <div id="payment_card" style="display: none;">
                <form id='checkout-form' method='post' action="{{ route('processPayment') }}">
                    @csrf

                    <input type='hidden' name='stripeToken' id='stripe_token_id'>
                    <input type="hidden" name="paymentmode" value="Card">
                    <input type="hidden" name="total_amount" value="{{$totalAmount}}">
                    <!-- <input type="hidden" name="total_quantity" value="{{$totalCount}}"> -->
                    <input type="hidden" name="address_id" value="{{$address->id}}">
                    @php
                    $userAddress = $address->firstWhere('user_id', Auth()->user()->id);
                    @endphp
                    @if($userAddress)
                    <input type="hidden" name="aid" value="{{$address->id}}">
                    @endif

                    <input type='hidden' name='pid' value="{{$buy->id}}">
                    <input type='hidden' name='order_name' value="{{$buy->product_name}}">
                    <input type='hidden' name='product_quantity' value="{{$productQnty}}">
                    <input type='hidden' name='product_price' value="{{$buy->product_price*$productQnty}}">
                    <br>
                    <div id="card-element" class="form-control"></div>
                    <button id='pay-btn' class="btn btn-success mt-3" type="button" 
                    style="margin-top: 20px; width: 100%;padding: 7px;" onclick="createToken()">PAY ${{$totalAmount*$productQnty}}
                    </button>

                    <form>
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

    document.getElementById('checkbox').addEventListener('change', function() {
        var form = document.getElementById('myForm');
        var checkbox = document.getElementById('checkbox');

        if (checkbox.checked) {
            form.style.display = 'none'; // Hide the form if the checkbox is checked
        } else {
            form.style.display = 'block'; // Show the form if the checkbox is unchecked
        }
    });

    /*   Payment Method    */
    const showPaymentRadio = document.getElementById('credit');
    const hidePaymentRadio = document.getElementById('cash');
    const paymentCardDiv = document.getElementById('payment_card');
    const cashPayment = document.getElementById('cash_checkout');
    showPaymentRadio.addEventListener('change', function() {
        if (this.checked) {
            paymentCardDiv.style.display = 'block'; // Show the div when 'Show Payment' is selected
            cashPayment.style.display = 'none'; // hide Checkout 
        }
    });
    hidePaymentRadio.addEventListener('change', function() {
        if (this.checked) {
            paymentCardDiv.style.display = 'none'; // Hide the div when 'Hide Payment' is selected
            cashPayment.style.display = 'block'; // Show Checkout 

        }
    });
</script>

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    var stripe = Stripe('{{ env("STRIPE_KEY") }}')
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    /*------------------------------------------
    --------------------------------------------
    Create Token Code
    --------------------------------------------
    --------------------------------------------*/
    function createToken() {
        document.getElementById("pay-btn").disabled = true;
        stripe.createToken(cardElement).then(function(result) {
            if (typeof result.error != 'undefined') {
                alert("failed")

                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }

            /* creating token success */
            if (typeof result.token != 'undefined') {
                // alert("pass")
                document.getElementById('stripe_token_id').value = result.token.id;
                document.getElementById('checkout-form').submit();
                // document.getElementById('stripe_token_id').value = result.token.id;
                // document.getElementById('checkout-form').submit();
            }
            // alert(result.token.id)
        });
    }
</script>

<!-- QUANTITY INCREASE -->
<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('#increaseQuantityBtn').click(function(){
        var currentQuantity = localStorage.getItem('product_quantity') || 0;
        currentQuantity++;
        localStorage.setItem('product_quantity', currentQuantity);
        $('#quantityDisplay').text(currentQuantity);
    });
});
</script>


@endsection