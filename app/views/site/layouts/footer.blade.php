<?php
$social = Social::orderBy('id','ASC')->whereType('social')->whereStatus(1)->get();
$mobile_app = Social::orderBy('id','ASC')->whereType('mobile-app')->whereStatus(1)->get();

$page_about = Social::whereType('page-about')->whereStatus(1)->first();
$page_investor = Social::whereType('page-investor')->whereStatus(1)->first();

$page_introduce = Social::whereType('page-introduce')->whereStatus(1)->first();
$page_help = Social::whereType('page-help')->whereStatus(1)->first();
$page_comment = Social::whereType('page-comment')->whereStatus(1)->first();

?>
<div class="pre-footer">
    <div class="container">
        <div class="row">
            <!-- BEGIN BOTTOM ABOUT BLOCK -->
            <div class="col-md-3 col-sm-6 pre-footer-col pre-footer-col1 ">
                {{--<h2>About us</h2>--}}
                <img  src="{{asset("assets/frontend/layout/img/logo.png")}}" width="125px" height="50px"/>
                <ul class="list-unstyled list-inline">
                    @if(count($social))
                        @foreach($social as $key=>$val)
                            <li class="tooltips" data-original-title="{{$val->title}}">
                                <a href="@if(empty($val->content)){{'#'}}@else{{$val->content}}@endif" target="_blank">
                                    <i class="icon-{{$val->icon}} white"></i>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <!-- END BOTTOM ABOUT BLOCK -->

            <!-- BEGIN BOTTOM CONTACTS -->
            <div class="col-md-3 col-sm-6 pre-footer-col pre-footer-col2">
                <h2 class="choidau-font">LINK NHANH</h2>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <ul class="list-unstyled">
                            @if(count($page_introduce))
                                <li>
                                    <a href="{{URL::to('page/')}}/@if(!empty($page_introduce->content)){{$page_introduce->content}}-{{Page::whereId($page_introduce->content)->first()->alias}}@else{{'#'}}@endif"><i class="icon-right-open-1"></i> Giới Thiệu</a>
                                </li>
                            @endif
                            @if(count($page_help))
                                <li>
                                    <a href="{{URL::to('page/')}}/@if(!empty($page_help->content)){{$page_help->content}}-{{Page::whereId($page_help->content)->first()->alias}}@else{{'#'}}@endif"><i class="icon-right-open-1"></i> Trợ Giúp</a>
                                </li>
                            @endif
                            @if(count($page_comment))
                                <li>
                                    <a href="{{URL::to('page/')}}/@if(!empty($page_comment->content)){{$page_comment->content}}-{{Page::whereId($page_comment->content)->first()->alias}}@else{{'#'}}@endif"><i class="icon-right-open-1"></i> Gióp Ý</a>
                                </li>
                            @endif
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
                    @if(count($mobile_app))
                        @foreach($mobile_app as $key=>$val)
                            <li class="tooltips" data-original-title="{{$val->title}}">
                                <a href="@if(empty($val->content)){{'#'}}@else{{$val->content}}@endif" target="_blank">
                                    <img width="120px" height="40px" src="{{URL::to($val->icon)}}"/>
                                </a>
                            </li>
                        @endforeach
                    @endif
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
                <!-- about us -->
                @if(count($page_about))
                    <a href="@if(!empty($page_introduce->content)){{URL::to('page/')}}/{{$page_about->content}}-{{Page::whereId($page_about->content)->first()->alias}}@else{{'#'}}@endif">
                        Về chúng tôi
                    </a> |
                @endif

                <!-- investor -->
                @if(count($page_investor))
                    <a href="@if(!empty($page_introduce->content)){{URL::to('page/')}}/{{$page_investor->content}}-{{Page::whereId($page_investor->content)->first()->alias}}@else{{'#'}}@endif">
                        Nhà đầu tư
                    </a> |
                @endif

               <a href="#">Liên hệ</a>

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
<div id="chat-wrapper"></div>