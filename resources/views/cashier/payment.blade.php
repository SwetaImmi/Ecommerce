<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <style>
        a {
            color: #2196F3;
        }

        hr {
            border: 1px solid lightgrey;
        }

        span.price {
            float: right;
            color: grey;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="row">

            <div class="col-md-6 col-md-offset-3" style="margin-top:150px;     margin-left: 500px;">
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

                        <form id='checkout-form' method='post' action="{{ route('processPayment') }}">
                            @csrf
                            <div class="input-group">
                                <!-- <div class="input-group-prepend">
                                    <span class="input-group-text" id="">First and last name</span>
                                </div> -->
                               Name: <input type="text" class="form-control" name="customer_name" placeholder="Customer Name">&nbsp;
                               Email: <input type="email" class="form-control" name="customer_email" placeholder="Customer Email">
                            </div>
                            @foreach($address as $add)
                            @if($add->user_id == Auth()->user()->id)
                            <input type="hidden" name="aid" value="{{$add->id}}">
                            @endif
                            @endforeach
                            <input type='hidden' name='pid' value="{{$product->id}}">
                            <input type='hidden' name='stripeToken' id='stripe-token-id'>
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="product_name" value="{{$product->product_name}}">
                            <input type="hidden" name="paymentmode" value="Card">
                            <input type='hidden' name='product_quantity' value="1">
                            <input type="hidden" name="product_price" value="{{$product->product_price - $product->product_price/10}}">
                            <br>
                            <div id="card-element" class="form-control"></div>
                            <button id='pay-btn' class="btn btn-success mt-3" type="button" style="margin-top: 20px; width: 100%;padding: 7px;" onclick="createToken()">PAY ${{$product->product_price - $product->product_price/10}}
                            </button>
                            <form>

                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="container card" style="
               margin-top: -200px;
    width: 400px;
    background-color: #f2f2f2;
    padding: 15px 14px 17px 15px;
    border: 1px solid lightgrey;
    border-radius: 3px;">
                    <p> <strong>{{$product->product_name}}</strong> </p>
                    <p>
                        <a href=" #">
                            <img src="{{asset('uploads/'.$product->product_image)}}" alt="image" style="border-radius: 20%; height:50px; width:50px;" />
                        </a>

                        <span class="price">{{$product->product_price}}</span>
                    </p>
                    <p>
                        <span>Discount price</span>
                        <span class="price">{{$product->product_price/10}}</span>
                    </p>
                    <hr>
                    <p>Total <span class="price" style="color:black"><b>${{$product->product_price - $product->product_price/10}}</b></span></p>
                </div>
            </div>


        </div>

    </div>

</body>

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
                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }

            /* creating token success */
            if (typeof result.token != 'undefined') {
                document.getElementById("stripe-token-id").value = result.token.id;
                document.getElementById('checkout-form').submit();
            }
        });
    }
</script>

</html>