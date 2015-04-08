<div class="header-top">
    <div class="row ">
        <div style="" class="header-top-content">
            <div class="col-xs-12 col-sm-12 col-md-3">&nbsp; Hotline : 1900 59 59 59</div>
            <div class="col-md-6 col-xs-12 col-sm-12"> Email :hotrokhachhang@choidau.net</div>
            <div class="col-md-3 col-xs-12 col-sm-12 text-right padding-right-20">
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

        </div>
    </div>
</div>

<div class="header-middle">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-2" style="position: relative;">
                <a href="/"><img class="logo" src="{{asset("assets/frontend/layout/img/logo.png")}}" width="150px"
                                 height="60px"/></a>
            </div>
            <div class="col-md-10 header-middle-right">
                <div class="row margin-none">
                    <div class="box-search">

                        <div class="col-md-2 col-xs-12 col-sm-12 col-none-padding">
                            <div class="form-group margin-bottom-0">
                                <select class="form-control" id="provinceList">
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

                        <div class="col-md-4  col-xs-12 col-sm-12">
                            <div class="input-group">
                                <input type="text" class="form-control" style="border:none;"
                                       id="header-input-string-search" placeholder="Hãy nhập từ khoá bạn cần tìm ?">
                                <span class="input-group-addon">
                                    <i class="icon-menu-1"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-2 margin-top-5 box-add-location">
                        <a style="font-weight: bold;font-size: 0.9em;" class="btn-create-location require-login"
                           data-url="{{{URL::to('/dia-diem/tao-dia-diem')}}}"
                           href="{{{URL::to('/dia-diem/tao-dia-diem')}}}"> +Thêm địa điểm</a>
                    </div>
                    <div class="col-md-4 margin-top-10 box-infor-user text-right padding-right-5 notifications">
                        @if (Auth::check())
                            <ul>
                                <li>
                                    <a href="{{{ URL::to('trang-ca-nhan/'.Auth::user()->username.'.html') }}}">
                                        	<img class="thubnail" width="34" src="{{Auth::user()->avatar}}" alt="{{{ Auth::user()->display_name() }}}">
                                            {{{ Auth::user()->display_name() }}}
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

