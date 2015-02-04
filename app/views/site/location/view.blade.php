@extends('site.layouts.default')
{{--imtoantran--}}
@section("topa")
    <!-- banner -->
    <div class="row margin-top-10 margin-bottom-10">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="banner-top text-center">
                <img width="100%" src="{{asset("upload/media_user/1/banner-1.png")}}" class="img-responsive" alt="Image">
            </div>
        </div>
    </div>
    <!-- banner end -->
@stop


@section("topb")


    <div class="row margin-bottom-10">
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
                <section u="slides" class="slider-location" style="cursor: move; position: relative; padding: 15px 15px 15px; top: 0px; width: 530px; height: 426px; overflow: hidden;">
                {{--<section u="slides" class="slider-location" style="cursor: move; position: absolute; top: 0px; overflow: hidden;">--}}
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
                                    <button href="#" class="btn text-primary do-post-review" data-toggle="modal" href="reviewModal" type="submit">Viết bình luận <i class="icon-edit"></i></button>
								</div>
                <!-- Arrow Right -->
								<span style="position:absolute;text-transform:uppercase;font-weight: bold; height: 50px; bottom: 80px; right: 15px">
                                    <button class="btn text-primary do-upload-image" type="submit">Đăng hình <i class="icon-camera"></i></button>
								</span>
                <!-- Arrow Navigator Skin End -->

                <!-- Thumbnail Navigator Skin Begin -->
                <div u="thumbnavigator" class="jssort01" style="position: absolute; width: 800px; height: 100px; left:0px; bottom: 0px;">
                    <!-- Thumbnail Item Skin Begin -->

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
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 padding-left-0">
            <div class="location-information">
                {{--//luuhoabk dia diem --}}
                <div>
                    <?php
                        $address_detail = (isset($location->address_detail))? $location->address_detail : "";
                        $district = (isset($location->district->name))? $location->district->name : "";
                        $province = (isset($location->province->name))? $location->province->name : "";
                    ?>
                    @if(!($address_detail =="" && $district =="" && $province==""))
                        <p class="title">
                            <span class="icon-tag-1"></span>
                            <span class="text-primary">Nhà hàng</span>
                        </p>
                        <p><span class="icon-home"></span>
                            {{$address_detail.' '.$district.' '.$province}}
                        </p>
                    @endif
                    @if(isset($location->phone) && $location->phone != "")
                        <p class="icon-phone">(+84) {{$location->phone}}</p>
                    @endif
                    @if(isset($location->telphone) && $location->telphone != "")
                        <p class="icon-mobile">(+84) {{$location->telphone}}</p>
                    @endif
                    @if(isset($location->website) && $location->website != ""))
                         <p><span class="icon-globe"></span> {{$location->website}}</p>
                    @endif
                </div>

                {{--//luuhoabk thoi gian hoat dong --}}
                @if(isset($location->action_time))
                    <div>
                        <p class="title">
                            <span class="icon-clock"></span>
                            <span class="text-primary">Thời gian hoạt động</span>
                        </p>
                        <?php // hien thoi gian hoat dong theo dang dac biet (gom nhom)
                        $arr = json_decode($location->action_time);
                        $arr1 = array();
                        foreach($arr as $k1=>$v1){
                            array_push($arr1,$v1->time);
                        }
                        $arr1 = array_unique($arr1); // loai bo gia tri trung
                        foreach($arr1 as $k2=>$v2){
                            $thu1 = "";
                            foreach($arr as $k3=>$v3){
                                if($v3->time == $v2){
                                    $thu3 = $v3->thu;
                                    if($thu3 == '8'){$thu3= "CN";}
                                    $thu1 .= $thu3.', ';
                                }
                            }
                            if($v2 == ""){$v2 = "Nghỉ";}
                            echo '<div><label class="bold" style="width:165px;">- Thứ '.rtrim($thu1,', ').'</label>: '.$v2.'</div>';
                        }
                        ?>
                    </div>
                @endif

                {{--//luuhoabk giá trung binh --}}
                @if(isset($location->price_min) && isset($location->price_max))
                    <div>
                        <p class="title">
                            <span class="icon-money"></span>
                            <span class="text-primary">Giá trung bình</span>
                            {{--<small> 75 000đ - 350 000đ </small>--}}

                            @if( $location->price_min > 0 && $location->price_max > 0 )
                                <small> {{number_format($location->price_min,0, ".",",")}}đ - {{number_format($location->price_max,0, ".",",")}}đ </small>
                            @else
                                <small> Đang cập nhật. </small>
                            @endif
                        </p>
                    </div>
                @endif

                <div class="bg-primary row none-margin">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-none-padding location-activitie">
                        <div class="location-activitie-title">LOCATION ACTIVITIES</div>
                        <div class="col-md-6 ">
                            <span class="icon-heart icon-border-square tooltips" style="cursor:pointer;" id="do-like" data-original-title="Thích"></span>
                            <p class="like-count">{{$location->userAction()->whereActionType("like")->count()}}</p>
                        </div>

                        <div class="col-md-6">
                            <span class="icon-universal-access icon-border-square tooltips" style="cursor:pointer;" id="do-checkin" data-original-title="Đánh dấu"></span>
                            <p class="checkin-count">{{$location->userAction()->whereActionType("checkin")->count()}}</p>
                        </div>
                        <div class="col-md-6">
                            <span class="icon-location-1 icon-border-square tooltips" data-original-title="Địa điểm lân cận"></span>
                            <p>{{$location->reviews()->count()}}</p>
                        </div>
                        <div class="col-md-6">
                            <i class="icon-star-filled icon-border-square tooltips" data-original-title="Đánh giá"></i>
                            <p>15</p>
                        </div>


                    </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 portlet-body padding-5">
                            <div id="gmap_marker" data-position="{{isset($location->position)? $location->position : "10.8186952,106.7006242";}}" class="gmaps col-xs-12 col-sm-12 col-md-12 col-lg-12 col-no-padding margin-none gmaps-location">
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @include("site.location.review")
@stop

@section("content")
    <div class="row place">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <!-- left -->
            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified location-navigation" role="tablist">
                    <li role="presentation" class="active"><a href="#review" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">Review</a></li>
                    <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Cộng đồng</a></li>
                    <li role="presentation" class=""><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false">Thành viên</a></li>
                    <li role="presentation" class=""><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">Sự kiện</a></li>
                    <li role="presentation" class=""><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">Hình ảnh</a></li>
                    <li role="presentation" class=""><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">Thực đơn</a></li>
                </ul>

                <!<!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="review">
                        @foreach($reviews as $review)
                        <div class="reviews row item-post-element-parent">

                            <input type="hidden" i_p="{{$review->id}}" i_u="{{$review->user_id}}" class="input-data-value-post"/>
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
                                                    @for($i=0;$i<5;$i++)
                                                        @if($i<$review->getMetaKey("review_rating"))
                                                            <li><i class="icon-star-filled"></i></li>
                                                        @else
                                                            <li><i class="icon-star-1"></i></li>
                                                        @endif
                                                    @endfor
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="col-lg-6">
                                            <div>Đã đánh giá địa điểm</div>
                                            <div><small><i>Vào lúc {{date_format($review->created_at,"h:i:s d-m-Y")}}</i></small></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <small class="pull-right">Số người {{ $review->getMetaKey("review_visitors")}} + | Chi phí {{$review->getMetaKey("review_price")}} đ+ | Sẽ quay lại: @if(isset($options[$review->getMetaKey("review_visit_again")])) {{$options[$review->getMetaKey("review_visit_again")]}} @else không @endif</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review-content">
                                <div>
                                    <p class="title">{{$review->title}}</p>
                                    <p class="content">
                                        {{$review->content}}
                                    </p>
                                </div>
                            </div>
                            <!-- hinh anh -->
                            <?php $list_album=PostMeta::where('post_id','=',$review->id)->where('meta_key','=','review_image')->get();
                           // print_r($list_album);
                            ?>


                            <div class="">
                                @foreach($list_album as $img)
                                <?php $img=Post::find($img->meta_value);
                                      $img_link=$img->getMetaKey('url');

                                ?>
                                <div class="col-md-2 col-sm-4 gallery-item">
                                    <a data-rel="fancybox-button" title="Project Name" href="{{$img_link}}" class="fancybox-button">
                                        <img alt="" src="{{$img_link}}" class="img-responsive">
                                        <div class="zoomix"><i class="fa fa-search"></i></div>
                                    </a>
                                </div>
                                @endforeach

                            </div>
                            <!-- hinh anh -->
                            <!-- thao luan,like,dislike,report -->
                            <?php
                            if($review->userAction()->whereUser_id(Auth::check()&&Auth::user()->id)->wherePost_user_type_id('31')->count()){

                                $lab_like='Đã thích ';

                            }else{
                                $lab_like='Thích ';

                            }

                            if($review->userAction()->whereUser_id(Auth::check()&&Auth::user()->id)->wherePost_user_type_id('32')->count()){

                                $lab_dislike='Đã không thích ';

                            }else{
                                $lab_dislike='không Thích ';

                            }


                            if($review->userAction()->whereUser_id(Auth::user()->id)->wherePost_user_type_id('37')->count()){

                                $lab_spam='Đã báo cáo xấu';

                            }else{
                                $lab_spam='Báo cáo xấu ';

                            }
                            ?>

                            <div class="col-md-12 review-action padding-left-0">
                                <a class="btn-post-comment"><i class="icon-edit"></i>Thảo luận</a>
                                <a class="btn-post-like" type_action="31"><i class="icon-thumbs-up"></i><span class="lab_text_like">{{$lab_like}}</span><span class="lab_num_like">{{ $review->countLike()}}</span></a>
                                <a class="btn-post-dislike"  type_action="32"><i class="icon-thumbs-down"></i><span class="lab_text_dislike">{{$lab_dislike}}</span><span class="lab_num_dislike">{{ $review->countDisLike()}}</span></a>
                                <a class="btn-post-spam" type_action="37"><i class="icon-block"></i><span class="lab_text_dislike">{{$lab_spam}}</span></a>
                                <a class="btn-post-view_more pull-right"><i>Xem thêm</i></a>
                            </div>
                            <!-- thao luan,like,dislike,report end-->

                        </div>
                        @endforeach
                        <div class="paging">{{$reviews->links()}}</div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">...</div>
                    <div role="tabpanel" class="tab-pane" id="messages">...</div>
                    <div role="tabpanel" class="tab-pane" id="settings"></div>
                </div>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <!-- luuhoabk tien ich right -->
            @if(count($location->loadUtility()->get()) >0)
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bg-grey ultility">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title text-primary">
                            Tiện ích
                        </div>
                        @foreach($location->loadUtility()->get() as $utility)
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ultility-item">
                                <i class="icon-check"></i> <strong>{{$utility->utility_name}}</strong>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 banner-right">
                <div class="row">
                    <img src="http://trentarthur.ca/wp-content/uploads/2012/11/Foods.jpg" class="img-responsive padding-3 img-border-grey" alt="Image">
                </div>
                <div class="row">
                    <img src="http://trentarthur.ca/wp-content/uploads/2012/11/Foods.jpg" class="img-responsive padding-3 img-border-grey" alt="Image">
                </div>
            </div>
            <!-- right end -->
        </div>
    </div>
@stop


@section("bottoma")
    <!-- dia diem lan can -->
    @if($location_nearly->count())
    <div class="row location">
        <div class="col-lg-12">
            <div class="container-fluid bg-primary">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 padding-top-10">
                            <div>Địa điểm lân cận</div>
                            <a href="#" class="show-more">&gt;&gt;&gt;Xem tất cả</a>
                        </div>
                        @foreach($location_nearly as $key=>$val)
                            @if($key < 6)
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 bg-primary location-item">
                                <div class="location-info">
                                    <a href="{{asset('dia-diem/'.Str::slug($val->province->name).'/'.$val->id.'-'.$val->slug)}}">
                                        <img class="full-width" height="200px" src="{{asset($val->avatar)}}" alt="Image">
                                        <section class="location-description">
                                        <strong>{{$val->name}}</strong>
                                            <p>
                                                <small>{{$val->address_detail}}, {{$val->province->name}}, {{$val->district->type.' '.$val->district->name}}.</small>
                                            </p>
                                        </section>
                                    </a>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- dia diem lan can end -->
    @stop

@section("bottomb")
    <!-- bai viet noi bat -->
    <div class="row">
    @if($blogs->count())
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="margin-bottom-0 margin-top-10 text-primary"><i class="icon-tag"></i> Bài viết nổi bật</h2>
        </div>
        @foreach($blogs as $blog)
                <div class="col-xs-12 col-sm-6 col-lg-3 gallery-item">
                    <a data-rel="fancybox-button" title="Project Name" href="{{$blog->url()}}" class="fancybox-button">
                        <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                        <div class="zoomix"><i class="icon-cancel-circled2"></i></div>
                    </a>
                    <a href="{{$blog->url()}}"><strong>{{$blog->title}}</strong></a>
                    <p>{{String::tidy(Str::limit($blog->content,50))}}</p>
                </div>
            @endforeach
        @endif
    </div>
    <!-- bai viet noi bat end -->
@stop

@section('style_plugin')

<link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css')}}">
<link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css')}}">
<link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css')}}">
<link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/global/plugins/jquery-file-upload/css/image-manager.min.css')}}">
<link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/frontend/pages/css/location.css')}}">


@stop


@section("styles")
    <!-- imtoantran  -->
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/global/plugins/wysihtml5/css/prettify.css')}}">
    <link rel="stylesheet" href="{{asset("assets/global/plugins/wysihtml5/css/bootstrap-wysihtml5.css")}}">
    <link href="{{asset("assets/global/css/plugins.css")}}" rel="stylesheet">
    <link href="{{asset("assets/frontend/pages/css/gallery.css")}}" rel="stylesheet">
    <!-- imtoantran -->
@stop


@section('js_plugin')
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js')}}"></script>

<script src="{{asset("assets/global/plugins/wysihtml5/js/wysihtml5-0.3.0.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/wysihtml5/js/bootstrap-wysihtml5.js")}}" type="text/javascript"></script>

<script type="text/javascript" src="{{asset("assets/global/plugins/jssor-slider/js/jssor.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/global/plugins/jssor-slider/js/jssor.slider.js")}}"></script>


<script src="{{asset("assets/global/plugins/gmaps/gmaps.min.js")}}" type="text/javascript"></script>


<script src="{{asset("assets/global/scripts/maps-google.js")}}" type="text/javascript"></script>
<script src="https://apis.google.com/js/platform.js" async defer>
    {lang: 'vi'}
</script>
@stop


@section('js_page')
<script src="{{asset('assets/admin/pages/scripts/form-fileupload.js')}}"></script>
<script src="{{asset('assets/frontend/pages/scripts/location.js')}}"></script>

@stop
@section("scripts")
    <!-- imtoantran -->

    <!-- imtoantran -->

    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <!-- imtoantran -->

    <!-- imtoantran -->
    <!-- pop up -->
    <!-- END LayerSlider -->


    <script>
        jQuery(document).ready(
            function(){
                setTimeout(function(){
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
                    /* load reviews end */
                    /* viet review start*/
                    $(".do-post-review").click(function(){
                        $("#reviewModal").modal("show");
                    });
                    $(".wysihtml5").wysihtml5();

                    $("#review-save").click(function(){

                        var listAlbum=Location.getAlbum();
                        $("#review_album").val(listAlbum);
                        var listalbum='';

                        listAlbum.forEach(function (item) {
                           listalbum+=item['post_id']+",";
                        })
                        $("#list-album").val(listalbum);
                        var form = $("#review-form").serialize();

                        $.ajax({
                            url:"{{URL::to("location/review")}}",
                            type:"POST",
                            data:form,

                            success:function(response){
                                $("#review-form")[0].reset();
                                 location.reload();
                            },
                            complete:function(){
                                $('.modal').modal("hide");
                            }
                        })
                });
                /* viet review end */


              /*------------like review-*/

               $("")

              /*------------end like review*/






                // load gmap
                var position = $('.gmaps-location').attr('data-position');
                    position = position.split(",");
                var position_lat = position[0];
                var position_lng = position[1];
                var map = new GMaps({
                    div: '#gmap_marker',
                    lat: position_lat,
                    lng: position_lng
                });
                map.addMarker({
                    lat: position_lat,
                    lng: position_lng
                });
                var infowindow = new google.maps.InfoWindow({
                    content: '<div style="color:#000;"><i class="icon-shareable"></i> {{$location->name}}</div>'
                });
                var location_marker = map.addMarker({
                    lat: position_lat,
                    lng: position_lng,
                    title:'Địa điểm: {{$location->category->name}}'
                });
                infowindow.open(map,location_marker);
                map.setZoom(15);
            }
        );
    </script>
    @stop

    {{--imtoantran--}}