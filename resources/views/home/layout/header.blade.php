<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">

                    <!-- ***** Logo Start ***** -->
                    <a href="/" class="logo" style="margin-left: -150px; margin-top: 10px;">
                        <img src="{{asset('assets1/images/logo.png')}}">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="/" class="active">Home</a></li>
                        <li class="scroll-to-section"><a href="{{url('product?search=1')}}">Men's</a>
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
                        <li class="scroll-to-section" style="padding-top: 5px;">
                            <a href="{{url('wishlist')}}">
                                <i class="fas fa-heart"></i>
                            </a>

                        </li>
                        <li class="scroll-to-section" style="padding-top: 5px;">
                            <a href="{{url('clist')}}"><img src="{{asset('assets1/images/shopping-cart.png')}}" alt="" style="height: 30px; width:25px"></a>

                        </li>
                        <span>
                            @if(Auth::user() == NULL)
                            <?php $cart = json_decode(request()->cookie('cart'), true) ?? [];
                            ?>
                            @if(isset($cart))
                            <p> {{ count($cart) }}</p>
                            @endif
                            @else
                            @if(Auth::check())
                            <?php
                            $count = App\models\Cart::where('user_id', Auth::id())->count();
                            echo $count;
                            ?>
                            @endif
                            @endif

                        </span>
                        <li>

                        </li>
                        <li>
                        </li>
                        <li class="submenu">
                            <a href="javascript:;"><img src="{{asset('assets1/images/profile.png')}}" style="height: 30px; width:30px;"></a>
                            <ul>
                                @if(Auth::user() != NULL)
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="ti-power-off text-primary"></i>
                                        Logout
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: one;">
                                            @csrf
                                        </form>
                                    </a>
                                    <!-- <a href="{{url('customer_logout')}}">Logout</a> -->
                                </li>
                                @else
                                <li><a href="{{url('signin')}}">Sign In</a></li>
                                @endif
                            </ul>
                        </li>
                        @if(Auth::user())
                            {{Auth::user()->name}}
                            @endif
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->

                </nav>
            </div>
            <!-- alert -->
            @if ($message = Session::get('success'))
            <div id="alert-success" class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
            @endif


            @if ($message = Session::get('error'))
            <div id="alert-success" class="alert alert-danger alert-block">
                <strong>{{ $message }}</strong>
            </div>
            @endif

            <!-- alert -->
        </div>

    </div>
</header>
<script>
    setTimeout(function() {
        document.getElementById('alert-success').style.display = 'none';
    }, 3000); // 5000 milliseconds = 5 seconds
</script>