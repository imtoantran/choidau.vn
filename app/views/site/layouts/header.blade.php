
<div class="header-top">
    <div class="row ">
        <div style="" class="header-top-content">
            <div class="col-xs-12 col-sm-12 col-md-3">&nbsp; Hotline : 1900 59 59 59 </div>
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
                <a href="/"><img class="logo" src="{{asset("assets/frontend/layout/img/logo.png")}}" width="150px" height="60px" /></a>
            </div>
            <div class="col-md-10 header-middle-right">
                <div class="row margin-none">
                    <div class="box-search">

                        <div class="col-md-2 col-xs-12 col-sm-12 col-none-padding">
                            <div class="form-group margin-bottom-0">
                                <select class="form-control" id="provinceList">
                                    @foreach(Cache::get("provinces") as $province)
                                        @if($province->id == 79)
                                            <option class="province-mark" value="{{$province->id}}" @if($province->id == Session::get("province")->id) selected @endif>{{$province->name}}</option>
                                        @else
                                            <option value="{{$province->id}}" @if($province->id == Session::get("province")->id) selected @endif>{{$province->name}}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4  col-xs-12 col-sm-12" >
                            <div class="input-group">
                                <input type="text" class="form-control" style="border:none;" id="header-input-string-search" placeholder="Hãy nhập từ khoá bạn cần tìm ?">
                                <span class="input-group-addon">
                                    <i class="icon-menu-1"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-3 margin-top-5 box-add-location" >
                       <a style="font-weight: bold;font-size: 0.9em;" class="btn-create-location require-login"  data-url="{{{URL::to('/dia-diem/tao-dia-diem')}}}" href="{{{URL::to('/dia-diem/tao-dia-diem')}}}">  +Thêm địa điểm</a>
                    </div>
                    <div class="col-md-3 margin-top-10 box-infor-user text-right padding-right-5">
                        @if (Auth::check())
                            <i class="icon-user-7"></i>
                            @if (Auth::user()->hasRole('admin'))
                                <li><a href="{{{ URL::to('qtri-choidau') }}}">Admin Panel</a></li>
                            @endif
                            <a style="font-weight: 600;" href="{{{ URL::to('thanh-vien') }}}">
                                @if(empty(Auth::user()->fullname))
                                    {{{ Auth::user()->username }}}
                                @else
                                    {{{ Auth::user()->fullname }}}
                                @endif
                            </a>
                            <a class="header-logout-a" href="{{{ URL::to('thanh-vien/dang-xuat.html') }}}">Đăng xuất</a>
                            <a href="{{{ URL::to('trang-ca-nhan/'.Auth::user()->username.'.html') }}}" class="dropdown-toggle icon-badge-number" >
                                <i class="icon-bell"></i>
                                <span class="badge badge-default"> 7 </span>
                            </a>
                        @else
                            {{--<a class="header-logout-a" {{ (Request::is('user/login') ? ' class="active"' : '') }} href="{{{ URL::to('thanh-vien/dang-nhap.html') }}}">Đăng nhập</a> /--}}
                            {{--<a class="header-logout-a" {{ (Request::is('user/create') ? ' class="active"' : '') }} href="{{{ URL::to('thanh-vien/dang-ky.html') }}}">Đăng ký</a>--}}
                            <a class="header-logout-a require-login" data-url="{{URL::current();}}" {{ (Request::is('user/login') ? ' class="active"' : '') }} href="javascript:void()">Đăng nhập</a> /
                            <a class="header-logout-a" {{ (Request::is('user/create') ? ' class="active"' : '') }} href="{{{ URL::to('thanh-vien/dang-ky.html')}}}">Đăng ký</a>
                        @endif
                    </div>

                </div>


            </div>
        </div>
    </div>

</div>
<div class="col-md-12 toolbar-top">
    <div class="col-md-1 pull-left padding-left-0" style="margin-top:4px"><a href="#" class="mobi_search"><i class="icon-search-outline icon-circle-radius"></i></a></div>
    <div class="col-md-2 pull-left padding-left-0" style="margin-top:6px"><a href="#"  ><i class="icon-images"><img width="36px" height="36px" src="{{asset("assets/frontend/layout/img/icons/location_add.png")}}"></i></a></div>
    <div class="col-md-2 pull-right padding-right-0"><a href="#" class="mobi_menubar" ><i class="icon-menu icon-circle-radius"></i></a></div>
</div>
<div class="header-bottom">
    <div class="">
        <nav class="header-navigation font-transform-inherit">
            <ul>
                <li><a href="{{URL::to(Session::get("province")->slug)."/an"}}"><span> ăn </span> <i class="icon-food"></i></a></li>
                <li><a href="{{URL::to(Session::get("province")->slug)."/uong"}}"><span> uống </span> <i class="icon-bar"></i></a></li>
                <li><a href="{{URL::to(Session::get("province")->slug)."/di"}}"><span>đi </span> <i class="icon-school"></i></a></li>
                <li><a href="#"><span>video </span> <i class="icon-videocam-3"></i></a></li>
                <li><a href="{{URL::to("blog.html")}}"><span>blog </span> <i class="icon-cloud-thunder"></i></a></li>
                <li><a href="#"><span>hỏi đáp</span> <i class="icon-wechat"></i></a></li>
                <li class="nav-li-last" style=""><a href="#"><span>hổ trợ</span> <i class="icon-lifebuoy"></i></a></li>
            </ul>
        </nav>
    </div>

</div>

