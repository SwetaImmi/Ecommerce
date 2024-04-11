<!-- ***** Kids Area Starts ***** -->
<section class="section" id="kids">
    <div class="container" style="margin-top: -80px;">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Kid's Latest</h2>
                    <span>Details to details is what makes Hexashop different from the other themes.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="kid-item-carousel">
                    <div class="owl-kid-item owl-carousel">
                        @foreach($product as $item )
                        @if($item->category_id == '3'&& '4')
                        <div class="item">

                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                    <li><a href="{{ url('e_commerce').'/'. $item->id  }}"><i class="fa fa-eye"></i></a></li>
                                        <li><a><i class="fa fa-star"></i></a></li>
                                        <li>

                                            <form action="{{ url('add_cart').'/'. $item->id  }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @if(Auth::user() == null)
                                                @else
                                                <input type="hidden" value="{{ Auth()->user()->id }}" name="uid">

                                                @endif
                                                <input type="hidden" value="{{ $item->id }}" name="pid">
                                                <input type="hidden" value="{{ $item->product_name }}" name="product_name">
                                                <input type="hidden" value="{{ $item->product_price }}" name="product_price">
                                                <input type="hidden" value="{{ $item->product_image }}" name="product_image">
                                                <input type="hidden" value="{{ $item->product_id }}" name="category">
                                                <input type="hidden" value="1" name="quantity">
                                                <div class="mt-4">

                                                    <!-- <a class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i></a> -->
                                                    <button class="btn btn-default btn-lg btn-flat"><i class="fa fa-shopping-cart" style=" width: 50px; height: 50px;  background-color: #fff"></i></button>

                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <img src="{{asset('uploads/'.$item->product_image)}}" alt="" style="height: 370px; width:390px;">
                            </div>
                            <div class="down-content">
                                <h4>{{$item->product_name}}</h4>
                                <span>{{$item->product_price}}</span>
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                            </div>


                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Kids Area Ends ***** -->