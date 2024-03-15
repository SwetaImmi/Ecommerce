@extends('home.layout.app')
@section('content')

<!-- ***** Main Banner Area Start ***** -->
<div class="main-banner" id="top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content">
                    <div class="thumb">
                        <div class="inner-content">
                            <h4>We Are Hexashop</h4>
                            <span>Awesome, clean &amp; creative HTML5 Template</span>
                            <div class="main-border-button">
                                <a href="#">Purchase Now!</a>
                            </div>
                        </div>
                        @foreach($banner as $items)
                        @if($items->status == 1)
                        <img src="{{asset('banners/'.$items->main_banner_image)}}" alt="">
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="right-first-image">
                                <div class="thumb">
                                    @foreach($banner as $items)
                                    @if($items->status == 1)
                                    <div class="inner-content">
                                        <h4>Women</h4>
                                        <span>{{$items->first_banner_content}}</span>
                                    </div>
                                    <div class="hover-content">
                                        <div class="inner">
                                            <h4>Women</h4>
                                            <p>{{$items->first_banner_content}}</p>
                                            <div class="main-border-button">
                                                <a href="#">Discover More</a>
                                            </div>
                                        </div>
                                    </div>

                                    <img src="{{asset('banners/'.$items->first_banner_image)}}" alt="" style="width: 484px; height:296px;">
                                    @endif
                                    @endforeach
                                    <!-- <img src="assets1/images/baner-right-image-01.jpg"> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-first-image">
                                <div class="thumb">
                                    <div class="inner-content">
                                        <h4>Men</h4>
                                        <span>Best Clothes For Men</span>
                                    </div>
                                    <div class="hover-content">
                                        <div class="inner">
                                            <h4>Men</h4>
                                            <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                                            <div class="main-border-button">
                                                <a href="#">Discover More</a>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($banner as $items)
                                    @if($items->status == 1)
                                    <img src="{{asset('banners/'.$items->second_banner_image)}}" alt="" style="width: 484px; height:296px;">
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-first-image">
                                <div class="thumb">
                                    <div class="inner-content">
                                        <h4>Kids</h4>
                                        <span>Best Clothes For Kids</span>
                                    </div>
                                    <div class="hover-content">
                                        <div class="inner">
                                            <h4>Kids</h4>
                                            <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                                            <div class="main-border-button">
                                                <a href="#">Discover More</a>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($banner as $items)
                                    @if($items->status == 1)
                                    <img src="{{asset('banners/'.$items->third_banner_image)}}" alt="" style="width: 484px; height:296px;">
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-first-image">
                                <div class="thumb">
                                    <div class="inner-content">
                                        <h4>Accessories</h4>
                                        <span>Best Trend Accessories</span>
                                    </div>
                                    <div class="hover-content">
                                        <div class="inner">
                                            <h4>Accessories</h4>
                                            <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                                            <div class="main-border-button">
                                                <a href="#">Discover More</a>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($banner as $items)
                                    @if($items->status == 1)
                                    <img src="{{asset('banners/'.$items->last_banner_image)}}" alt="" style="width: 484px; height:296px;">
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->

<!-- ***** Men Area Starts ***** -->
@include('home.dash.men')

<!-- ***** Men Area Ends ***** -->

<!-- ***** Women Area Starts ***** -->
@include('home.dash.women')
<!-- ***** Women Area Ends ***** -->

<!-- ***** Kids Area Starts ***** -->
@include('home.dash.kid')
<!-- ***** Kids Area Ends ***** -->

<!-- ***** Explore Area Starts ***** -->

@include('home.dash.explore')
<!-- ***** Explore Area Ends ***** -->

<!-- ***** Social Area Starts ***** -->

@include('home.dash.social')
<!-- ***** Social Area Ends ***** -->

<!-- ***** Subscribe Area Starts ***** -->
@include('home.dash.subscribe')
<!-- ***** Subscribe Area Ends ***** -->
@endsection