<!DOCTYPE html>
<html>

<head>
    <meta lang="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets1/css/checkout.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">

    </script>
</head>

<body>
    <div class="container card" style="    margin-right: 50%;    width: 500px;">
        <span>
            <!-- <input type="checkbox" id="fname" name="firstname" placeholder="Full Name"> &nbsp;&nbsp;Cash On Delivery -->
            <div class="dropdown p-3 border bg-light text-center " style="height:120px;">
                <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Cash On Delivery
                </button>
                <div class="dropdown-menu col-md-12">
                    <form id='checkout-form' method='post' action="{{ route('single_placeOrder') }}">
                        @csrf

                        @foreach($address as $add)
                        @if($add->user_id == Auth()->user()->id)
                        <input type="hidden" name="aid" value="{{$add->id}}">
                        @endif
                        @endforeach
                        <input type='hidden' name='pid' value="{{$buy->id}}">
                        <input type='hidden' name='order_name' value="{{$buy->product_name}}">
                        <input type='hidden' name='product_quantity' value="1">
                        <input type='hidden' name='product_price' value="{{$buy->product_price}}">
                        <br>
                        <!-- <div id="card-element" class="form-control"></div> -->
                        <button id='pay-btn' class="btn btn-success mt-3" type="submit" style="margin-top: 20px; width: 100%;padding: 7px;">Placed Order
                        </button>
                        <form>
                </div>
            </div>
        </span>
        <hr>
        <hr>
        <a style="margin-top: -50px;" href="{{ url('payment', ['pid' => $buy->id, 'order_name' => $buy->product_name]) }}" class="btn btn-default">Card Payment</a>

        <!-- <a style=" margin-top: -50px;" href="{{url('payment')}}" class="btn btn-default">Card Payment</a> &nbsp; -->
        <hr>
        <!-- <div class="dropdown" style="display: block;">
            <button type="button" class="btn  btn-default dropdown-toggle" data-bs-toggle="dropdown">
                Card Payment<span class="caret"></span>
            </button>
            <div class="dropdown-menu col-md-12">
                <form id='checkout-form' method='post' action="{{ route('processPayment') }}">
                    @csrf
                    <input type='hidden' name='stripeToken' id='stripe-token-id'>
                    <br>
                    <div id="card-element" class="form-control"></div>
                    <button id='pay-btn' class="btn btn-success mt-3" type="submit" style="margin-top: 20px; width: 100%;padding: 7px;" onclick="createToken()">PAY $10
                    </button>
                    <form>
            </div>
        </div> -->
        <!-- <a ><button>Card Payment</button></a> &nbsp; -->
        <hr>
        <hr>
        <div class="col-md-6">
            <div class="container card" style="margin-right: 40%;  margin-top: -100px;   width: 400px;">
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
        <hr>
        <div class="col-md-6">
            <div class="container card" style="margin-right: 40%;    width: 400px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sr No.</th>
                            <th scope="col">Address</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    @foreach($address as $add)
                    @if($add->user_id == Auth()->user()->id)
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <!-- <th scope="row">1</th> -->
                            <td>

                                <p>
                                    {{$add->shipping_name}},
                                    {{$add->shipping_address}}
                                    {{$add->shipping_city}}
                                    {{$add->shipping_state}}
                                    {{$add->shipping_zip}}
                                    {{$add->shipping_mobile}}
                                    {{$add->shipping_nearby}}

                                </p>

                            </td>
                            <td>
                                edit
                            </td>
                        </tr>

                    </tbody>
                    @endif
                    @endforeach
                </table>
            </div>
        </div>

    </div>
</body>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  
    var stripe = Stripe('{{ env('STRIPE_KEY') }}')
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
   
            if(typeof result.error != 'undefined') {
                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }
  
            /* creating token success */
            if(typeof result.token != 'undefined') {
                document.getElementById("stripe-token-id").value = result.token.id;
                document.getElementById('checkout-form').submit();
            }
        });
    }
</script> -->

</html>