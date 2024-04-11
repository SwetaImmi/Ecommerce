@extends('home.layout.app')
@section('content')
@php
$totalCount = 0;
$totalAmount = 0;
@endphp
@foreach( $cart_purchase as $buy)
@php
$totalCount += $buy->product_quantity;
@endphp
@endforeach
<div class="container" style="    margin-top: 100px;">
    <div class="row">

        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3" style="margin-top: 30px;">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">{{ $totalCount }}</span>
            </h4>
            <ul class="list-group mb-3" style="margin-top: 20px;">

                @foreach( $cart_purchase as $buy)

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{$buy->product->product_name}}</h6>
                        <small class="text-muted"> Quantity
                            <form action="{{ url('cart_update').'/'. $buy->id  }}" method="POST">
                                @csrf
                                <input type="hidden" name="cid" value="{{ $buy->id}}">
                                <a onclick="return confirm('Are you sure?')" class="btn btn-inverse-danger btn-fw" href="{{ url('cdelete').'/'. $buy->id}}" role="button">
                                    <i class="fas fa-trash" style="color:tomato">
                                    </i>
                                </a>
                                <input type="number" min="1" name="quantity" value="{{$buy->product_quantity}}" class="w-6 text-center bg-gray-300" style="width: 50px;" />
                                <button type="submit" class="btn btn-secondry btn-rounded btn-icon"><img src="{{url('assets1/images/updated.png')}}" alt="" style="width: 20px;"></button>
                            </form>

                        </small>
                    </div>
                    <span class="text-muted">${{$buy->product->product_price*$buy->product_quantity}}</span>
                </li>
                @php $totalAmount += $buy->product->product_price*$buy->product_quantity;
                @endphp
                @endforeach

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$ {{ $totalAmount }} </strong>
                </li>
            </ul>

        </div>

        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Shippping address</h4>
            <form id="checkout-cash" class="needs-validation" action="{{ route('placeOrder') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                    <input type='hidden' name='product_id' value="{{$buy->product->id}}">

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
                    @foreach( $cart_purchase as $buy)
                    @if($address)
                    <input type="hidden" name="order_details[{{$loop->index}}][aid]" value="{{$address->id}}">
                    @endif
                    <input type='hidden' name='order_details[{{$loop->index}}][pid]' value="{{$buy->product->id}}">
                    <input type='hidden' name='order_details[{{$loop->index}}][order_name]' value="{{$buy->product->product_name}}">
                    <input type='hidden' name='order_details[{{$loop->index}}][product_quantity]' value="{{$buy->product_quantity}}">
                    <input type='hidden' name='order_details[{{$loop->index}}][product_price]' value="{{$buy->product->product_price}}">
                    <br>
                    @endforeach
                    <!-- End product detail -->
                </div>
                <input type="hidden" name="total_amount" value="{{$totalAmount}}">
                <input type="hidden" name="total_quantity" value="{{ $totalCount }}">
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" id="cash_checkout">Continue to checkout</button>
            </form>

            <div id="payment_card" style="display: none;">
                <form id='checkout-form' method='post' action="{{ route('cart_process_payment') }}">
                    @csrf

                    <input type='hidden' name='stripeToken' id='stripe_token_id'>
                    <input type="hidden" name="paymentmode" value="Card">
                    <input type="hidden" name="total_amount" value="{{$totalAmount}}">
                    <input type="hidden" name="total_quantity" value="{{$totalCount}}">
                    <input type="hidden" name="address_id" value="{{$address->id}}">
                    <input type='hidden' name='product_id' value="{{$buy->product->id}}">

                    @foreach( $cart_purchase as $buy)
                    @php
                    $userAddress = $address->firstWhere('user_id', Auth()->user()->id);
                    @endphp

                    @if($userAddress)

                    <input type="hidden" name="order_details[{{$loop->index}}][aid]" value="{{$userAddress->id}}">
                    @endif
                    <input type='hidden' name='order_details[{{$loop->index}}][pid]' value="{{$buy->product->id}}">
                    <input type='hidden' name='order_details[{{$loop->index}}][order_name]' value="{{$buy->product->product_name}}">
                    <input type='hidden' name='order_details[{{$loop->index}}][product_quantity]' value="{{$buy->product_quantity}}">
                    <input type='hidden' name='order_details[{{$loop->index}}][product_price]' value="{{$buy->product->product_price}}">
                    <br>
                    @endforeach
                    <div id="card-element" class="form-control"></div>
                    <button id='pay-btn' class="btn btn-success mt-3" type="button" style="margin-top: 20px; width: 100%;padding: 7px;" onclick="createToken()">PAY ${{$totalAmount}}
                    </button>

                    <form>
            </div>
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    /*   Billing address code show      */
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

@endsection