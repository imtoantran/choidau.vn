@extends('site.layouts.default')
{{--imtoantran--}}
@section("topa")
    <!-- banner -->
    <div class="row margin-top-10 margin-bottom-10">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="banner-top text-center">
                <img width="100%" src="{{asset("upload/media_user/1/banner-1.png")}}" class="img-responsive"
                     alt="Image">
            </div>
        </div>
    </div>
    <!-- banner end -->
@stop


@section("topb")

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div style="overflow: hidden;" id="location-slider">
                {{--@include("site.location.slider")--}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 padding-left-0">
            <div class="location-information">
                {{--//luuhoabk dia diem --}}
                <div>
                    <?php
                    $address_detail = (isset($location->address_detail)) ? $location->address_detail : "";
                    $district = (isset($location->district->name)) ? $location->district->name : "";
                    $province = (isset($location->province->name)) ? $location->province->name : "";
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
                        foreach ($arr as $k1 => $v1) {
                            array_push($arr1, $v1->time);
                        }
                        $arr1 = array_unique($arr1); // loai bo gia tri trung
                        foreach ($arr1 as $k2 => $v2) {
                            $thu1 = "";
                            foreach ($arr as $k3 => $v3) {
                                if ($v3->time == $v2) {
                                    $thu3 = $v3->thu;
                                    if ($thu3 == '8') {
                                        $thu3 = "CN";
                                    }
                                    $thu1 .= $thu3 . ', ';
                                }
                            }
                            if ($v2 == "") {
                                $v2 = "Nghỉ";
                            }
                            echo '<div><label class="bold" style="width:165px;">- Thứ ' . rtrim($thu1, ', ') . '</label>: ' . $v2 . '</div>';
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
                                <small> {{number_format($location->price_min,0, ".",",")}}đ
                                    - {{number_format($location->price_max,0, ".",",")}}đ
                                </small>
                            @else
                                <small> Đang cập nhật.</small>
                            @endif
                        </p>
                    </div>
                @endif

                <div class="bg-primary row none-margin">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-none-padding location-activitie">
                        Location activities
                        <div class="col-md-6 ">
                            <span class="icon-heart icon-border-square tooltips" style="cursor:pointer;" id="do-like"
                                  data-original-title="Thích"></span>

                            <p class="like-count">{{$location->userAction()->whereActionType("like")->count()}}</p>
                        </div>

                        <div class="col-md-6">
                            <span class="icon-location icon-border-square tooltips" style="cursor:pointer;"
                                  id="do-checkin" data-original-title="Đánh dấu"></span>

                            <p class="checkin-count">{{$location->userAction()->whereActionType("checkin")->count()}}</p>
                        </div>
                        <div class="col-md-6">
                            <span class="icon-star icon-border-square tooltips"
                                  data-original-title="Địa điểm lân cận"></span>

                            <p>{{$location->reviews()->count()}}</p>
                        </div>
                        <div class="col-md-6">
                            <i class="icon-star-filled icon-border-square tooltips" data-original-title="Đánh giá"></i>

                            <p>15</p>
                        </div>


                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-none-padding portlet-body">
                        <div id="gmap_marker"
                             data-position="{{isset($location->position)? $location->position : "10.8186952,106.7006242";}}"
                             class="gmaps col-xs-12 col-sm-12 col-md-12 col-lg-12 gmaps-location">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("site.location.review")
    @include("site.location.edit")
@stop

@section("content")
    <div class="row place">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <!-- left -->
            <div role="tabpanel">
                <!-- Nav tabs -->

                <ul class="nav nav-tabs nav-justified location-navigation" role="tablist">
                    <li role="presentation" class="active"><a href="#review" aria-controls="home" role="tab"
                                                              data-toggle="tab" aria-expanded="true">Review</a></li>
                    <li role="presentation" class=""><a href="#tag-member-location-content" class="btn-member-location"
                                                        aria-controls="messages" role="tab" data-toggle="tab"
                                                        aria-expanded="false">Thành viên</a></li>
                    <li role="presentation" class=""><a href="#tag-event-location-content" class="btn-event-location"
                                                        aria-controls="settings" role="tab" data-toggle="tab"
                                                        aria-expanded="false">Sự kiện</a></li>
                    <li role="presentation" class=""><a href="#tag-photo-location-content" class="btn-photo-location"
                                                        aria-controls="settings" role="tab" data-toggle="tab"
                                                        aria-expanded="false">Hình ảnh</a></li>
                    <li role="presentation" class=""><a href="#settings" aria-controls="settings" role="tab"
                                                        data-toggle="tab" aria-expanded="false">Thực đơn</a></li>
                </ul>
                <!<!-- Tab panes -->
                <div class="tab-content" id="choidau-person">
                    <div role="tabpanel" class="tab-pane active" id="review">
                        @include("site.location.review_item")
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">...</div>
                    <div role="tabpanel" class="tab-pane" id="settings"></div>
                    <div role="tabpanel" class="tab-pane" id="tag-member-location-content">

                        <section class="person-friends choidau-bg">
                            <header class="">
                                Tất cả bạn bè <span class="person-friends-list-total">2</span>
                            </header>

                            <div class="row person-friends-list lab-location-list-member margin-none" is_val="0">

                            </div>


                        </section>


                    </div>
                    <div role="tabpanel" class="tab-pane" id="tag-event-location-content">

                        <div class="lab-location-list-event">

                        </div>


                    </div>
                    <div role="tabpanel" class="tab-pane" id="tag-photo-location-content">


                        <section class="person-images choidau-bg">
                            <header>
                                <i class="icon-folder" style="color: #fff; font-size: 2.6em;margin-top: 8px;"></i>
                                <i class="icon-camera"
                                   style="margin-left: -35px; margin-top: 19px; font-size: 1.2em; position: absolute;"></i>

                                <div class="text-1em2">Album ảnh</div>
                            </header>
                            <nav>
                                <ul class="mix-filter">
                                    <li data-filter="all" class="filter">Tất cả</li>
                                    <li data-filter="category_avatar active" class="filter">Ảnh đại diện</li>
                                    <li data-filter="category_location" class="filter">Ảnh địa điểm</li>
                                </ul>
                            </nav>
                            <div class="row mix-grid thumbnails margin-none lab-location-list-photo">


                            </div>
                        </section>


                    </div>

                </div>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <!-- luuhoabk tien ich right -->

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bg-grey ultility">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title text-primary">
                        <icon class="icon-layout font-16px"></icon>
                        Tiện ích
                    </div>
                    @if(count($location->loadUtility()->get()) >0)
                        @foreach($location->loadUtility()->get() as $utility)
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ultility-item">
                                <i class="icon-check"></i> <strong>{{$utility->utility_name}}</strong>
                            </div>
                        @endforeach
                    @else
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ultility-item">
                            <span class="utility-empty font-12px">- Đang cập nhật.</span>
                        </div>
                    @endif
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 banner-right">
                <div class="row">
                    <img src="http://trentarthur.ca/wp-content/uploads/2012/11/Foods.jpg"
                         class="img-responsive padding-3 img-border-grey" alt="Image">
                </div>
                <div class="row">
                    <img src="http://trentarthur.ca/wp-content/uploads/2012/11/Foods.jpg"
                         class="img-responsive padding-3 img-border-grey" alt="Image">
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
                            </div>
                            @foreach($location_nearly as $key=>$val)
                                @if($key < 6)
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 bg-primary location-item">
                                        <div class="location-info">
                                            <a href="{{$val->url()}}">
                                                <div class="box-product-img-content">
                                                    <img class="full-width" height="200px" src="{{asset($val->avatar)}}"
                                                         alt="Image">
                                                    <section class="location-description">
                                                        <strong>{{$val->name}}</strong>

                                                        <p>
                                                            <small>{{$val->address()}}</small>
                                                        </p>
                                                    </section>
                                                </div>
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
    @include("site.blog.featured")

    <!-- bai viet noi bat end -->
    @include('site.location.popup_create_event')
    @include('site.location.popup_create_food')
@stop

@section('style_plugin')
    <link media="all" type="text/css" rel="stylesheet"
          href="{{asset('assets/global/plugins/bootstrap-datepicker/css/datepicker.css')}}"/>
    <link media="all" type="text/css" rel="stylesheet"
          href="{{asset('assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css')}}">
    <link media="all" type="text/css" rel="stylesheet"
          href="{{asset('assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css')}}">
    <link media="all" type="text/css" rel="stylesheet"
          href="{{asset('assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css')}}">
    <link media="all" type="text/css" rel="stylesheet"
          href="{{asset('assets/global/plugins/jquery-file-upload/css/image-manager.min.css')}}">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/frontend/pages/css/location.css')}}">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('assets/frontend/pages/css/portfolio.css')}}">


@stop


@section("styles")
    <!-- imtoantran  -->
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap-theme.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("assets/global/css/plugins.css")}}" rel="stylesheet">
    <link href="{{asset("assets/frontend/pages/css/gallery.css")}}" rel="stylesheet">
    <!-- imtoantran -->
@stop


@section('js_plugin')
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

    <!--<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.vi.js')}}"></script>-->

    <script type="text/javascript" src="{{asset("assets/global/plugins/jssor-slider/js/jssor.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/global/plugins/jssor-slider/js/jssor.slider.js")}}"></script>


    <script src="{{asset("assets/global/plugins/gmaps/gmaps.min.js")}}" type="text/javascript"></script>


    <script src="{{asset("assets/global/scripts/maps-google.js")}}" type="text/javascript"></script>
    <script src="https://apis.google.com/js/platform.js" async defer>
        {
            lang: 'vi'
        }
    </script>
@stop


@section('js_page')
    <script src="{{asset('assets/admin/pages/scripts/form-fileupload.js')}}"></script>
    <script src="{{asset('assets/frontend/pages/scripts/location.js')}}"></script>
    <script src="{{asset('assets/frontend/pages/scripts/portfolio.js')}}"></script>


@stop

@section("scripts")
    <script>
        $(document).ready(function () {
                    /* imtoantran ajax load slider start */
                    var albumWrapper = $('.wrapper-img');
                    var load_slider = function () {
                        $("#location-slider").load("{{URL::to("location/$location->id/images")}}", null, function (data) {
                            Layout.initSliderLocation("slider1_container");
                            $("#uploadImageModal").unblock();
                        });

                    };
                    var removeLocationImage = function (image) {
                        $("#uploadImageModal").block();
                        $.ajax({
                            url: "{{URL::to("location/$location->id/images")}}",
                            type: 'delete',
                            data: {'images': image.id},
                            success: function (resAlbum) {
                                albumWrapper.find('.item-img[data-image-id="' + image.id + '"]').remove();
                            },
                            complete: function () {
                                if ($('.wrapper-img .item-img').length <= 0) {
                                    $('.album-empty').fadeIn();
                                }
                                $("#uploadImageModal").unblock();
                                load_slider();
                            }
                        });
                    };
                    load_slider();
                    /* imtoantran ajax load slider end */
                    $('.wrapper-img button').click(function () {
                        var image = {};
                        image.id = $(this).data("image-id");
                        removeLocationImage(image);
                    });
                    /* imtoantran add image for location start */
                    $("#btn-upgrade-imgs").mediaupload({
                        url: "{{URL::to("media/upload")}}",
                        fullwidth: true,
                        token: "{{Session::token()}}",
                        "multi-select": true,
                        complete: function (images) {
                            var imageIDs = [];
                            $.each(images, function (i, image) {
                                if (!albumWrapper.find("div[data-image-id='" + image.id + "']").length) {
                                    imageIDs.push(image.id);
                                    var htmlTag = $('<div/>', {class: 'col-xs-3 item-img', 'data-image-id': image.id});
                                    var btn = $('<button type="button" data-image-id="' + image.id + '" class="no-padding location-img-btn-close-item" title="Xóa hình">');
                                    btn.html('<i class="icon-cancel-circled"></i>');
                                    htmlTag.append(btn).append('<img style="width: 117px; height: 87px;" class="padding-3 img-border-grey img-responsive" src="' + image.src + '" alt=""/>');
                                    albumWrapper.append(htmlTag);
                                    btn.on('click', function (e) {
                                        /*btn.loading(btn.find('i'), 'icon-cancel-circled', 'show');*/
                                        removeLocationImage(image);
                                    });
                                }
                            });
                            if (imageIDs.length) {
                                $("#uploadImageModal").block();
                                $.ajax({
                                    url: URL + "/location/{{$location->id}}/images",
                                    type: 'post',
                                    data: {images: imageIDs},
                                    dataType: 'json',
                                    success: function () {
                                        load_slider();
                                    }
                                });
                            }
                        }
                    });
                    /* imtoantran add image for location end */
                    /* imtoantran add image for review start*/
                    $("#add-review-image").mediaupload({
                        url: "{{URL::to("media/upload")}}",
                        token: "{{Session::token()}}",
                        "multi-select": true,
                        complete: function (images) {
                            $.each(images, function (i, image) {
                                if(!$(".review-image[data-id="+image.id+"]").length){console.log(image.id)
                                    btnRemove = $('<i class="icon icon-cancel-circle"/>');
                                    review_image = $("<div class='review-image' data-id="+image.id+"/>");
                                    review_image.append(btnRemove);
                                    review_image.append('<img style="width:100%" src="'+image.thumbnail+'"/>');
                                    review_image.append('<input type="hidden" name="images[]" value="'+image.id+'"/>');
                                    $(".review-image-container").append(review_image);
                                    btnRemove.on("click",function(){$(this).parent().remove()})
                                }
                            });
                        }
                    });
                    /* imtoantran add image for review stop */
                    /* save review */
                    $("#review-form").submit(function () {
                        var form = $(this);
                        $.ajax({
                            url: "{{URL::to("location/$location->id/review")}}",
                            type: "POST",
                            data: form.serialize(),
                            complete: function () {
                                document.getElementById("review-form").reset();
                                $(".review-image").remove();
                                $('.modal').modal("hide");
                            }
                        });
                        return false;
                    });
                    /* viet review end */

                    $('#date-start-event-location').datetimepicker({
                        format: 'DD/MM/YYYY h:mm:ss'


                    });
                    $('#date-end-event-location').datetimepicker({
                        format: 'DD/MM/YYYY h:mm:ss'
                    });
                    $("#date-start-event-location").on("dp.change", function (e) {
                        $('#date-end-event-location').data("DateTimePicker").minDate(e.date);
                    });
                    $("#date-end-event-location").on("dp.change", function (e) {
                        $('#date-start-event-location').data("DateTimePicker").maxDate(e.date);
                    });

                    /***--end thời gian sự kiện location*/


                    /* imtoantran do like */
                    $("#do-like").click(function (e) {
                        var like_btn = $(this);
                        $(this).attr('disabled', true);
                        $.ajax({
                            type: "post",
                            url: "{{URL::to("location/like")}}",
                            data: {id: "{{$location->id}}"},
                            dataType: "json",
                            success: function (response) {
                                $(".like-count").text(response['totalFavourites']);
                                if (response['canLike']) {

                                }
                                like_btn.attr('disabled', false);
                            }
                        });
                    });
                    /* imtoantran do like */
                    /* do checkin start */
                    $("#do-checkin").click(function (e) {
                        var checkin_btn = $(this);
                        checkin_btn.attr('disabled', true);
                        $.ajax({
                            type: "post",
                            url: "{{URL::to("location/checkin")}}",
                            data: {id: "{{$location->id}}"},
                            dataType: "json",
                            success: function (response) {
                                if (response['success']) {
                                    $(".checkin-count").text(response['totalCheckedIn']);
                                } else {
                                    alert(response['message']);
                                }
                                checkin_btn.attr('disabled', false);
                            }
                        });
                    });
                    /* do checkin end */
                    /* load reviews start */
                    /* load reviews end */
                    /* viet review start*/

                    /**


                     /*------------Tag Thanh vien Loacation-*/
                    $(".btn-member-location").click(function () {

                        var element_input_data_location = $("#input-data-value-location");
                        var location_id = element_input_data_location.attr('i_l');
                        var is_val = $(".lab-location-list-member").attr('is_val');
                        if (is_val != '1') {
                            $.ajax({
                                url: "{{URL::to("location/load-member")}}",
                                type: "POST",
                                data: {
                                    'location_id': location_id
                                },

                                success: function (response) {
                                    $(".lab-location-list-member").html(response);
                                    $(".lab-location-list-member").attr('is_val', '1');

                                },
                                complete: function () {
                                    $('.modal').modal("hide");
                                }
                            });
                        }
                    });


                    /*------------Tag Thanh vien Loacation*/

                    /*-------------Tag Sự kiện*/
                    $(".btn-event-location").click(function () {

                        var element_input_data_location = $("#input-data-value-location");
                        var location_id = element_input_data_location.attr('i_l');
                        var is_val = $(".lab-location-list-event").attr('is_val');

                        if (is_val != '1') {
                            $.ajax({
                                url: "{{URL::to("location/load-event")}}",
                                type: "POST",
                                data: {
                                    'location_id': location_id
                                },

                                success: function (response) {

                                    if (response != null) {

                                        $(".lab-location-list-event").html(response);
                                        $(".lab-location-list-event").attr('is_val', '1');
                                    }
                                },
                                complete: function () {
                                    //  $('.modal').modal("hide");
                                }
                            });
                        }
                    });
                    /*--------------Tag Sự Kiện end*/

                    /*-------------Tag Hình ảnh*/
                    $(".btn-photo-location").click(function () {

                        var element_input_data_location = $("#input-data-value-location");
                        var location_id = element_input_data_location.attr('i_l');
                        var is_val = $(".lab-location-list-photo").attr('is_val');
                        // alert(location_id);
                        if (is_val != '1') {
                            $.ajax({
                                url: "{{URL::to("location/load-photo")}}",
                                type: "POST",

                                data: {
                                    'location_id': location_id
                                },
                                success: function (response) {

                                    if (response != null) {
                                        var i = $(".lab-location-list-photo").html(response);
                                        $(".lab-location-list-photo").attr('is_val', '1');
                                    }


                                },
                                complete: function (response) {
                                    // $('.modal').modal("hide");
                                }
                            });
                        }
                    });
                    /*--------------Tag hình ảnh end*/


                    /***---Btn Add sự kiện location--start--*/

                    $(".btn-add-event-location").click(function () {

                        var element_input_data_location = $("#input-data-value-location");
                        var location_id = element_input_data_location.attr('i_l');
                        var title_event = $("#title-event-location").val();
                        var content_event = $("#content-event-location").val();
                        var date_start_event = $("#date-start-event-location").val();
                        var date_end_event = $("#date-end-event-location").val();
                        // alert(date_start_event);
                        $.ajax({
                            url: "{{URL::to("location/event")}}",
                            type: "POST",

                            data: {
                                'location_id': location_id,
                                'title_event': title_event,
                                'content_event': content_event,
                                'date_end_event': date_end_event,
                                'date_start_event': date_start_event
                            },
                            success: function (response) {

                            },
                            complete: function (response) {
                                $("#form-ada-event-location")[0].reset();
                                $('.modal').modal("hide");
                            }
                        });

                    });

                    /***---Btn Add sự kiện location--end--*/


                    /*** Btn Add Thực đơn ---start--*/

                    $("#txt-location-food-name").blur(function () {
                        var x = $(this).val();
                        var z = $('#food-datalist-add-food');
                        var val = $(z).find('option[value="' + x + '"]');
                        var end_val = val.attr('data-id');
                        $("#txt-location-food-name").attr('data-food-suggest-id', end_val);
                    });


                    $(".btn-add-food-location").click(function () {

                        var element_input_data_location = $("#input-data-value-location");
                        var location_id = element_input_data_location.attr('i_l');
                        var food_name = $("#txt-location-food-name").val();
                        var food_name_id = $("#txt-location-food-name").attr('data-food-suggest-id');
                        var food_price = $("#txt-location-food-price").val();
                        var food_type = $("#slc-location-food-type").val();
                        var food_description = $("#are-location-food-description").val();


                        //alert(food_name_id);

                        $.ajax({
                            url: "{{URL::to("location/food")}}",
                            type: "POST",

                            data: {
                                'location_id': location_id,
                                'food_name': food_name,
                                'food_name_id': food_name_id,
                                'food_price': food_price,
                                'food_type': food_type,
                                'food_description': food_description
                            },
                            success: function (response) {

                            },
                            complete: function (response) {
                                $('#from-add-food-location')[0].reset();
                                $('.modal').modal("hide");
                            }
                        });


                    });

                    /*** Btn Add Thực đơn ---end--*/


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
                        title: 'Địa điểm: {{$location->category->name}}'
                    });
                    infowindow.open(map, location_marker);
                    map.setZoom(15);
                }
        );
    </script>
@stop
