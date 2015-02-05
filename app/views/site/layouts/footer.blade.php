<div class="pre-footer">
    <div class="container">
        <div class="row">
            <!-- BEGIN BOTTOM ABOUT BLOCK -->
            <div class="col-md-3 col-sm-6 pre-footer-col pre-footer-col1 ">
                {{--<h2>About us</h2>--}}
                <img  src="{{asset("assets/frontend/layout/img/logo.png")}}" width="125px" height="50px"/>
                <ul class="list-unstyled list-inline">
                    <li><i class="icon-play"></i></li>
                    <li><i class="icon-facebook-1"></i></li>
                    <li><i class="icon-twitter"></i></li>
                    <li><i class="icon-linkedin"></i></li>
                    <li><i class="icon-gplus"></i></li>
                    <li><i class="icon-skype"></i></li>
                    <li><i class="icon-pinterest"></i></li>
                </ul>

            </div>
            <!-- END BOTTOM ABOUT BLOCK -->

            <!-- BEGIN BOTTOM CONTACTS -->
            <div class="col-md-3 col-sm-6 pre-footer-col pre-footer-col2">
                <h2 class="choidau-font">LINK NHANH</h2>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="icon-right-open-1"></i> Giới Thiệu</a></li>
                            <li><a href="#"><i class="icon-right-open-1"></i> Trợ Giúp</a></li>
                            <li><a href="#"><i class="icon-right-open-1"></i> Gióp Ý</a></li>
                            <li><a href="#"><i class="icon-right-open-1"></i> Liên Hệ</a></li>
                        </ul></div>
                    <div class="col-md-6 col-sm-6 col-xs-0"></div>
                </div>



            </div>
            <!-- END BOTTOM CONTACTS -->

            <!-- BEGIN TWITTER BLOCK -->
            <div class="col-md-3 col-sm-6 pre-footer-col pre-footer-col3" data-twttr-id="twttr-sandbox-0">
                <h2>MOBILE APP</h2>
                <ul class="list-unstyled">
                    <li><img width="120px" height="40px" src="../../assets/frontend/layout/img/payments/app_store_icon.png"/></li>
                    <li><img width="120px" height="40px" src="../../assets/frontend/layout/img/payments/googleplay-app-store.png"/></li>
                    <li><img width="120px" height="40px" src="../../assets/frontend/layout/img/payments/windows store.jpg"/></li>
                </ul>

            </div>

            <div class="col-md-3 col-sm-6 pre-footer-col pre-footer-col4" data-twttr-id="twttr-sandbox-0">
                <h2>COUNTER</h2>
                <ul class="list-unstyled">
                    <li><i class="icon-location-outline"></i>&nbsp; {{number_format(Location::count(),0, ".",".")}} địa điểm</li>
                    <li><i class="icon-group"></i>&nbsp; {{number_format(User::count(),0, ".",".")}} user</li>
                    <li><i class="icon-picture"></i>&nbsp; {{number_format(Post::count(),0, ".",".")}} hình ảnh</li>
                    <li><i class="icon-check"></i>&nbsp; {{number_format(DB::table("location_user")->whereActionType("checkin")->count(),0, ".",".")}} check in</li>

                </ul>

            </div>
            <!-- END TWITTER BLOCK -->
        </div>
    </div>
</div>
<div class="footer style-green">
    <div class="container">
        <div class="row">
            <!-- BEGIN COPYRIGHT -->
            <div class="col-md-6 col-sm-6 pull-left">
                2015 © ChơiĐâu.net  UI.Designer By Suntory .  ALL Rights Reserved. <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
            </div>
            <div class="col-md-6 col-sm-6 pull-right text-right">
                <a href="#">Về chúng tôi</a> | <a href="#">Nhà đầu tư</a>| <a href="#">Liên hệ</a>
            </div>
            <!-- END COPYRIGHT -->
            <!-- BEGIN PAYMENTS -->
            <div class="col-md-6 col-sm-6">

            </div>
            <!-- END PAYMENTS -->
        </div>
    </div>
</div>
@include('site.partials.user.login_popup')
@include('site.partials.media_browser')