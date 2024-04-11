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
                    <form id='checkout-form' method='post' action="{{ route('placeOrder') }}">
                        @csrf
                        @foreach( $cart_purchase as $buy)
                        @php
                        $userAddress = $address->firstWhere('user_id', Auth()->user()->id);
                        @endphp
                        @if($userAddress)
                        <input type="hidden" name="order_details[{{$loop->index}}][aid]" value="{{$userAddress->id}}">
                        @endif
                        <!-- @foreach($address as $add)
                        @if($add->user_id == Auth()->user()->id)
                        <input type="hidden" name="order_details[{{$loop->index}}][aid]" value="{{$add->id}}">
                        @endif
                        @endforeach -->
                        <input type='hidden' name='order_details[{{$loop->index}}][pid]' value="{{$buy->product->id}}">
                        <input type='hidden' name='order_details[{{$loop->index}}][order_name]' value="{{$buy->product->product_name}}">
                        <input type='hidden' name='order_details[{{$loop->index}}][product_quantity]' value="{{$buy->product_quantity}}">
                        <input type='hidden' name='order_details[{{$loop->index}}][product_price]' value="{{$buy->product->product_price}}">
                        <br>
                        @endforeach

                        <!-- <div id="card-element" class="form-control"></div> -->
                        <button id='pay-btn' class="btn btn-success mt-3" type="submit" style="margin-top: 20px; width: 100%;padding: 7px;">Placed Order</button>
                    </form>

                </div>
            </div>
        </span>
        <hr>
        <hr>
        <a style=" margin-top: -50px;" href="{{url('payment/'.$buy->id)}}" class="btn btn-default">Card Payment</a> &nbsp;

        <hr>

        <hr>
        <hr>
        <div class="col-md-6">
            @php
            $totalAmount = 0;
            @endphp
            @foreach( $cart_purchase as $buy)

            <div class="container card" style="margin-right: 40%;  margin-top: -100px;   width: 400px;">
                <p>
                    <a href="#">
                        <img src="{{asset('uploads/'.$buy->product->product_image)}}" alt="image" style="border-radius: 20%; height:50px; width:50px;" />
                    </a>
                    <span class="price">{{$buy->product->product_price}}</span>
                </p>
                <p>
                    <span>Discount price</span>
                    <span class="price">{{$buy->product->product_price/10}}</span>
                </p>
                <p>Total <span class="price" style="color:black"><b>${{$buy->product->product_price - $buy->product->product_price/10}}</b></span></p>
                @php
                $totalAmount += $buy->product->product_price - $buy->product->product_price/10;

                @endphp
                <hr>
                <p>Total <span class="price" style="color:black"><b> <strong>Total Amount: {{ $totalAmount }}
                            </strong></b></span></p>
            </div>

            @endforeach
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


</html>