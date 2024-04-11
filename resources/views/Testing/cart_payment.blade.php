@extends('home.layout.app')
@section('content')


<div class="container" style=" margin-top: 80px;">
    <div class="row">

        <div class="col-md-8 order-md-1">


            <div class="col-md-10 col-md-offset-3 card" style="margin-top:75px;     margin-left: 75px; padding: 15px;">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <h2 class="panel-title">Checkout Forms</h2>
                    </div>
                    <div class="panel-body">

                        @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif

                             <form id='checkout-form' method='post' action="{{ route('cart_process_payment') }}">
                                    @csrf
                                    <div class="input-group">
                                        <!-- <div class="input-group-prepend">
                                                    <span class="input-group-text" id="">First and last name</span>
                                                </div> -->
                                        Name: <input type="text" class="form-control" name="customer_name" placeholder="Customer Name">&nbsp;
                                        Email: <input type="email" class="form-control" name="customer_email" placeholder="Customer Email">
                                    </div>
                                    <input type='hidden' name='stripeToken' id='stripe_token_id'>
                                    <input type="hidden" name="paymentmode" value="Card">
                                    <input type="hidden" name="total_amount" value="{{$total_cart_amount}}">
                                    <input type="hidden" name="total_quantity" value="{{$total_quantity}}">
                                    <input type="hidden" name="address_id" value="{{$address->id}}">
                                    @foreach( $cart_product as $buy)
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
                                    <button id='pay-btn' class="btn btn-success mt-3" type="button" style="margin-top: 20px; width: 100%;padding: 7px;" onclick="createToken()">PAY ${{$total_cart_amount}}
                                    </button>

                            <form>

                    </div>
                </div>
            </div>



        </div>
    </div>

</div>

<!-- Stripe -->

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