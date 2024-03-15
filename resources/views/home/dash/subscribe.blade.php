<div class="subscribe">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-heading">
                    <h2>By Subscribing To Our Newsletter You Can Get 30% Off</h2>
                    <span>Details to details is what makes Hexashop different from the other themes.</span>
                </div>
                <form id="subscribe" action="subscription_post" method="post">
                    @csrf
                    <div class="row">
                        @if(Auth::user()== NULL)
                        <div class="col-lg-5">
                            <fieldset>
                                <input type="text" id="name" placeholder="Your Name">
                            </fieldset>
                        </div>
                        <div class="col-lg-5">
                            <fieldset>
                                <input type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address">
                            </fieldset>
                        </div>
                        @else
                        <div class="col-lg-5">
                            <fieldset>
                                <input name="name" type="text" id="name" placeholder="Your Name" value="{{Auth::user()->name}}">
                            </fieldset>
                        </div>
                        <div class="col-lg-5">
                            <fieldset>
                                <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address" value="{{Auth::user()->email}}">
                            </fieldset>
                        </div>
                        @endif
                        <div class="col-lg-2">
                            <fieldset>
                                <button type="submit" id="form-submit" class="main-dark-button"><i class="fa fa-paper-plane"></i></button>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-6">
                        <ul>
                            <li>Store Location:<br><span>Sunny Isles Beach, FL 33160, United States</span></li>
                            <li>Phone:<br><span>010-020-0340</span></li>
                            <li>Office Location:<br><span>North Miami Beach</span></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul>
                            <li>Work Hours:<br><span>07:30 AM - 9:30 PM Daily</span></li>
                            <li>Email:<br><span>info@company.com</span></li>
                            <li>Social Media:<br><span><a href="#">Facebook</a>, <a href="#">Instagram</a>, <a href="#">Behance</a>, <a href="#">Linkedin</a></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>