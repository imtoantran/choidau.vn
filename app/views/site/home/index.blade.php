@extends('site.layouts.default')
@section('topa')
    <!-- BEGIN SLIDER -->
    <section class="page-slider margin-bottom-10">
        <div class="fullwidthbanner-container revolution-slider">
            <div class="fullwidthabnner">
                <ul id="revolutionul">
                    <!-- THE NEW SLIDE -->
                    <li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400"
                        data-thumb="{{asset("assets/frontend/pages/img/revolutionslider/thumbs/thumb2.jpg")}}">
                        <!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
                        <img src="{{asset("assets/frontend/pages/img/revolutionslider/bg9.jpg")}}" alt="">

                        <div class="caption lft slide_title_white slide_item_left"
                             data-x="30"
                             data-y="90"
                             data-speed="400"
                             data-start="1500"
                             data-easing="easeOutExpo">
                            Explore the Power<br><span class="slide_title_white_bold">of Metronic</span>
                        </div>
                        <div class="caption lft slide_subtitle_white slide_item_left"
                             data-x="87"
                             data-y="245"
                             data-speed="400"
                             data-start="2000"
                             data-easing="easeOutExpo">
                            This is what you were looking for
                        </div>
                        <a class="caption lft btn dark slide_btn slide_item_left"
                           href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes"
                           data-x="187"
                           data-y="315"
                           data-speed="400"
                           data-start="3000"
                           data-easing="easeOutExpo">
                            Purchase Now!
                        </a>

                        <div class="caption lfb"
                             data-x="640"
                             data-y="0"
                             data-speed="700"
                             data-start="1000"
                             data-easing="easeOutExpo">
                            <img src="../../assets/frontend/pages/img/revolutionslider/lady.png" alt="Image 1">
                        </div>
                    </li>

                    <!-- THE FIRST SLIDE -->
                    <li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400"
                        data-thumb="{{asset("assets/frontend/pages/img/revolutionslider/thumbs/thumb2.jpg")}}">
                        <!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
                        <img src="{{asset("assets/frontend/pages/img/revolutionslider/bg1.jpg")}}" alt="">

                        <div class="caption lft slide_title slide_item_left"
                             data-x="30"
                             data-y="105"
                             data-speed="400"
                             data-start="1500"
                             data-easing="easeOutExpo">
                            Need a website design?
                        </div>
                        <div class="caption lft slide_subtitle slide_item_left"
                             data-x="30"
                             data-y="180"
                             data-speed="400"
                             data-start="2000"
                             data-easing="easeOutExpo">
                            This is what you were looking for
                        </div>
                        <div class="caption lft slide_desc slide_item_left"
                             data-x="30"
                             data-y="220"
                             data-speed="400"
                             data-start="2500"
                             data-easing="easeOutExpo">
                            Lorem ipsum dolor sit amet, dolore eiusmod<br> quis tempor incididunt. Sed unde omnis iste.
                        </div>
                        <a class="caption lft btn green slide_btn slide_item_left"
                           href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes"
                           data-x="30"
                           data-y="290"
                           data-speed="400"
                           data-start="3000"
                           data-easing="easeOutExpo">
                            Purchase Now!
                        </a>

                        <div class="caption lfb"
                             data-x="640"
                             data-y="55"
                             data-speed="700"
                             data-start="1000"
                             data-easing="easeOutExpo">
                            <img src="../../assets/frontend/pages/img/revolutionslider/man-winner.png" alt="Image 1">
                        </div>
                    </li>

                    <!-- THE SECOND SLIDE -->
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="300" data-delay="9400"
                        data-thumb="{{asset("assets/frontend/pages/img/revolutionslider/thumbs/thumb2.jpg")}}">
                        <img src="{{asset("assets/frontend/pages/img/revolutionslider/bg2.jpg")}}" alt="">

                        <div class="caption lfl slide_title slide_item_left"
                             data-x="30"
                             data-y="125"
                             data-speed="400"
                             data-start="3500"
                             data-easing="easeOutExpo">
                            Powerfull &amp; Clean
                        </div>
                        <div class="caption lfl slide_subtitle slide_item_left"
                             data-x="30"
                             data-y="200"
                             data-speed="400"
                             data-start="4000"
                             data-easing="easeOutExpo">
                            Responsive Admin &amp; Website Theme
                        </div>
                        <div class="caption lfl slide_desc slide_item_left"
                             data-x="30"
                             data-y="245"
                             data-speed="400"
                             data-start="4500"
                             data-easing="easeOutExpo">
                            Lorem ipsum dolor sit amet, consectetuer elit sed diam<br> nonummy amet euismod dolore.
                        </div>
                        <div class="caption lfr slide_item_right"
                             data-x="635"
                             data-y="105"
                             data-speed="1200"
                             data-start="1500"
                             data-easing="easeOutBack">
                            <img src="../../assets/frontend/pages/img/revolutionslider/mac.png" alt="Image 1">
                        </div>
                        <div class="caption lfr slide_item_right"
                             data-x="580"
                             data-y="245"
                             data-speed="1200"
                             data-start="2000"
                             data-easing="easeOutBack">
                            <img src="../../assets/frontend/pages/img/revolutionslider/ipad.png" alt="Image 1">
                        </div>
                        <div class="caption lfr slide_item_right"
                             data-x="735"
                             data-y="290"
                             data-speed="1200"
                             data-start="2500"
                             data-easing="easeOutBack">
                            <img src="../../assets/frontend/pages/img/revolutionslider/iphone.png" alt="Image 1">
                        </div>
                        <div class="caption lfr slide_item_right"
                             data-x="835"
                             data-y="230"
                             data-speed="1200"
                             data-start="3000"
                             data-easing="easeOutBack">
                            <img src="../../assets/frontend/pages/img/revolutionslider/macbook.png" alt="Image 1">
                        </div>
                        <div class="caption lft slide_item_right"
                             data-x="865"
                             data-y="45"
                             data-speed="500"
                             data-start="5000"
                             data-easing="easeOutBack">
                            <img src="../../assets/frontend/pages/img/revolutionslider/hint1-red.png" id="rev-hint1"
                                 alt="Image 1">
                        </div>
                        <div class="caption lfb slide_item_right"
                             data-x="355"
                             data-y="355"
                             data-speed="500"
                             data-start="5500"
                             data-easing="easeOutBack">
                            <img src="../../assets/frontend/pages/img/revolutionslider/hint2-red.png" id="rev-hint2"
                                 alt="Image 1">
                        </div>
                    </li>
                </ul>
                <div class="tp-bannertimer tp-bottom"></div>
            </div>
        </div>
    </section>
    <!-- END SLIDER -->
@stop

@section('topb')
    <section class="row margin-bottom-10">
        <div class="col-md-9">
            <section class="col-md-4 col-xs-12 col-sm-6 box-post-hot padding-left-0">
                <header>
                    <h1>TOP REVIEW</h1>
                </header>

                <article>
                    @if(!is_null($topReview))
                    <img class="padding-2 img-border-light" src="{{URL::to($topReview->location->avatar)}}"
                         height="100px" width="100px"/>
                    <div class="col-none-padding lab-user-post">
                        <a href="{{$topReview->location->url()}}"><h1>{{$topReview->location->name}}</h1></a>
                        <h2>
                            <a href="{{{$topReview->author->url()}}}">
                                {{$topReview->author->username}}
                            </a>
                        </h2><span>bình luận</span>
                        <time> {{String::showTimeAgo($topReview->updated_at)}}</time>
                    </div>
                    <div class="clearfix"></div>
                    <header class="description" style="position: relative;">
						<span>
							{{String::tidy(Str::limit(strip_tags($topReview->meta_description),120))}}
						</span>
                        @if(strlen(strip_tags($topReview->meta_description)) >= 120)
                            <a class="italic font-12px" href="{{$topReview->location->url()}}">xem thêm</a>
                        @endif
                    </header>
                    @endif
                </article>
            </section>

            <section class="col-md-4 col-xs-12 col-sm-6 box-post-hot padding-left-0">
                <header>
                    <h1>TOP ĐỊA ĐIỂM</h1>
                </header>
                <article>
                    @if(!is_null($topLocation))
                        @if(!empty($topLocation->avatar) && isset($topLocation->avatar))
                            <img class="padding-2 img-border-light" src="{{URL::to($topLocation->avatar)}}" height="100px" width="100px"/>
                        @else
                            <img src="{{URL::to('/assets/global/img/no-image.png')}}" alt=""/>
                        @endif
                        <div class="col-none-padding lab-user-post">
                            <a href="{{$topLocation->url()}}"><h1>{{$topLocation->name}}</h1></a>
                            <h2>
                                <a href="{{{$topLocation->owner->url()}}}">
                                    {{$topLocation->owner->display_name()}}
                                </a>
                            </h2><span>Đã đăng </span>
                            <time>{{String::showTimeAgo($topLocation->updated_at)}} </time>
                        </div>
                        <div class="clearfix"></div>
                        <header class="description" style="position: relative;">
                            <span>
                                {{String::tidy(Str::limit(strip_tags($topLocation->description),120))}}
                            </span>
                            @if(strlen(strip_tags($topLocation->description)) >= 120)
                                <a class="italic font-12px" href="{{$topLocation->url()}}">xem thêm</a>
                            @endif
                        </header>
                    @endif
                </article>

            </section>
            <section class="col-md-4 col-xs-12 col-sm-6 box-post-hot padding-left-0 padding-right-0">
                <header>
                    <h1>Admin Giới thiệu</h1>
                </header>
                <article>
                    @if(isset($topBlog))
                    <img class="padding-2 img-border-light" src="{{empty($topBlog->getFeaturedImage()->thumbnail)? (URL::to('/assets/global/img/no-image.png')) : ($topBlog->getFeaturedImage()->thumbnail)}}" height="100px" width="100px"/>
                    <div class="col-none-padding lab-user-post">
                        <a href="{{{$topBlog->url()}}}"><h1>{{String::tidy($topBlog->title,50)}}</h1></a>

                        <h2>
                            <a href="{{{$topBlog->author->url()}}}">
                                {{$topBlog->author->username}}
                            </a>
                        </h2><span>Đã đăng </span>
                        <time> {{String::showTimeAgo($topBlog->updated_at)}}</time>
                    </div>
                    <div class="clearfix"></div>
                    <header class="description">
						<span class="text-justify">
							{{String::tidy(Str::limit(strip_tags($topBlog->content),120))}}
					  	</span>
                        @if(strlen(strip_tags($topBlog->content)) > 120)
                            <a class="italic font-12px" href="#">xem thêm</a>
                        @endif
                    </header>
                    @endif
                </article>

            </section>
            <div class="col-md-12" style="border-bottom: 2px solid green;margin-top: 5px;"></div>

        </div>
        <section class="col-md-3 col-xs-12 col-sm-6  box-face-hot">
            <div class="clearfix">
                <header>
                    <h1>Choidau.net <i class="icon-group" style="font-size: 20px; color: #fff;"></i></h1>
                </header>
                <article class="col-md-12 col-none-padding">
                    @if(isset($facebook_like_box) && $facebook_like_box->status)
                        <div class="fb-like-box" data-href="{{$facebook_like_box->content}}" data-width="263"
                             data-height="200" data-colorscheme="light" data-show-faces="true" data-header="false"
                             data-stream="false" data-show-border="false"></div>
                    @endif

                </article>
            </div>

        </section>
    </section>
@stop

{{-- Content --}}
@section('content')
    @foreach($categories as $category)
        <p class="title font-16px margin-bottom-0 font-16px margin-bottom-10">
            <i class="icon-location font-16px tooltips" title="Địa điểm"></i> <a href="#"><strong
                        class="text-primary">{{$category->description}}?</strong></a>
        </p>
        <div class="row clearfix home-content-row">
            @foreach($category->location()->orderBy("created_at","desc")->take(3)->get() as $location)
                <?php
                $reviews = null;
                $review = null;
                if ($hasReview = $location->hasReview()) {
                    $reviews = $location->reviews()->orderBy("created_at", "desc");
                    $review = $reviews->first();
                }
                ?>
                <div class="col-md-4 col-xs-12 col-sm-6 home-content-item margin-bottom-20 ">
                    <a href="{{$location->url()}}">
                        <div class="box-product-img-content">
                            @if(!empty($location->avatar) && isset($location->avatar))
                                <img src="{{asset("$location->avatar")}}" width="100%" height="180px"/>
                            @else
                                <img src="{{URL::to('/assets/global/img/no-image.png')}}" alt=""/>
                            @endif
                            <div class="location-description">
                                <p><strong class="title font-14px">{{$location->name}}</strong></p>
                                <small>{{$location->address_detail}}</small>
                            </div>
                            <div class="review-rating">
                                <ul class="list-unstyled list-inline ul-list-rating">
                                    {{--*/ $rCount = $location->rating() /*--}}
                                    @for($i=0;$i<5;$i++)
                                        @if($i<$rCount)
                                            <li><i class="icon-star-filled"></i></li>
                                        @else
                                            <li><i class="icon-star-1"></i></li>
                                        @endif
                                    @endfor
                                </ul>
                            </div>
                            <div class="absolute-top-right bg-primary">
{{--                                <span class="tooltips like-action @if(Auth::check()&&$location->isLiked(Auth::user()->id)) active @endif " data-original-title ='@if(Auth::check()&&$location->isLiked(Auth::user()->id)) Bỏ thích @else thích @endif'--}}
                                <span class="tooltips require-login-items like-action"
                                      data-type="<?php
                                        if(Auth::check()){
                                            if($location->isLiked(Auth::user()->id)){echo 'unlike';}else{echo 'like';}
                                        }else{ echo 'like';}
                                      ?>"
                                      data-location="{{$location->id}}" data-url="{{URL::current()}}"
                                      data-original-title="Thích"
                                      >
                                    <i class="icon-heart @if(Auth::check()) @if($location->isLiked(Auth::user()->id)){{'yellow'}}@endif @endif"></i>
                                </span>

                                <span class="tooltips"  data-original-title = "Chia sẻ" >
                                     <i class="icon-export "></i>
                                </span>
                            </div>
                        </div>
                    </a>

                    <p class="description-item">
                        @if(Str::length($location->description))
                            {{String::tidy(Str::limit($location->description, 90))}}
                            <a class="content-view-more" href="{{$location->url()}}" style="">xem thêm</a>
                        @else
                            <span style="line-height: 46px;" class="text-grey"><i
                                        class="icon-check-empty text-grey"></i> Chưa có mô tả cho địa điểm này.</span>
                        @endif

                    </p>

                    <div class="row box-product-comment">
                        <div class="col-md-8">
                            <div class="row">
                                @if($hasReview)
                                    <img class="img-circle padding-1 img-border-grey"
                                         src="@if($hasReview) {{asset($review->author->avatar)}} @else {{asset("assets/global/img/no-image.png")}} @endif"/>
                                    <a class="font-weight-600" href="{{URL::to($review->author->url())}}">
                                        {{$review->author->username}}
                                    </a>
                                    <p class="italic text-grey font-12px margin-bottom-5">Vừa đánh giá địa điểm</p>
                                @else
                                    <p class="text-grey margin-bottom-0"><i class="icon-check-empty text-grey"></i>Chưa
                                        có bình luận.</p>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <div class="row text-right" style="line-height:40px;">
                                @if($hasReview) <label
                                        style="vertical-align: middle; font-size:12px;">{{date_format($review->created_at,"d-m-Y")}}</label>
                                <i class="icon-clock-1 text-grey font-24px"></i> @endif
                            </div>
                        </div>
                    </div>

                    <div class="row box-product-like">
                        <div class="col-md-10 col-xs-10 col-sm-10">
                            <div class="row box-product-wrapper">
                                @if($location->totalLike())
                                    @foreach($location->whoLiked()->take(3)->get() as $userLiked)
                                        <a data-id="{{$userLiked->id}}" href="{{URL::to($userLiked->url())}}">
                                            {{--<img class="img-circle tooltips" src="{{asset($userLiked->avatar)}}" data-original-title="{{($userLiked->fullname)?$userLiked->fullname:$userLiked->username}}"/>--}}
                                            <img class="img-circle tooltips" src="{{empty($userLiked->avatar)? (URL::to('/assets/global/img/no-image.png')) : (asset($userLiked->avatar))}}" data-original-title="{{($userLiked->fullname)?$userLiked->fullname:$userLiked->username}}"/>
                                        </a>
                                    @endforeach
                                @else
                                    <i class="icon-picture-outline pull-left text-grey font-24px"></i>
                                @endif
                                <p class="quantity-like bg-grey"><span>{{$location->totalLike()}}</span> lượt thích</p>

                            </div>
                        </div>

                        <div class="col-md-2 col-xs-2 col-sm-2 ">
                            <div class="row text-right">
                                <p class="quantity-comment">
                                    @if($hasReview)
                                        {{$reviews->count()}}
                                    @else
                                        0
                                    @endif
                                </p>
                                <i class="icon-comment-2 margin-top-5 text-grey"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="separator"></div>
            </div>
        </div>

    @endforeach

@stop


@section("bottomb")
    <!-- bai viet noi bat -->
    @include("site.blog.featured")
    <!-- bai viet noi bat end -->
@stop

@section('scripts')
    <!-- BEGIN RevolutionSlider -->
    <script src="{{asset("assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js")}}"
            type="text/javascript"></script>
    <script src="{{asset("assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js")}}"
            type="text/javascript"></script>
    <script src="{{asset("assets/frontend/pages/scripts/revo-slider-init.js")}}" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            RevosliderInit.initRevoSlider();
        });

        /* imtoatran like button start */


        $(".like-action").click(function (e) {
            e.preventDefault();
            var self = $(this);

            var type = self.attr('data-type');
            var icon_class = 'icon-heart';
            self.find('i').iconLoad(icon_class);
//            var url = $(this).attr('data-url');

            $(this).login({callback: function(respon_login){
                if(respon_login){
                    var location_id = self.attr('data-location');
                    var action_type = self.attr('data-type');
                    $.ajax({
                        type: "POST",
                        url: URL + "/dia-diem/action",
                        data: {
                            'location_id': location_id,
                            'action_type': action_type
                        },
                        success: function (respon) {
                            if(respon !=-1){
                                var tag_none_img = self.closest('.home-content-item').find('.icon-picture-outline');
                                var tag_img_wrapper = self.closest('.home-content-item').find('.box-product-wrapper');
                                if(action_type == 'like'){
                                    self.closest('.home-content-item').find('.quantity-like span').text(respon);
                                    self.attr('data-type', 'unlike');
                                    self.find('i').addClass('yellow');
                                    if(tag_none_img[0]){
                                        tag_none_img.addClass('hidden');
                                    }

                                    var html = '';
                                    @if(Auth::check())
                                        html += '<a data-id="{{Auth::user()->id}}" href="{{URL::to("/trang-ca-nhan/").Auth::user()->username.'.html'}}">';
                                        html += '<img class="img-circle tooltips" src="@if(empty(Auth::user()->avatar)){{URL::to('/assets/global/img/no-image.png')}}@else{{Auth::user()->avatar}}@endif" data-original-title="{{(Auth::user()->fullname) ? (Auth::user()->fullname):(Auth::user()->username)}}" />';
                                        html += '</a>';
                                    @endif
                                    tag_img_wrapper.prepend(html);
                                    tag_img_wrapper.find('.tooltips').tooltip({  disabled: true });
                                }else{
                                    self.closest('.home-content-item').find('.quantity-like span').text(respon);
                                    self.attr('data-type', 'like');
                                    self.find('i').removeClass('yellow');
                                    if(respon == 0){
                                        tag_img_wrapper.prepend('<i class="icon-picture-outline pull-left text-grey font-24px"></i>');
                                    }

                                    @if(Auth::check())
                                    tag_img_wrapper.find('a').each(function(){
                                        if($(this).attr('data-id') == '{{Auth::user()->id}}'){
                                            $(this).remove();
                                        }
                                    });
                                    @endif

                                }
                            }
                            self.find('i').iconUnload(icon_class);
                        }
                    });
                }else{
                    var cf = confirm('Bạn cần đăng nhập để thực hiện tác vụ này.');
                    if(cf){
                        $('#popup-login').modal('show');
                    }
                    self.find('i').iconUnload(icon_class);
                }
            }});




//            var el = $(this);
//            el.find("i").toggleClass("icon-heart animate-spin icon-spin3");
//            $.ajax({
//                url: URL + "/location/like",
//                data: {id: $(this).attr("data-id")},
//                dataType: "json",
//                type: "post",
//                success: function (response) {
//                    if (response.success) {
//                        el.toggleClass("active");
//                        el.closest(".home-content-item").find(".quantity-like span").text(response.totalFavourites);
//                        if(response.canLike){
//                            el.attr('data-original-title','Thích');
//                        }else{
//                            el.attr('data-original-title','Bỏ thích');
//                        }
//                    }
//                },
//                complete: function () {
//                    el.find("i").toggleClass("icon-heart animate-spin icon-spin3");
//                }
//            });
//            e.preventDefault();
        });
        /* imtoatran like button end */

    </script>
    <!-- END RevolutionSlider -->
@stop

@section('styles')
    <link href="{{asset("assets/global/plugins/slider-revolution-slider/rs-plugin/css/settings.css")}}"
          rel="stylesheet">
@stop
