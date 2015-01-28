@extends('site.layouts.default')
@section('content')
<div id="choidau-person">

@include('site.user.blog.header')

<div class="person-body">
<div class="row margin-none">
<div class="col-md-9 col-none-padding person-body-content">
<section class="person-content choidau-bg">
<div class="row person-content-item form-add-status" style="padding-bottom: 10px;">

    <div class="action-comment">
        <header class="action-comment-subject text-weight600">Cập nhật trạng thái</header>
        <div class="action-comment-input">
            <textarea name="content-status" id="content-status" placeholder="bạn đang nghĩ gì ?" rows="3" style="width: 100%;padding: 0; border: none;"></textarea>

        </div>
        <div class="text-right action-comment-submit">
            <div class="btn-group person-type-scopy margin-none">
                <button type="button" id="privacy-status" value_id="18" class="btn btn-default btn-xs">Công khai</button>
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

<div class="row person-content-item">
    <div class="col-md-12 col-none-padding">
        <div class="col-md-9 article-img-text col-none-padding">
            <img class="avatar-pad2" src="./img-data-demo/avatar-2.JPG" alt="">
            <div class="person-content-info">
                <div><a>moonlovesun</a><span> - Newbie</span></div>
                <span>đã check địa điểm này</span><br>
                <span>01/01/2014 - 05:15</span>
            </div>
        </div>
        <div class="col-md-3 col-none-padding text-right">
            <div class="btn-group person-type-scopy">
                <button type="button" class="btn btn-default btn-xs">Công khai</button>
                <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="icon-down-dir"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>Công khai</li>
                    <li>Bạn bè</li>
                    <li>Nhóm</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-none-padding person-content-article">
        <div class="row margin-none">
            <section class="article-img-text clearfix content-article-wrapper">
                <div class="text-algin-img">
                    <article>
                        Trong thời tiết lạnh giá của mùa đông thế này, ngồi quay quần bên
                        chiếc bếp than hồng hay nồi lẩu bốc khói nghi ngút, hẳn là một lựa
                        chọn tuyệt vời cho các teen nhà mình phải không? Vì thế hôm nay
                        chúng tớ giới thiệu cho các bạn một địa chỉ mà chúng tớ mới khám phá
                        ra, đó là ...
                    </article>
                </div>
            </section>
        </div>
    </div>
    <!-- comment - like - share -->
    <div class="row margin-none">
        <div class="person-text-assoc">
            <a href="#">Thích</a>
            <a href="#">Bình luận</a>
            <a href="#">Chia sẻ</a>
        </div>
    </div>

    <!-- comment - like - share -->
    <div class="row margin-none person-command">
        <div class="col-md-12 col-none-padding">
            <a href=""><i class="icon-thumbs-up-alt"></i></a>
            <span>12</span> người thích điều này
        </div>
        <div class="col-md-12 article-img-text col-none-padding">
            <div class="row margin-none">
                <img class="col-md-1 col-ms-1 avatar-pad2"
                     src="./img-data-demo/avatar-1.JPG" alt="">
                <input class="col-md-11 col-ms-11 col-xs-11" type="text"
                       placeholder="Viết bình luận...">
            </div>
        </div>
    </div>
</div>

<div class="row person-content-item">
    <div class="col-md-12 col-none-padding">
        <div class="col-md-9 article-img-text col-none-padding">
            <img class="avatar-pad2" src="./img-data-demo/avatar-4.JPG" alt="">
            <div class="person-content-info">
                <div><a>moonlovesun</a><span> - Newbie</span></div>
                <span>đã check địa điểm này</span><br>
                <span>01/01/2014 - 05:15</span>
            </div>
        </div>
        <div class="col-md-3 col-none-padding text-right">
            <div class="btn-group person-type-scopy">
                <button type="button" class="btn btn-default btn-xs">Công khai</button>
                <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="icon-down-dir"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>Công khai</li>
                    <li>Bạn bè</li>
                    <li>Nhóm</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-none-padding person-content-article">
        <div class="row margin-none">
            <section class="article-img-text clearfix content-article-wrapper">
                <div class="text-algin-img">
                    <article>
                        Trong thời tiết lạnh giá của mùa đông thế này, ngồi quay quần bên
                        chiếc bếp than hồng hay nồi lẩu bốc khói nghi ngút, hẳn là một lựa
                        chọn tuyệt vời cho các teen nhà mình phải không? Vì thế hôm nay
                        chúng tớ giới thiệu cho các bạn một địa chỉ mà chúng tớ mới khám phá
                        ra, đó là ...
                    </article>
                </div>
            </section>
        </div>
    </div>
    <!-- comment - like - share -->
    <div class="row margin-none">
        <div class="person-text-assoc">
            <a href="#">Thích</a>
            <a href="#">Bình luận</a>
            <a href="#">Chia sẻ</a>
        </div>
    </div>

    <!-- comment - like - share -->
    <div class="row margin-none person-command">
        <div class="col-md-12 col-none-padding">
            <a href=""><i class="icon-thumbs-up-alt"></i></a>
            <span>12</span> người thích điều này
        </div>
        <div class="col-md-12 article-img-text col-none-padding">
            <div class="row margin-none">
                <img class="col-md-1 col-ms-1 avatar-pad2"
                     src="./img-data-demo/avatar-1.JPG" alt="">
                <input class="col-md-11 col-ms-11 col-xs-11" type="text"
                       placeholder="Viết bình luận...">
            </div>
        </div>
    </div>
</div>

<div class="row person-content-item">
    <div class="col-md-12 col-none-padding">
        <div class="col-md-9 article-img-text col-none-padding">
            <img class="avatar-pad2" src="./img-data-demo/avatar-2.JPG" alt="">
            <div class="person-content-info">
                <div><a>moonlovesun</a><span> - Newbie</span></div>
                <span>đã check địa điểm này</span><br>
                <span>01/01/2014 - 05:15</span>
            </div>
        </div>
        <div class="col-md-3 col-none-padding text-right">
            <div class="btn-group person-type-scopy">
                <button type="button" class="btn btn-default btn-xs">Công khai</button>
                <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="icon-down-dir"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>a</li>
                    <li>b</li>
                    <li>c</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-none-padding person-content-article">
        <div class="row margin-none">
            <section class="article-img-text clearfix content-article-wrapper">
                <img class="avatar-pad2" src="./img-data-demo/monan-3.jpg" alt="">

                <div class="text-algin-img">
                    <header>
                        <a href="#"><h2>Sinh tố 221 Trần Hưng Đạo</h2></a>
                    </header>
                    <article>
                        Trong thời tiết lạnh giá của mùa đông thế này, ngồi quay quần bên
                        chiếc bếp than hồng hay nồi lẩu bốc khói nghi ngút, hẳn là một lựa
                        chọn tuyệt vời cho các teen nhà mình phải không? Vì thế hôm nay
                        chúng tớ giới thiệu cho các bạn một địa chỉ mà chúng tớ mới khám phá
                        ra, đó là ...
                    </article>
                    <a href="#"><i>http://choidau.net/diadiem/quanlaunuong/</i></a>
                </div>
            </section>
        </div>

        <!-- slide img -->
        <div class="row margin-none">
            <ul class="list-unstyled person-content-slide text-center">
                <li><img src="./img-data-demo/monan-4.jpg" alt=""></li>
                <li><img src="./img-data-demo/monan-2.jpg" alt=""></li>
                <li><img src="./img-data-demo/monan-3.jpg" alt=""></li>
                <li><img src="./img-data-demo/monan-4.jpg" alt=""></li>
                <li><img src="./img-data-demo/monan-5.jpg" alt=""></li>
                <li><img src="./img-data-demo/monan-6.jpg" alt=""></li>
                <li><img src="./img-data-demo/monan-1.jpg" alt=""></li>
                <li><img src="./img-data-demo/monan-6.jpg" alt=""></li>
                <li class="text-right"><button class="btn btn-default">xem thêm</button></li>
            </ul>
        </div>
    </div>
    <!-- comment - like - share -->
    <div class="row margin-none">
        <div class="person-text-assoc">
            <a href="#">Thích</a>
            <a href="#">Bình luận</a>
            <a href="#">Chia sẻ</a>
        </div>
    </div>

    <!-- comment - like - share -->
    <div class="row margin-none person-command">
        <div class="col-md-12 col-none-padding">
            <a href=""><i class="icon-thumbs-up-alt"></i></a>
            <span>12</span> người thích điều này
        </div>
        <div class="col-md-12 article-img-text col-none-padding">
            <div class="row margin-none">
                <img class="col-md-1 col-ms-1 avatar-pad2"
                     src="./img-data-demo/avatar-2.JPG" alt="">
                <input class="col-md-11 col-ms-11 col-xs-11" type="text"
                       placeholder="Viết bình luận...">
            </div>
        </div>
    </div>
</div>

<div class="row action-view-more margin-none text-center text-1em2 choidau-font">
    Xem thêm hoạt động
</div>
</section>


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
                    <div>Cấp bậc: <span>Newbie</span></div>
                </li>
                <li>
                    <div>Địa chỉ: <span>TP HCM</span></div>
                </li>
                <li>
                    <div>Ngày sinh: <span>25/11/1995</div>
                    </span></li>
                <li>
                    <div>Đã theo dõi: <span>34 người</span></div>
                </li>
                <li>
                    <div>Được theo dõi: <span>115 người</span></div>
                </li>
                <li>
                    <div>Số lượt thích: <span>430</span></div>
                </li>
            </ul>
        </div>

        <!-- add friend -->
        <div class="aside-list">
            <header class="choidau-bg-font">
                <i class="icon-user-add"></i>
                Gợi ý kết bạn
            </header>
            <!--goi y ket ban-->
            <ul class="list-unstyled aside-items">
                <li>
                    <div class="row margin-none">
                        <div class="col-md-8 col-sm-8 col-xs-8 col-none-padding article-img-text">
                            <img class="avatar-pad2" src="./img-data-demo/avatar-1.JPG" alt="">
                            <div class="aside-items-text">
                                <b>meoconxauxi</b>
                                <p>12 bạn chung</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-center">
                            <button class="btn btn-default btn-aside-add-friend">
                                <i class="icon-user-add"> </i> Kết bạn
                            </button>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row margin-none">
                        <div class="col-md-8 col-sm-8 col-xs-8 col-none-padding article-img-text">
                            <img class="avatar-pad2" src="./img-data-demo/avatar-2.JPG" alt="">
                            <div class="aside-items-text">
                                <b>cobelolem</b>
                                <p>12 bạn chung</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-center">
                            <button class="btn btn-default btn-aside-add-friend">
                                <i class="icon-user-add"> </i> Kết bạn
                            </button>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row margin-none">
                        <div class="col-md-8 col-sm-8 col-xs-8 col-none-padding article-img-text">
                            <img class="avatar-pad2" src="./img-data-demo/avatar-3.JPG" alt="">
                            <div class="aside-items-text">
                                <b>emxinhtuoi</b>
                                <p>12 bạn chung</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-center">
                            <button class="btn btn-default btn-aside-add-friend">
                                <i class="icon-user-add"> </i> Kết bạn
                            </button>
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

        <!-- online friend -->
        <div class="aside-list">
            <header class="choidau-bg-font">
                <i class="icon-chat"></i>
                Bạn bè đang online
            </header>
            <ul class="list-unstyled aside-items">
                <li>
                    <div class="row margin-none">
                        <div class="col-md-8 col-sm-8 col-xs-8 col-none-padding article-img-text">
                            <img class="avatar-pad2" src="./img-data-demo/avatar-6.JPG" alt="">

                            <div class="aside-items-text"><b>meoconxauxi</b>

                                <p>12 bạn chung</p></div>
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

                                <p>12 bạn chung</p></div>
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

                                <p>12 bạn chung</p></div>
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