@extends('site.layouts.default')
{{--imtoantran--}}
@section("topa")
    <!-- banner -->
    <div class="row margin-top-10 margin-bottom-10">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="banner-top">
                <img src="{{asset("upload/media_user/1/banner-1.png")}}" class="img-responsive" alt="Image">
            </div>
        </div>
    </div>
    <!-- banner end -->
@stop


@section("topb")
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">


            <div id="slider1_container" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="position: relative; top: 0px; left: 0px; width:100%; height: 515px; background: #191919; overflow: hidden;">

                <!-- Loading Screen -->
                <header class="row header-location">
                    <div class="col-md-10 ">
                        <h1>{{$location->name}} <i class="icon-ok-circled-2"></i> <i class="icon-help-circled-1"></i> </h1>
                        <ul class="list-unstyled list-inline ul-list-rating">
                            <li><i class="icon-star-filled"></i></li>
                            <li><i class="icon-star-filled"></i></li>
                            <li><i class="icon-star-filled"></i></li>
                            <li><i class="icon-star-1"></i></li>
                            <li><i class="icon-star-1"></i></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <div class="g-plusone" data-size="medium"></div>
                        <div class="fb-like" data-send="true" data-width="450" data-show-faces="true">
                        </div>

                    </div>
                </header>

                <!-- Slides Container -->
                <section u="slides" class="slider-location" style="cursor: move; position: absolute; padding: 15px 15px 15px; top: 0px; width: 530px; height: 426px; overflow: hidden;">
                    @foreach($location->album()->get() as $image)
                    <div>
                        <img u="image" class="img-item-slider img-responsive" src="{{asset($image->getMetaKey("url"))}}" />
                        <img u="thumb" src="{{asset($image->thumbnail())}}" />
                    </div>
                        @endforeach
                </section>

                <!-- Arrow Navigator Skin Begin -->

                <!-- Arrow Left -->
								<span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 158px; left: 15px;">
								</span>
                <!-- Arrow Right -->
								<span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 158px; right: 15px">
								</span>
                <!-- Arrow Left -->
								<div style="position:absolute;text-transform:uppercase;font-weight: bold; height: 50px; bottom: 80px; left: 15px;">
                                    <button class="btn text-primary do-post-review" type="submit">Viết bình luận <i class="icon-edit"></i></button>
								</div>
                <!-- Arrow Right -->
								<span style="position:absolute;text-transform:uppercase;font-weight: bold; height: 50px; bottom: 80px; right: 15px">
                                    <button class="btn text-primary do-upload-image" type="submit">Đăng hình <i class="icon-camera"></i></button>
								</span>
                <!-- Arrow Navigator Skin End -->

                <!-- Thumbnail Navigator Skin Begin -->
                <div u="thumbnavigator" class="jssort01" style="position: absolute; width: 800px; height: 100px; left:0px; bottom: 0px;">
                    <!-- Thumbnail Item Skin Begin -->
                    <style>

                    </style>
                    <div u="slides" style="cursor: move;">
                        <div u="prototype" class="p" style="position: absolute; width: 72px; height: 72px; top: 0; left: 0;">
                            <div class=w>
                                <div u="thumbnailtemplate" style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;">
                                </div>
                            </div>
                            <div class=c>
                            </div>
                        </div>
                    </div>
                    <!-- Thumbnail Item Skin End -->
                </div>
                <!-- Thumbnail Navigator Skin End -->

            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 padding-top-15">
            <div class="location-information">
                <div>
                    <p class="title">
                        <span class="icon-tag-1"></span>
                        <span class="text-primary">Nhà hàng</span>
                    </p>
                    <p><span class="icon-home"></span>{{$location->address_detail}} {{$location->ward->name}} {{$location->district->name}} {{$location->province->name}}</p>
                    <p class="icon-phone">(+84) {{$location->phone}}</p>
                    <p class="icon-mobile">(+84) {{$location->telphone}}</p>
                    <p><span class="icon-globe"></span> {{$location->website}}</p>
                </div>
                <div>
                    <p class="title">
                        <span class="icon-clock"></span>
                        <span class="text-primary">Thời gian hoạt động</span>
                    </p>
                    <p>- Thứ 2 - thứ 6: 08 AM - 11 PM</p>
                    <p>- Thứ 7 - CN: 07 AM - 11 PM</p>
                </div>
                <div>
                    <p class="title">
                        <span class="icon-money"></span>
                        <span class="text-primary">Giá trung bình</span><small> 75 000đ - 350 000đ </small>
                    </p>

                </div>
                <div class="bg-primary row none-margin">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-none-padding location-activitie">
                        Location activities
                        <div class="col-md-6 ">
                            <span class="icon-heart icon-border-square" id="do-like"></span>
                            <p class="like-count">{{$location->userAction()->whereActionType("like")->count()}}</p>
                        </div>

                        <div class="col-md-6">
                            <span class="icon-location icon-border-square" id="do-checkin"></span>
                            <p class="chekin-count">{{$location->userAction()->whereActionType("checkin")->count()}}</p>
                        </div>
                        <div class="col-md-6">
                            <span class="icon-star icon-border-square"></span>
                            <p>{{$location->reviews()->count()}}</p>
                        </div>
                        <div class="col-md-6">

                            <i class="icon-star-filled icon-border-square"></i>
                            <p>15</p>
                        </div>


                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-none-padding portlet-body">
                        <div id="gmap_marker" class="gmaps col-xs-12 col-sm-12 col-md-12 col-lg-12 gmaps-location">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop

@section("content")
    <div class="row place">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <!-- left -->
            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified location-navigation" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">Review</a></li>
                    <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Cộng đồng</a></li>
                    <li role="presentation" class=""><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false">Thành viên</a></li>
                    <li role="presentation" class=""><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">Sự kiện</a></li>
                    <li role="presentation" class=""><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">Hình ảnh</a></li>
                    <li role="presentation" class=""><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">Thực đơn</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">

                        @foreach($location->reviews()->orderBy("created_at","DESC")->get() as $review)
                        <div class="reviews row">
                            <div class="media">
                                <a href="#" class="pull-left">
                                    <img src="../../assets/frontend/pages/img/people/img4-small.jpg" alt="" class="media-object">
                                </a>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <div class="col-sm-6">
                                            <div class="row"><a href="#"><strong>{{$review->author->username}} </strong></a></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="pull-right">

                                                <ul class="list-unstyled list-inline ul-list-rating">
                                                    <li><i class="icon-star-filled"></i></li>
                                                    <li><i class="icon-star-filled"></i></li>
                                                    <li><i class="icon-star-filled"></i></li>
                                                    <li><i class="icon-star-1"></i></li>
                                                    <li><i class="icon-star-1"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="col-lg-6">
                                            <div>Đã đánh giá địa điểm</div>
                                            <div><small><i>Cách đây 3 giờ</i></small></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <small class="pull-right">Số người 5+ | Chi phí 2.600.000đ+ | Sẽ quay lại có thể</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review-content">
                                <div>
                                    <p class="title">Ngon nhưng không rẻ</p>
                                    <p class="content">Chất lượng từng món ăn rất ngon và hợp khẩu vị, phục vụ tận tình và chu đáo, không gian thoáng và sạch sẽ. Cảm thấy tiện lợi và hài lòng. Tuy nhiên giá cả khá cao và phù hợp một đối tượng khác hàng nhất định
                                    </p>
                                </div>
                            </div>
                            <!-- hinh anh -->
                            <div class="">
                                <div class="col-md-2 col-sm-4 gallery-item">
                                    <a data-rel="fancybox-button" title="Project Name" href="../../assets/frontend/pages/img/works/img1.jpg" class="fancybox-button">
                                        <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                                        <div class="zoomix"><i class="fa fa-search"></i></div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-sm-4 gallery-item">
                                    <a data-rel="fancybox-button" title="Project Name" href="../../assets/frontend/pages/img/works/img1.jpg" class="fancybox-button">
                                        <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                                        <div class="zoomix"><i class="fa fa-search"></i></div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-sm-4 gallery-item">
                                    <a data-rel="fancybox-button" title="Project Name" href="../../assets/frontend/pages/img/works/img1.jpg" class="fancybox-button">
                                        <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                                        <div class="zoomix"><i class="fa fa-search"></i></div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-sm-4 gallery-item">
                                    <a data-rel="fancybox-button" title="Project Name" href="../../assets/frontend/pages/img/works/img1.jpg" class="fancybox-button">
                                        <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                                        <div class="zoomix"><i class="fa fa-search"></i></div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-sm-4 gallery-item">
                                    <a data-rel="fancybox-button" title="Project Name" href="../../assets/frontend/pages/img/works/img1.jpg" class="fancybox-button">
                                        <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                                        <div class="zoomix"><i class="fa fa-search"></i></div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-sm-4 gallery-item">
                                    <a data-rel="fancybox-button" title="Project Name" href="../../assets/frontend/pages/img/works/img1.jpg" class="fancybox-button">
                                        <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                                        <div class="zoomix"><i class="fa fa-search"></i></div>
                                    </a>
                                </div>
                            </div>
                            <!-- hinh anh -->
                            <!-- thao luan,like,dislike,report -->
                            <div class="col-md-12 review-action padding-left-0">
                                <a href="#"><i class="icon-edit"></i>Thảo luận</a>
                                <a href="#"><i class="icon-thumbs-up"></i>Thích <span>0</span></a>
                                <a href="#"><i class="icon-thumbs-down"></i> <span>0</span></a>
                                <a href="#"><i class="icon-block"></i>Báo tin xấu</a>
                                <a href="#" class="pull-right"><i>Xem thêm</i></a>
                            </div>
                            <!-- thao luan,like,dislike,report end-->

                        </div>
                        @endforeach

                        <div class="paging">
                            <ul class="pagination pagination-large">
                                <li><a href="#">«</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">»</a></li>
                            </ul>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">...</div>
                    <div role="tabpanel" class="tab-pane" id="messages">...</div>
                    <div role="tabpanel" class="tab-pane" id="settings"></div>
                </div>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <!-- right -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bg-grey ultility">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title text-primary">
                        Tiện ích
                    </div>
                    @foreach($location->utility()->get() as $utility)
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ultility-item">
                            <i class="icon-check"></i> <strong>{{$utility->name}}</strong>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 banner-right">
                <div class="row">
                    <img src="http://trentarthur.ca/wp-content/uploads/2012/11/Foods.jpg" class="img-responsive" alt="Image">
                </div>
                <div class="row">
                    <img src="http://trentarthur.ca/wp-content/uploads/2012/11/Foods.jpg" class="img-responsive" alt="Image">
                </div>

            </div>


            <!-- right end -->
        </div>
    </div>
    @stop


@section("bottoma")
    <!-- dia diem lan can -->
    <div class="row location">
        <div class="col-lg-12">
            <div class="container-fluid bg-primary">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 padding-top-10">
                            <div>Địa điểm lân cận</div>
                            <a href="#" class="show-more">&gt;&gt;&gt;Xem tất cả</a>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 bg-primary location-item">
                            <div class="location-info">
                                <a href="#">
                                    <img class="full-width" src="img-data-demo/monan-1.jpg" alt="Image">
                                    <section class="location-description">
                                        <strong>Bánh canh, bún mắm Đường Ray</strong>
                                        <p><small>123 Lê Văn Sỹ, P10, Q Tân Bình.</small></p>
                                    </section>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 bg-primary location-item">
                            <div class="location-info">
                                <a href="#">
                                    <img class="full-width" src="img-data-demo/monan-1.jpg" alt="Image">
                                    <section class="location-description">
                                        <strong>Bánh canh, bún mắm Đường Ray</strong>
                                        <p><small>123 Lê Văn Sỹ, P10, Q Tân Bình.</small></p>
                                    </section>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 bg-primary location-item">
                            <div class="location-info">
                                <a href="#">
                                    <img class="full-width" src="img-data-demo/monan-1.jpg" alt="Image">
                                    <section class="location-description">
                                        <strong>Bánh canh, bún mắm Đường Ray</strong>
                                        <p><small>123 Lê Văn Sỹ, P10, Q Tân Bình.</small></p>
                                    </section>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 bg-primary location-item">
                            <div class="location-info">
                                <a href="#">
                                    <img class="full-width" src="img-data-demo/monan-1.jpg" alt="Image">
                                    <section class="location-description">
                                        <strong>Bánh canh, bún mắm Đường Ray</strong>
                                        <p><small>123 Lê Văn Sỹ, P10, Q Tân Bình.</small></p>
                                    </section>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 bg-primary location-item">
                            <div class="location-info">
                                <a href="#">
                                    <img class="full-width" src="img-data-demo/monan-1.jpg" alt="Image">
                                    <section class="location-description">
                                        <strong>Bánh canh, bún mắm Đường Ray</strong>
                                        <p><small>123 Lê Văn Sỹ, P10, Q Tân Bình.</small></p>
                                    </section>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 bg-primary location-item">
                            <div class="location-info">
                                <a href="#">
                                    <img class="full-width" src="img-data-demo/monan-1.jpg" alt="Image">
                                    <section class="location-description">
                                        <strong>Bánh canh, bún mắm Đường Ray</strong>
                                        <p><small>123 Lê Văn Sỹ, P10, Q Tân Bình.</small></p>
                                    </section>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- dia diem lan can end -->
    @stop

@section("bottomb")
    <!-- bai viet noi bat -->
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-lg-3 gallery-item">
            <a data-rel="fancybox-button" title="Project Name" href="../../assets/frontend/pages/img/works/img1.jpg" class="fancybox-button">
                <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                <div class="zoomix"><i class="icon-cancel-circled2"></i></div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-3 gallery-item">
            <a data-rel="fancybox-button" title="Project Name" href="../../assets/frontend/pages/img/works/img1.jpg" class="fancybox-button">
                <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                <div class="zoomix"><i class="icon-cancel-circled2"></i></div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-3 gallery-item">
            <a data-rel="fancybox-button" title="Project Name" href="../../assets/frontend/pages/img/works/img1.jpg" class="fancybox-button">
                <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                <div class="zoomix"><i class="icon-cancel-circled2"></i></div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-3 gallery-item">
            <a data-rel="fancybox-button" title="Project Name" href="../../assets/frontend/pages/img/works/img1.jpg" class="fancybox-button">
                <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                <div class="zoomix"><i class="icon-cancel-circled2"></i></div>
            </a>
        </div>
    </div>
    <!-- bai viet noi bat end -->
@stop


@section("styles")
    <!-- imtoantran  -->
    <link href="{{asset("assets/global/plugins/fancybox/source/jquery.fancybox.css")}}" rel="stylesheet">
    <link href="{{asset("assets/global/css/plugins.css")}}" rel="stylesheet">
    <link href="{{asset("assets/frontend/pages/css/gallery.css")}}" rel="stylesheet">
    <!-- imtoantran -->
@stop

@section("scripts")
    <!-- imtoantran -->
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

    <script src="{{asset("assets/global/plugins/gmaps/gmaps.min.js")}}" type="text/javascript"></script>


    <!-- imtoantran -->
    <script src="{{asset("assets/global/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/frontend/layout/scripts/back-to-top.js")}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset("assets/global/plugins/jssor-slider/js/jssor.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/global/plugins/jssor-slider/js/jssor.slider.js")}}"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <!-- imtoantran -->
{{--    <script src="{{asset("assets/global/plugins/fancybox/source/jquery.fancybox.pack.js")}}" type="text/javascript"></script>--}}
    <!-- imtoantran -->
    <!-- pop up -->
    <!-- END LayerSlider -->

    <script src="{{asset("assets/frontend/layout/scripts/layout.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/global/scripts/maps-google.js")}}" type="text/javascript"></script>
    <script src="https://apis.google.com/js/platform.js" async defer>
        {lang: 'vi'}
    </script>
    <script>
        jQuery(document).ready(
                function(){
                    setTimeout(function(){
                        Layout.initMapLocation();
                        Layout.initSliderLocation();
                    },1000);
                    /* imtoantran do like */
                    $("#do-like").click(function(e){
                        var like_btn = $(this);
                        $(this).attr('disabled',true);
                        $.ajax({
                            type:"post",
                            url:"{{URL::to("location/like")}}",
                            data:{id:"{{$location->id}}"},
                            dataType:"json",
                            success:function(response){
                                $(".like-count").text(response['totalFavourites']);
                                if(response['canLike']){

                                }
                                like_btn.attr('disabled',false);
                            }
                        });
                    });
                    /* imtoantran do like */
                    /* do checkin start */
                    $("#do-checkin").click(function(e){
                        var checkin_btn = $(this);
                        checkin_btn.attr('disabled',true);
                        $.ajax({
                            type:"post",
                            url:"{{URL::to("location/checkin")}}",
                            data:{id:"{{$location->id}}"},
                            dataType:"json",
                            success:function(response){
                                if(response['success']){
                                    $(".checkin-count").text(response['totalCheckedIn']);
                                }else{
                                    alert(response['message']);
                                }
                                checkin_btn.attr('disabled',false);
                            }
                        });
                    });
                    /* do checkin end */
                    /* load reviews start */
                    $.ajax({url:'',completed:function(){}});
                    /* load reviews end */
                    /* viet review start*/
                    $(".do-post-review").click(function(){
                        
                    });
                    /* viet review end */
                }
        );
    </script>
    @stop
    {{--imtoantran--}}