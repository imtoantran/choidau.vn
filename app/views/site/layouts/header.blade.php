
<div class="header-top">
    <div class="row ">
        <div style="" class="header-top-content">
            <div class="col-xs-12 col-sm-12 col-md-3">Hotline : 1900 59 59 59 </div>
            <div class="col-md-6 col-xs-12 col-sm-12"> Email :hotrokhachhang@choidau.net</div>
            <div class="col-md-3 col-xs-12 col-sm-12">
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
                <div class="row">
                    <div class="box-search">

                        <div class="col-md-2 col-xs-12 col-sm-12" style="padding-bottom:5px">
                            <div class="form-group margin-bottom-0">
                                <select class="form-control">


                                    @if (Cache::has('listProvince'))

                                    <?php   $listProvince = Cache::get('listProvince');?>

                                    @else
                                    <?php $listProvince=Province::all();?>

                                    <?php Cache::forever('listProvince', $listProvince);?>

                                    @endif

                                    @foreach($listProvince as $item)
                                    <option>{{$item->name}}</option>
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
                    <div class=" col-md-3 margin-top-10 box-add-location" >
                       <a href="{{URL::to("dia-diem/tao-dia-diem")}}">  +Thêm địa điểm</a>
                    </div>

                    <div class="col-md-3 margin-top-10 box-infor-user" >
                        <i class="icon-user-7"></i>

                        @if (Auth::check())
                            @if (Auth::user()->hasRole('admin'))
                                <li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
                            @endif
                            <a href="{{{ URL::to('thanh-vien') }}}">{{{ Auth::user()->username }}}</a>
                            <a href="{{{ URL::to('thanh-vien/dang-xuat.html') }}}">Đăng xuất</a>
                            <a href="{{{ URL::to('trang-ca-nhan/'.Auth::user()->username.'.html') }}}" class="dropdown-toggle icon-badge-number" >
                                <i class="icon-bell"></i>
                                        <span class="badge badge-default">
                                            7 </span>
                            </a>
                        @else
                            <a {{ (Request::is('user/login') ? ' class="active"' : '') }} href="{{{ URL::to('thanh-vien/dang-nhap.html') }}}">Login</a>
                            <a {{ (Request::is('user/create') ? ' class="active"' : '') }} href="{{{ URL::to('thanh-vien/dang-ky.html') }}}">{{{ Lang::get('site.sign_up') }}}</a>
                        @endif





                    </div>

                </div>


            </div>
        </div>
    </div>

</div>
<div class="col-md-12 toolbar-top">
    <div class="col-md-1 pull-left" style="margin-top:4px"><a href="#" class="mobi_search"><i class="icon-search-outline icon-circle-radius"></i></a></div>
    <div class="col-md-2 pull-left" style="margin-top:6px"><a href="#"  ><i class="icon-images"><img width="36px" height="36px" src="{{asset("assets/frontend/layout/img/icons/location_add.png")}}"></i></a></div>
    <div class="col-md-2 pull-right"><a href="#" class="mobi_menubar" ><i class="icon-menu icon-circle-radius"></i></a></div>
</div>
<div class="header-bottom">
    <div class="">
        <nav class="header-navigation font-transform-inherit">
            <ul>
                <li><a href="#">ăn <i class="icon-food"></i></a></li>
                <li><a href="#">uống <i class="icon-bar"></i></a></li>
                <li><a href="#">đi <i class="icon-school"></i></a></li>
                <li><a href="#">video <i class="icon-videocam-3"></i></a></li>
                <li><a href="{{URL::to("blog.html")}}">blog <i class="icon-cloud-thunder"></i></a></li>
                <li><a href="#">hỏi đáp<i class="icon-wechat"></i></a></li>
                <li class="nav-li-last" style=""><a href="#">hổ trợ<i class="icon-lifebuoy"></i></a></li>
            </ul>
        </nav>
    </div>

</div>

