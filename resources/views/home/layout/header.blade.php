<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="/" class="logo">
                        <img src="{{asset('assets1/images/logo.png')}}">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="/" class="active">Home</a></li>
                        <li class="scroll-to-section"><a href="product?search=1">Men's</a>
                        </li>
                        <li class="scroll-to-section"><a href="product?search=2">Women's</a></li>
                        <!-- <li class="scroll-to-section"><a href="product_kids">Kid's</a></li> -->
                        <li class="submenu">
                            <a href="javascript:;">Kid's</a>
                            <ul>
                                <li><a href="product?search=3">Kid's Girl</a></li>
                                <li><a href="product?search=4">Kid's Boy</a></li>
                                <!-- <li><a href="single-product.html">Single Product</a></li> -->
                                <!-- <li><a href="contact.html">Contact Us</a></li> -->
                            </ul>
                        </li>
                        <li class="scroll-to-section" style="    padding-top: 5px;">
                            <a href="clist"><img src="{{asset('assets1/images/shopping-cart.png')}}" alt="" style="height: 30px; width:25px"></a>

                        </li>
                        <span><?php
                                echo  $categories = App\models\Cart::all()->count()

                                ?></span>
                        <li>

                        </li>
                        <li>
                        </li>
                        <li class="submenu">

                            <a href="javascript:;"><img src="{{asset('assets1/images/profile.png')}}" style="height: 30px; width:30px;"></a>
                            <ul>
                                <li><a href="#">Logout</a></li>
                                <li><a href="#">Sign In</a></li>
                                <!-- <li><a href="#">Features Page 3</a></li>
                                <li><a rel="nofollow" href="https://templatemo.com/page/4" target="_blank">Template Page 4</a></li> -->
                            </ul>
                            <!-- < ?php if (Auth::check()) {   ?> -->
                                <!-- @if(Auth::user()) -->
                                {{Auth::user()->name}}
                                <!-- @endif -->
                            <!-- < ?php } ?> -->
                        </li>


                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>