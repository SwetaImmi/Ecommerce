@extends('home.layout.app')
@section('content')
<div class="super_container" style="    margin-top: 90px;">
    <header class="header" style="display: none;">
        <div class="header_main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                        <div class="header_search">
                            <div class="header_search_content">
                                <div class="header_search_form_container">
                                    <form action="#" class="header_search_form clearfix">
                                        <div class="custom_dropdown">
                                            <div class="custom_dropdown_list"> <span class="custom_dropdown_placeholder clc">All Categories</span> <i class="fas fa-chevron-down"></i>
                                                <ul class="custom_list clc">
                                                    <li><a class="clc" href="#">All Categories</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="single_product" style="    padding-bottom: 5px;">
        <div class="container-fluid" style=" background-color: #fff; padding: 11px;">
            <div class="row">

                <div class="col-lg-7">
                    <div class="image_selected" style="height:600px;">
                        <img id="change-image" src="{{asset('uploads/'.$product->product_image)}}" class="product-image" alt="Product Image" style="height: 370px; width:390px; ">

                        <div class="container" style="    padding-top: 10px;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="women-item-carousel">
                                        <div class="owl-women-item owl-carousel button-container">
                                            @foreach($gallery as $image)
                                            @if($image->product_gallery_id == $product->id )
                                            <?php $product_images = json_decode($image->product_gallery_image); ?>
                                            <div class="item">
                                                <div class="thumb">
                                                    <button class="product-image-thumb active">

                                                        <img src="{{asset('uploads/'.$product_images[0])}}" alt="" style="height: 150px; width:170px;">
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="item">
                                                <div class="thumb">
                                                    <button class="product-image-thumb">

                                                        <img src="{{asset('uploads/'.$product_images[1])}}" style="height: 150px; width:170px;" alt="">
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="item">
                                                <div class="thumb">
                                                    <button class="product-image-thumb">
                                                        <img src="{{asset('uploads/'.$product_images[2])}}" style="height: 150px; width:170px;" alt="">
                                                    </button>
                                                </div>

                                            </div>


                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
                <div class="col-lg-5">
                    <div class="product_description">
                        <!-- <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                                    <li class="breadcrumb-item active">Accessories</li>
                                </ol>
                            </nav> -->
                        <div class="product_name">
                            <b> {{$product->product_name}}</b>
                            <p> {{$product->product_description}}</p>

                        </div>
                        <div class="product-rating">
                            <span class="badge badge-success"><i class="fa fa-star"></i> 4.5 Star</span>
                            <span class="rating-review">35 Ratings & 45 Reviews</span>
                        </div>
                        <div>
                            <span class="product_price">₹ {{$product->product_price-$product->product_price/10}}</span>
                            <strike class="product_discount"> <span style='color:black'>₹ {{$product->product_price}}<span>
                            </strike>
                        </div>
                        <div> <span class="product_saved">You Saved:</span> <span style='color:black'>₹ {{$product->product_price/10}}<span> </div>
                        <hr class="singleline">
                        <div> <span class="product_info">
                                {{$product->product_description}}
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="br-dashed">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-3"> <img src="https://img.icons8.com/color/48/000000/price-tag.png"> </div>
                                            <div class="col-md-9 col-xs-9">
                                                <div class="pr-info"> <span class="break-all">Get 5% instant discount + 10X rewards @ RENTOPC</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7"> </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-xs-6" style="margin-left: 15px;">
                                    <span class="product_options"> {{$product->product_description}}</span><br>

                                </div>
                                <div class="col-xs-6" style="margin-left: 55px;">
                                    <span class="product_options"> {{$product->product_description}}</span><br>

                                </div>
                            </div>
                        </div>
                        <hr class="singleline">
                        <div class="order_info d-flex flex-row">

                        </div>
                        <!-- Add To Cart Start -->
                        <div class="row">

                            <div class="col-xs-4" style=" margin-right: 5px;   margin-top: -24px;">
                                <form action="{{route('cart.add', $product->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="pid">
                                    <input class="product_quantity" type="number" value="1" name="quantity" style="float: none; margin-top: 30px; margin-right: 5px;">
                                    <button class="btn btn-primary shop-button" style="margin-top: 2px; ">Add to Cart</button>
                                </form>
                            </div>

                            <!-- Add To Cart End -->

                            <!-- Add To Like -->
                            <div class="col-xs-4">

                                <a class="btn btn-inverse-warning btn-fw" href="{{ url('checkout').'/'. $product->id}}" role="button">

                                    BUY
                                </a>
                            </div>

                            <!-- Add To Like end -->
                            <div class="product_fav col-xs-4">
                                <!-- <span class="btn btn-danger my-3">
                                    <i class="bi bi-bell"></i>
                                    <span id="notification_count">0</span>
                                </span> -->

                                @foreach($notify as $test)
                                @if($test->product_id == $product->id)
                                <!-- {{$test->product_id}}teste -->
                                <!-- < ?php print_r($test); die();    ?> -->

                                @if($test->read == 1)
                                <div class="input-group">
                                    <input type="hidden" name="message" id="message" placeholder="Enter Message" class="form-control" value="{{$product->id}}">
                                </div>
                                <button type="submit" id="send_message"> <i class="fas fa-heart" style="color: red;"></i></button>
                            </div>
                            @endif
                            @endif
                            @endforeach
                            <div class="input-group">
                                <input type="hidden" name="message" id="message" placeholder="Enter Message" class="form-control" value="{{$product->id}}">
                            </div>
                            <button type="submit" id="send_message"> <i class="fas fa-heart"></i></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-underline col-lg-12">

        <div class="col-md-12"> <span class=" deal-text">Recommended items</span> </div>
        <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a> </div>
    </div>
    <div class="row">

        @foreach($item as $product)
        <div class="col-md-3 padding-0">

            <div class="bbb_combo">
                <div class="bbb_combo_image">
                    <a href="{{ url('e_commerce').'/'. $product->id  }}">
                        <img class="bbb_combo_image" src="{{asset('uploads/'.$product->product_image)}}" alt="">
                    </a>
                </div>
                <div class="d-flex flex-row justify-content-start">
                    <strike style="color:red;">
                        <span class="fs-10" style="color:black;">₹ {{$product->product_price}}<span> </span></span>
                    </strike>
                    <span class="ml-auto"><i class="fa fa-star p-rating">

                        </i><i class="fa fa-star p-rating"></i>
                        <i class="fa fa-star p-rating"></i>
                        <i class="fa fa-star p-rating"></i>
                    </span>
                </div>
                <div class="d-flex flex-row justify-content-start" style=" margin-bottom: 13px; "> <span style="margin-top: -4px;">save:₹{{$product->product_price/10}}</span> <span class="ml-auto fs-10">23 Reviews</span> </div>
                <span>{{$product->product_name}}</span>
            </div>
            <div class="col-xs-12" style="margin-left: 36px;">
                <div class="boxo-pricing-items">
                    <div class="combo-pricing-item"> <span class="items_text">Total</span> <span class="combo_item_price">₹{{$product->product_price-$product->product_price/10}}.00</span> </div>
                    <div class="add-both-cart-button">
                        <form action="{{route('cart.add', $product->id)}}" method="post">

                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="pid">
                            <input type="hidden" value="{{ $product->category }}" name="category">
                            <input type="hidden" value="1" name="quantity">
                            <div class="mt-4 ">
                                <!-- <a class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i></a> -->
                                <button class="btn btn-primary shop-button">Add to Cart</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
        @endforeach

    </div>

</div>
</div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>


@endsection