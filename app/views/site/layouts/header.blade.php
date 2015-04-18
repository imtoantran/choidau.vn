<?php
    $social = Social::orderBy('id','ASC')->whereType('social')->whereStatus(1)->get();
    $hostline= Social::whereType('hotline')->whereStatus(1)->first();
    $email= Social::whereType('email')->whereStatus(1)->first();
?>

<div class="header-top">
    <div class="row ">
        <div style="" class="header-top-content">
            <div class="col-xs-12 col-sm-12 col-md-3">&nbsp;
                @if(count($hostline) && !empty($hostline->content))
                    {{$hostline->title}} : {{$hostline->content}}
                @endif
            </div>
            <div class="col-md-6 col-xs-12 col-sm-12">
                @if(count($email) && !empty($email->content))
                    {{$email->title}} : {{$email->content}}
                @endif
            </div>
            <div class="col-md-3 col-xs-12 col-sm-12 text-right padding-right-20">
                <ul class="list-unstyled list-inline">
                    @if(count($social))
                        @foreach($social as $key=>$val)
                            <li class="tooltips" data-original-title="{{$val->title}}" data-placement="bottom">
                                <a href="@if(empty($val->content)){{'#'}}@else{{$val->content}}@endif" target="_blank">
                                    <i class="icon-{{$val->icon}} white"></i>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

        </div>
    </div>
</div>

<div class="header-middle">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="position: relative;">
                <a href="/">
                    <img class="logo" src="{{asset("assets/frontend/layout/img/logo.png")}}" width="150px" height="60px"/>
                </a>
            </div>
            <div class="col-md-10 header-middle-right padding-0">
                <div class="row margin-none">
                    {{-- head tool-left --}}
                    <div class="sticker-left col-md-8 col-md-offset-0 padding-5">
                        <div class="row margin-none">
                            <div class="box-search pull-left">
                                <div class="row margin-none">
                                    <div class="col-md-4 col-xs-12 col-sm-12 col-none-padding">
                                        <div class="form-group margin-bottom-0">
                                            {{--<label for="single-append-radio" class="control-label">Select2 multi append Radiobutton</label>--}}
                                            <div class="input-group select2-bootstrap-prepend">
                                            <span class="input-group-addon">
                                                <i class="icon-location"></i>
                                            </span>
                                                <select class="form-control padding-5" id="provinceList" >
                                                    @foreach(Cache::get("provinces") as $province)
                                                        @if($province->id == 79)
                                                            <option class="province-mark"
                                                                    value="{{$province->id}}" @if($province->id == Session::get("province")->id)
                                                                    selected @endif>{{$province->name}}</option>
                                                        @else
                                                            <option value="{{$province->id}}" @if($province->id == Session::get("province")->id)
                                                                    selected @endif>{{$province->name}}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-xs-12 col-sm-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" style="border:none;"
                                                   id="header-input-string-search" placeholder="Tìm địa điểm...">
                                            <span class="input-group-addon">
                                                <i class="icon-search"></i>
                                            </span>
                                        </div>
                                    </div>

                                    {{--them dia diem--}}
                                    <div class="col-md-3 col-xs-12 col-sm-12 padding-left-0">
                                        <a style="font-weight: 600; font-size: 1.1em; line-height: 34px;" class="btn-create-location require-login"
                                           data-url="{{{URL::to('/dia-diem/tao-dia-diem')}}}"
                                           href="{{{URL::to('/dia-diem/tao-dia-diem')}}}"> +Thêm địa điểm</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- head tool-right --}}
                    <div class="sticker-right col-md-4 col-md-offset-right-0 padding-5">
                        <div class="margin-top-10 box-infor-user text-right notifications">
                            @if (Auth::check())
                                <ul>
                                    <li>
                                        <a class="font-weight-600" href="{{{ URL::to('trang-ca-nhan/'.Auth::user()->username.'.html') }}}">
                                            <img class="img-circle padding-1" style="border: 1px solid #fff;" width="36" src="{{Auth::user()->avatar}}" alt="{{{ Auth::user()->display_name() }}}">{{{Auth::user()->display_name()}}}
                                        </a>
                                    </li>
                                    {{-- imtoantran chat and general notifications start --}}
                                    <li class="dropdown notif" id="messages">
                                        <a class="tooltips dropdown-toggle icon-badge-number" data-placement="bottom"  data-toggle="dropdown" data-original-title="Tin nhắn mới">
                                            <i class="icon-chat-1 icon-badge"></i>
                                            <span class="badge badge-default"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right pull-right" role="menu">
                                            <div>Inbox</div>
                                            <div><a href="#">Xem tất cả</a></div>
                                        </ul>
                                    </li>
                                    <li class="dropdown notif" id="general-notifications">
                                        <a class="tooltips dropdown-toggle icon-badge-number" data-placement="bottom" data-toggle="dropdown" data-original-title="Hoạt động mới">
                                            <i class="icon-globe icon-badge"></i>
                                            <span class="badge badge-default"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right pull-right" role="menu">
                                            <div>Hoạt động từ bạn bè của tôi</div>
                                            <div><a href="#">Xem tất cả</a></div>
                                        </ul>
                                    </li>
                                    {{-- imtoantran chat and general notifications stop --}}
                                    <li class="wrapper-confirm-friends">
                                        <?php
                                        $user = Auth::user();
                                        $num_confirm = count(json_decode($user->referFriendConfirm()->withPivot('status_id')->wherePivot('status_id', '=', 35)->get(['user_id']), true));
                                        ?>
                                        @if($num_confirm>0)
                                            <a href="{{{ URL::to('trang-ca-nhan/'.$user->username.'.html') }}}"
                                               class="tooltips dropdown-toggle icon-badge-number margin-left-10"
                                               data-original-title="Lời mời kết bạn" data-toggle="dropdown"
                                               data-hover="dropdown" data-close-others="true" aria-expanded="true">
                                                <i class="icon-users" style="font-size: 20px;"></i>
                                                <span class="badge total-confirm-friends">{{$num_confirm}}</span>
                                            </a>
                                            <ul class="dropdown-menu extended tasks add-friend list-confirm-friends">

                                            </ul>
                                        @endif
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" style="padding-right:11px;" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                            <span class="icon icon-down-dir"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right pull-right" role="menu">
                                            {{--                                        @if (Auth::user()->hasRole('Administrator'))--}}
                                            @if(Auth::user()->hasLoginAdmin())
                                                <li role="presentation">
                                                    <a role="menuitem" tabindex="-1" href="{{{ URL::to('qtri-choidau') }}}">Control
                                                        Panel</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{{ URL::to('thanh-vien/dang-xuat.html') }}}">Đăng xuất</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                            @else
                                <ul>
                                    <li>
                                        <a class="header-logout-a require-login"
                                           data-url="{{URL::current();}}" {{ (Request::is('user/login') ? ' class="active"' : '') }}
                                           href="javascript:void(0);">Đăng nhập</a> /
                                        <a class="header-logout-a" {{ (Request::is('user/create') ? ' class="active"' : '') }}
                                           href="{{{ URL::to('thanh-vien/dang-ky.html')}}}">Đăng ký</a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="col-md-12 toolbar-top">
    <div class="col-md-1 pull-left padding-left-0" style="margin-top:4px"><a href="#" class="mobi_search"><i
                    class="icon-search-outline icon-circle-radius"></i></a></div>
    <div class="col-md-2 pull-left padding-left-0" style="margin-top:6px"><a href="#"><i class="icon-images"><img
                        width="36px" height="36px" src="{{asset("assets/frontend/layout/img/icons/location_add.png")}}"></i></a>
    </div>
    <div class="col-md-2 pull-right padding-right-0"><a href="#" class="mobi_menubar"><i
                    class="icon-menu icon-circle-radius"></i></a></div>
</div>
<div class="header-bottom">
    <div class="">
        <nav class="header-navigation font-transform-inherit">
            <ul>
                <li><a href="{{URL::to(Session::get("province")->slug)."/an"}}"><span> ăn </span> <i class="icon-food"></i></a></li>
                <li><a href="{{URL::to(Session::get("province")->slug)."/uong"}}"><span> uống </span> <i class="icon-bar"></i></a></li>
                <li><a href="{{URL::to(Session::get("province")->slug)."/di"}}"><span>đi </span> <i class="icon-school"></i></a></li>
                <li><a href="{{URL::to("video.html")}}"><span>video </span> <i class="icon-videocam-3"></i></a></li>
                <li><a href="{{URL::to("blog.html")}}"><span>blog </span> <i class="icon-cloud-thunder"></i></a></li>
                <li><a href="{{URL::to("faq.html")}}"><span>hỏi đáp</span> <i class="icon-wechat"></i></a></li>
            </ul>
        </nav>
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function () {
//            var stickyNavTop = $('.header-middle-right').offset().top;
//
//            var stickyNav = function() {
//                var scrollTop = $(window).scrollTop();
//
//                if (scrollTop > stickyNavTop) {
//                    $('.header-middle-right').addClass('sticky');
//                } else {
//                    $('.header-middle-right').removeClass('sticky');
//                }
//            }
//            stickyNav();
//            $(window).scroll(function() {
//                stickyNav();
//                console.log('vdsfvd');
//            });
        });
    </script>
@stop

