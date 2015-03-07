@extends('site.layouts.default')
@section('content')
    <div id="choidau-person">

        @include('site.user.blog.header')

        <div class="person-body">
            <div class="row margin-none">
                <div class="col-md-9 col-none-padding person-body-content">

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane" id="home">


                            <section class="person-content choidau-bg">

                                {{--post statetus--}}
                                <div class="row person-content-item form-add-status" style="padding-bottom: 10px;">

                                    <div class="action-comment">
                                        <header class="action-comment-subject text-weight600">Cập nhật trạng thái
                                        </header>
                                        <div class="action-comment-input">
                                            <textarea name="content-status" id="content-status"
                                                      placeholder="bạn đang nghỉ gì ?" rows="3"
                                                      style="width: 100%;padding: 0; border: none;"></textarea>

                                        </div>
                                        <div class="text-right action-comment-submit">
                                            <div class="btn-group person-type-scopy margin-none">
                                                <button type="button" id="privacy-status" value_id="18"
                                                        class="btn btn-default btn-xs">Công khai
                                                </button>
                                                <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <i class="icon-down-dir"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    @foreach($listStatusPost as $item)
                                                        <li value_id="{{$item['id']}}">{{$item['description']}}</li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                            <button class="btn choidau-bg-font btn-xs btn-add-status ">Đăng</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="feed-blog-post-top">

                                </div>


                                {{$html_status}}


                                {{--<div class="row person-content-item">--}}
                                {{--<div class="col-md-12 col-none-padding">--}}
                                {{--<div class="col-md-9 article-img-text col-none-padding">--}}
                                {{--<img class="avatar-pad2" src="./img-data-demo/avatar-2.JPG" alt="">--}}
                                {{--<div class="person-content-info">--}}
                                {{--<div><a>moonlovesun</a><span> - Newbie</span></div>--}}
                                {{--<span>?ã check ??a ?i?m này</span><br>--}}
                                {{--<span>01/01/2014 - 05:15</span>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-3 col-none-padding text-right">--}}
                                {{--<div class="btn-group person-type-scopy">--}}
                                {{--<button type="button" class="btn btn-default btn-xs">Công khai</button>--}}
                                {{--<button type="button" class="btn btn-default btn-xs dropdown-toggle"--}}
                                {{--data-toggle="dropdown">--}}
                                {{--<i class="icon-down-dir"></i>--}}
                                {{--</button>--}}
                                {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li>Công khai</li>--}}
                                {{--<li>B?n bè</li>--}}
                                {{--<li>Nhóm</li>--}}
                                {{--</ul>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12 col-none-padding person-content-article">--}}
                                {{--<div class="row margin-none">--}}
                                {{--<section class="article-img-text clearfix content-article-wrapper">--}}
                                {{--<div class="text-algin-img">--}}
                                {{--<article>--}}
                                {{--Trong th?i ti?t l?nh giá c?a mùa ?ông th? này, ng?i quay qu?n bên--}}
                                {{--chi?c b?p than h?ng hay n?i l?u b?c khói nghi ngút, h?n là m?t l?a--}}
                                {{--ch?n tuy?t v?i cho các teen nhà mình ph?i không? Vì th? hôm nay--}}
                                {{--chúng t? gi?i thi?u cho các b?n m?t ??a ch? mà chúng t? m?i khám phá--}}
                                {{--ra, ?ó là ...--}}
                                {{--</article>--}}
                                {{--</div>--}}
                                {{--</section>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<!-- comment - like - share -->--}}
                                {{--<div class="row margin-none">--}}
                                {{--<div class="person-text-assoc">--}}
                                {{--<a href="#">Thích</a>--}}
                                {{--<a href="#">Bình lu?n</a>--}}
                                {{--<a href="#">Chia s?</a>--}}
                                {{--</div>--}}
                                {{--</div>--}}

                                {{--<!-- comment - like - share -->--}}
                                {{--<div class="row margin-none person-command">--}}
                                {{--<div class="col-md-12 col-none-padding">--}}
                                {{--<a href=""><i class="icon-thumbs-up-alt"></i></a>--}}
                                {{--<span>12</span> ng??i thích ?i?u này--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12 article-img-text col-none-padding">--}}
                                {{--<div class="row margin-none">--}}
                                {{--<img class="col-md-1 col-ms-1 avatar-pad2"--}}
                                {{--src="./img-data-demo/avatar-1.JPG" alt="">--}}
                                {{--<input class="col-md-11 col-ms-11 col-xs-11" type="text"--}}
                                {{--placeholder="Vi?t bình lu?n...">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="row person-content-item">--}}
                                {{--<div class="col-md-12 col-none-padding">--}}
                                {{--<div class="col-md-9 article-img-text col-none-padding">--}}
                                {{--<img class="avatar-pad2" src="./img-data-demo/avatar-4.JPG" alt="">--}}
                                {{--<div class="person-content-info">--}}
                                {{--<div><a>moonlovesun</a><span> - Newbie</span></div>--}}
                                {{--<span>?ã check ??a ?i?m này</span><br>--}}
                                {{--<span>01/01/2014 - 05:15</span>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-3 col-none-padding text-right">--}}
                                {{--<div class="btn-group person-type-scopy">--}}
                                {{--<button type="button" class="btn btn-default btn-xs">Công khai</button>--}}
                                {{--<button type="button" class="btn btn-default btn-xs dropdown-toggle"--}}
                                {{--data-toggle="dropdown">--}}
                                {{--<i class="icon-down-dir"></i>--}}
                                {{--</button>--}}
                                {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li>Công khai</li>--}}
                                {{--<li>B?n bè</li>--}}
                                {{--<li>Nhóm</li>--}}
                                {{--</ul>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12 col-none-padding person-content-article">--}}
                                {{--<div class="row margin-none">--}}
                                {{--<section class="article-img-text clearfix content-article-wrapper">--}}
                                {{--<div class="text-algin-img">--}}
                                {{--<article>--}}
                                {{--Trong thời tiết lạnh giá của mùa đông thế này, ngồi quay quần bên--}}
                                {{--chiếc bếp than hồng hay nồi lẩu bốc khói nghi ngút, hẳn là một lựa--}}
                                {{--chọn tuyệt vời cho các teen nhà mình phải không? Vì thế hôm nay--}}
                                {{--chúng tớ giới thiệu cho các bạn một địa chỉ mà chúng tớ mới khám phá--}}
                                {{--ra, ?ó là ...--}}
                                {{--</article>--}}
                                {{--</div>--}}
                                {{--</section>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<!-- comment - like - share -->--}}
                                {{--<div class="row margin-none">--}}
                                {{--<div class="person-text-assoc">--}}
                                {{--<a href="#">Thích</a>--}}
                                {{--<a href="#">Bình lu?n</a>--}}
                                {{--<a href="#">Chia s?</a>--}}
                                {{--</div>--}}
                                {{--</div>--}}

                                {{--<!-- comment - like - share -->--}}
                                {{--<div class="row margin-none person-command">--}}
                                {{--<div class="col-md-12 col-none-padding">--}}
                                {{--<a href=""><i class="icon-thumbs-up-alt"></i></a>--}}
                                {{--<span>12</span> ng??i thích ?i?u này--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12 article-img-text col-none-padding">--}}
                                {{--<div class="row margin-none">--}}
                                {{--<img class="col-md-1 col-ms-1 avatar-pad2"--}}
                                {{--src="./img-data-demo/avatar-1.JPG" alt="">--}}
                                {{--<input class="col-md-11 col-ms-11 col-xs-11" type="text"--}}
                                {{--placeholder="Vi?t bình lu?n...">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="row person-content-item">--}}
                                {{--<div class="col-md-12 col-none-padding">--}}
                                {{--<div class="col-md-9 article-img-text col-none-padding">--}}
                                {{--<img class="avatar-pad2" src="./img-data-demo/avatar-2.JPG" alt="">--}}
                                {{--<div class="person-content-info">--}}
                                {{--<div><a>moonlovesun</a><span> - Newbie</span></div>--}}
                                {{--<span>?ã check ??a ?i?m này</span><br>--}}
                                {{--<span>01/01/2014 - 05:15</span>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-3 col-none-padding text-right">--}}
                                {{--<div class="btn-group person-type-scopy">--}}
                                {{--<button type="button" class="btn btn-default btn-xs">Công khai</button>--}}
                                {{--<button type="button" class="btn btn-default btn-xs dropdown-toggle"--}}
                                {{--data-toggle="dropdown">--}}
                                {{--<i class="icon-down-dir"></i>--}}
                                {{--</button>--}}
                                {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li>a</li>--}}
                                {{--<li>b</li>--}}
                                {{--<li>c</li>--}}
                                {{--</ul>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12 col-none-padding person-content-article">--}}
                                {{--<div class="row margin-none">--}}
                                {{--<section class="article-img-text clearfix content-article-wrapper">--}}
                                {{--<img class="avatar-pad2" src="./img-data-demo/monan-3.jpg" alt="">--}}

                                {{--<div class="text-algin-img">--}}
                                {{--<header>--}}
                                {{--<a href="#"><h2>Sinh t? 221 Tr?n H?ng ??o</h2></a>--}}
                                {{--</header>--}}
                                {{--<article>--}}
                                {{--Trong thời tiết lạnh giá của mùa đông thế này, ngồi quay quần bên--}}
                                {{--chiếc bếp than hồng hay nồi lẩu bốc khói nghi ngút, hẳn là một lựa--}}
                                {{--chọn tuyệt vời cho các teen nhà mình phải không? Vì thế hôm nay--}}
                                {{--chúng tớ giới thiệu cho các bạn một địa chỉ mà chúng tớ mới khám phá--}}
                                {{--ra, ?ó là ...--}}
                                {{--</article>--}}
                                {{--<a href="#"><i>http://choidau.net/diadiem/quanlaunuong/</i></a>--}}
                                {{--</div>--}}
                                {{--</section>--}}
                                {{--</div>--}}

                                {{--<!-- slide img -->--}}
                                {{--<div class="row margin-none">--}}
                                {{--<ul class="list-unstyled person-content-slide text-center">--}}
                                {{--<li><img src="./img-data-demo/monan-4.jpg" alt=""></li>--}}
                                {{--<li><img src="./img-data-demo/monan-2.jpg" alt=""></li>--}}
                                {{--<li><img src="./img-data-demo/monan-3.jpg" alt=""></li>--}}
                                {{--<li><img src="./img-data-demo/monan-4.jpg" alt=""></li>--}}
                                {{--<li><img src="./img-data-demo/monan-5.jpg" alt=""></li>--}}
                                {{--<li><img src="./img-data-demo/monan-6.jpg" alt=""></li>--}}
                                {{--<li><img src="./img-data-demo/monan-1.jpg" alt=""></li>--}}
                                {{--<li><img src="./img-data-demo/monan-6.jpg" alt=""></li>--}}
                                {{--<li class="text-right"><button class="btn btn-default">xem thêm</button></li>--}}
                                {{--</ul>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<!-- comment - like - share -->--}}
                                {{--<div class="row margin-none">--}}
                                {{--<div class="person-text-assoc">--}}
                                {{--<a href="#">Thích</a>--}}
                                {{--<a href="#">Bình luân</a>--}}
                                {{--<a href="#">Chia s?</a>--}}
                                {{--</div>--}}
                                {{--</div>--}}

                                {{--<!-- comment - like - share -->--}}
                                {{--<div class="row margin-none person-command">--}}
                                {{--<div class="col-md-12 col-none-padding">--}}
                                {{--<a href=""><i class="icon-thumbs-up-alt"></i></a>--}}
                                {{--<span>12</span> ng??i thích ?i?u này--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12 article-img-text col-none-padding">--}}
                                {{--<div class="row margin-none">--}}
                                {{--<img class="col-md-1 col-ms-1 avatar-pad2"--}}
                                {{--src="./img-data-demo/avatar-2.JPG" alt="">--}}
                                {{--<input class="col-md-11 col-ms-11 col-xs-11" type="text"--}}
                                {{--placeholder="Vi?t bình lu?n...">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}

                                <div class="row action-view-more margin-none text-center text-1em2 choidau-font">
                                    Xem thêm hoạt động
                                </div>
                            </section>

                        </div>
                        <div role="tabpanel" class="tab-pane" id="tag-blog-photo-content">


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
                                <div class="row mix-grid thumbnails margin-none blog-photo-list-content">
                                </div>
                            </section>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="messages">...</div>
                        <div role="tabpanel" class="tab-pane" id="tag-blog-checkin-content">
                            <section class="person-content  blog-checkin-list-content choidau-bg">
                                <!--main content-->
                            </section>
                            <div class="person-advertise text-center">
                                <img class="img-responsive" src="./img-data-demo/advertise.jpg" alt="">
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tag-blog-friend-content">
                            <section class="person-friends choidau-bg">
                                <header class="padding-5">
                                    <i class="icon-group white"></i>
                                    Tất cả bạn bè <span class="person-friends-list-total"></span>
                                </header>
                                <div class="row person-friends-list margin-none">
                                </div>
                            </section>
                        </div>

                        {{--luuhoabk tab setting infor user--}}
                        <div role="tabpanel" class="tab-pane active" id="blog-tab-setting">
                            <section class="blog-setting-section choidau-bg">
                                <header class="padding-5 blog-setting-header white">
                                    <i class="icon-cog white"></i>
                                    Cập nhật thông tin
                                </header>
                                <div class="row blog-setting-wrapper margin-none">
                                    <div class="blog-setting-content">
                                        dsd
                                    </div>
                                </div>


                            </section>
                        </div>
                        {{--END luuhoabk tab setting infor user--}}

                        <div role="tabpanel" class="tab-pane" id="tag-blog-location-like-content">
                            <section class="person-location choidau-bg">
                                <div class="row person-location-list  blog-location-like-list-content margin-none">
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-none-padding">
                    <section class="aside-wrapper">
                        <div class="aside-list aside-info">
                            <header class="choidau-bg-font">
                                <i class="icon-info"></i>
                                Thông tin
                            </header>
                            <ul class="aside-info list-unstyled">
                                <li>
                                    <div>
                                        <label class="blog-info-lbl">Cấp bậc</label>:
                                        <span>
                                            @if(isset($blog_info['level']) && !empty($blog_info['level']))
                                                {{$blog_info['level']}}
                                            @else
                                                <span class="updateting">Đang cập nhật</span>
                                            @endif
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label class="blog-info-lbl">Địa chỉ</label>:
                                        <span>
                                            @if(isset($blog_info['province']) && !empty($blog_info['province']))
                                                {{$blog_info['province']}}
                                            @else
                                                <span class="updateting">Đang cập nhật</span>
                                            @endif
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label class="blog-info-lbl">Ngày sinh</label>:
                        <span>
                            @if(isset($blog_info['birthday']) && !empty($blog_info['birthday']))
                                {{$blog_info['birthday']}}
                            @else
                                <span class="updateting">Đang cập nhật</span>
                            @endif
                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label class="blog-info-lbl">Đã theo dõi</label>:
                        <span>
                            <span class="updateting">Đang cập nhật</span>
                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label class="blog-info-lbl">Được theo dõi</label>:
                        <span>
                            <span class="updateting">Đang cập nhật</span>
                        </span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label class="blog-info-lbl">Số lượt thích</label>:
                                        @if(isset($blog_info['total_like']) && !empty($blog_info['total_like']))
                                            <span>{{$blog_info['total_like']}} Địa điểm</span>
                                        @else
                                            <span class="updateting">Đang cập nhật</span>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                        @if(isset($arrFriendSuggset))
                            <!-- add friend -->
                            <div class="aside-list">
                                <header class="choidau-bg-font">
                                    <i class="icon-user-add white"></i>
                                    Gơi ý kết bạn
                                </header>
                                <!--goi y ket ban-->
                                @if(count($arrFriendSuggset)>0)
                                    <ul class="list-unstyled aside-items">
                                        @foreach(json_decode($arrFriendSuggset) as $key=>$val)
                                            <li class="lab-btn-item-blog-friend">
                                                <div class = "row margin-none">
                                                    <div class="col-md-8 col-sm-8 col-xs-8 col-none-padding article-img-text">
                                                        <a href="{{URL::to('/')}}/trang-ca-nhan/{{$val->username}}.html">
                                                            <img class="avatar-pad2" src="{{$val->avatar}}" alt="">
                                                        </a>
                                                        <div class="aside-items-text">
                                                            <a href="{{URL::to('/')}}/trang-ca-nhan/{{$val->username}}.html">
                                                                <b>@if(isset($val->fullname)){{$val->fullname}}@else{{$val->username}}@endif</b>
                                                            </a>
                                                            <p>{{$val->num_muatal}} bạn chung</p></div>
                                                        </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-center">
                                                        @if(count($val->state_user)>0)
                                                            <button class="btn btn-default btn-sm-8 margin-none btn-friend-suggest" data-type="delete" friend_id="{{$val->id}}"><i class="icon-user-delete" style="font-size: 1.2em;"></i>Hủy</button>
                                                            </br>
                                                            @if($val->state_user->status_id == 35)
                                                                <span class="italic text-grey font-10px sub-alert"> Đã gửi lời mời</span>
                                                            @else
                                                                <span class="italic text-grey font-10px sub-alert"> Đã kết bạn</span>
                                                            @endif
                                                        @elseif(count($val->state_friend)>0)
                                                            @if($val->state_friend->status_id == 35)
                                                                <button class="btn btn-default btn-sm-8 margin-none btn-friend-suggest" data-type="confirm" friend_id="{{$val->id}}"><i class="icon-user-add" style="font-size: 1.2em;"></i>Chấp nhận</button>
                                                                </br><span class="italic text-grey font-10px sub-alert"> Đang chờ</span>
                                                            @else
                                                                <button class="btn btn-default btn-sm-8 margin-none btn-friend-suggest" data-type="delete" friend_id="{{$val->id}}"><i class="icon-user-delete" style="font-size: 1.2em;"></i>Hủy</button>
                                                                </br><span class="italic text-grey font-10px sub-alert"> Đã kết bạn</span>
                                                            @endif
                                                        @else
                                                            <button class="btn btn-default btn-sm-8 margin-none btn-friend-suggest" data-type="add" friend_id="{{$val->id}}"><i class="icon-user-add" style="font-size: 1.2em;"></i>Kết bạn</button>
                                                            </br><span class="italic text-grey font-10px sub-alert">Chưa kết bạn</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
{{--                                        {{$blog_info['friend_sus']}}--}}
                                    </ul>
                                    <div class="aside-item-viewmore">
                                        <button class="btn btn-block default">
                                            <i class="icon-down-dir"></i>
                                        </button>
                                    </div>
                                @else
                                    <div class="row margin-none">
                                        <div class="col-md-12 padding-top-5 padding-bottom-5 grey">
                                            <i class="icon-emo-unhappy"></i>
                                            Không có gợi ý nào.
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                                    <!-- online friend -->
                            <div class="aside-list">
                                <header class="choidau-bg-font">
                                    <i class="icon-chat"></i>
                                    Bạn online
                                </header>
                                <ul class="list-unstyled aside-items">
                                    <li>
                                        <div class="row margin-none">
                                            <div class="col-md-8 col-sm-8 col-xs-8 col-none-padding article-img-text">
                                                <img class="avatar-pad2" src="./img-data-demo/avatar-6.JPG" alt="">

                                                <div class="aside-items-text"><b>meoconxauxi</b>

                                                    <p>12 b?n chung</p></div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-center">
                                                <div class="aside-link-web">
                                                    <a class="aside-link-web" href="#">Web <i class="icon-website"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row margin-none">
                                            <div class="col-md-8 col-sm-8 col-xs-8 col-none-padding article-img-text">
                                                <img class="avatar-pad2" src="./img-data-demo/avatar-4.JPG" alt="">

                                                <div class="aside-items-text"><b>meoconxauxi</b>

                                                    <p>12 b?n chung</p></div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-center">
                                                <div class="aside-link-web">
                                                    <a class="aside-link-web" href="#">Web <i class="icon-website"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row margin-none">
                                            <div class="col-md-8 col-sm-8 col-xs-8 col-none-padding article-img-text">
                                                <img class="avatar-pad2" src="./img-data-demo/avatar-5.JPG" alt="">

                                                <div class="aside-items-text"><b>meoconxauxi</b>

                                                    <p>12 b?n chung</p></div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-center">
                                                <div class="aside-link-web">
                                                    <a class="aside-link-web" href="#">Web <i class="icon-website"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>


                                </ul>
                                <div class="aside-item-viewmore">
                                    <button class="btn btn-block default">
                                        <i class="icon-down-dir"></i>
                                    </button>
                                </div>
                            </div>

                    </section>
                    <!-- end choidau-person-content -->

                </div>
            </div>
        </div>

    </div>

@stop