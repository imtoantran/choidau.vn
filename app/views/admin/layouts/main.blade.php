<?php
$user = '';
if(Auth::check()){
    $user = Auth::user();
    if(empty($user['avatar'])){
        $user['avatar'] = 'assets/global/img/no-image.png';
    }
    $user['user_name'] = $user->display_name();
}

?>

<!DOCTYPE html>

<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Choidau | Admin Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/fontello/css/fontello.css')}}" rel="stylesheet">
    {{--    <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet"
          href="{{asset("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}">
    {{--    <link href="{{asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>--}}
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet" type="text/css"/>
    {{--    <link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css"/>--}}
    {{--    <link href="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css"/>--}}
    {{--    <link href="{{asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css"/>--}}
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="{{asset('assets/admin/pages/css/tasks.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{asset('assets/global/css/components.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/layout/css/layout.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/layout/css/themes/default.css')}}" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="{{asset('assets/global/plugins/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/layout/css/custom.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/fontello/css/animation.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/global/plugins/fancybox-v3beta/jquery.fancybox-thumbs.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/global/plugins/fancybox-v3beta/jquery.fancybox.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">

    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
    @yield('styles')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-quick-sidebar-over-content page-header-fixed page-sidebar-fixed page-footer-fixed">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">

    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{URL::to('qtri-choidau')}}" style="font-size: 1.2em; color: #fff; line-height: 44px;">
                Admin <span style="color:#ff3f3f;">Dashboard</span>
                {{--<img src="assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/>--}}
            </a>

            <div class="menu-toggler sidebar-toggler hide">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- END TODO DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="{{URL::to('/trang-ca-nhan/profile').'/'.$user['username'].'.html'}}" class="dropdown-toggle"   data-close-others="true" style="  padding: 13px 8px 12px 10px;">
                        <img alt="" class="img-circle" src="{{$user['avatar']}}" style="box-shadow: 0px 0px 2px #fff;"/>
					<span class="username username-hide-on-mobile" style="font-weight: 600;">
					    {{$user['user_name']}}
                    </span>
                    </a>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="{{{ URL::to('thanh-vien/dang-xuat.html') }}}" class="dropdown-toggle tooltips" data-original-title="Đăng xuất">
                        <i class="icon-logout"></i>
                    </a>
                </li>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
{{--                    <img width="150px" height="60px" src="{{URL::to('assets/frontend/layout/img/logo.png')}}" alt=""/>--}}
                    <div class="sidebar-toggler">
                    </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                {{--dash board--}}
                <li class="start">
                    <a href="{{URL::to("qtri-choidau")}}">
                        <i class="icon-desktop-3"></i>
                        <span class="title">Dash board</span>
                        <span class="selected"></span>
                    </a>
                </li>

                {{--location--}}
                @if(Entrust::can('manage_location'))
                    <li @if(Request::is("qtri-choidau/location*")) class="open active" @endif>
                        <a href="#"><i class="icon-location-7"></i><span class="title"> ĐỊA ĐIỂM</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li @if(Request::is("qtri-choidau/location/")) class="active" @endif>
                                <a href="{{URL::to("qtri-choidau/location/")}}">Danh sách địa điểm</a>
                            </li>
                            <li @if(Request::is("qtri-choidau/location/review*")) class="active" @endif>
                                <a href="{{URL::to("qtri-choidau/location/review")}}">Review</a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{--post--}}
                @if(Entrust::can('manage_post'))
                    <li @if(str_contains(Route::currentRouteAction(),"AdminBlog")) class="active" @endif>
                        <a href="{{URL::to("qtri-choidau/blog")}}">
                            <i class="icon-pen"></i>
                            <span class="title">BÀI VIẾT</span>
                        </a>
                    </li>
                @endif

                {{--media--}}
                @if(Entrust::can('manage_media'))
                    <li @if(Request::is("qtri-choidau/media*")) class="open active" @endif>
                        <a href="#"><i class="icon-video-3"></i><span class="title">MEDIA</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li @if(Request::is("qtri-choidau/media/video*")) class="active" @endif>
                                <a href="{{URL::to("qtri-choidau/media/video")}}"><i class="icon-video-3"></i> Video</a>
                            </li>
                            <li @if(Request::is("qtri-choidau/media/image*")) class="open active" @endif>
                                <a href="#">
                                    <i class="icon-photo-1"></i> Hình ảnh
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li @if(Request::is("qtri-choidau/media/image/admin-location*")) class=" active" @endif>
                                        <a href="{{URL::to("qtri-choidau/media/image/admin-location")}}"><i class="icon-user"></i><small> Admin đăng địa điểm</small></a>
                                    </li>
                                    <li @if(Request::is("qtri-choidau/media/image/admin-review*")) class=" active" @endif>
                                        <a href="{{URL::to("qtri-choidau/media/image/admin-review")}}"><i class="icon-user"></i> </i><small> Admin đánh giá</small></a>
                                    </li>

                                    <li @if(Request::is("qtri-choidau/media/image")||Request::is("qtri-choidau/media/image/user-location*")) class="active" @endif>
                                        <a href="{{URL::to("qtri-choidau/media/image/user-location")}}"><i class="icon-group-circled"></i><small> User đăng địa điểm</small></a>
                                    </li>
                                    <li @if(Request::is("qtri-choidau/media/image/user-review*")) class="active" @endif>
                                        <a href="{{URL::to("qtri-choidau/media/image/user-review")}}"><i class="icon-group-circled"></i><small> User đánh giá</small></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif

                {{--FAQ--}}
                @if(Entrust::can('manage_faq'))
                    <li @if(Request::is("qtri-choidau/hoi-dap*")) class="open active" @endif>
                        <a href="{{URL::to("qtri-choidau/hoi-dap/")}}"><i class="icon-chat-empty"></i><span class="title">HỎI ĐÁP</span></a>
                    </li>
                @endif

                {{--USER--}}
                @if(Entrust::can('manage_user'))
                    <li @if(Request::is("qtri-choidau/users*")) class="open active" @endif>
                        <a href="#"><i class="icon-user-outline"></i><span class="title"> THÀNH VIÊN</span>
                            <span class="arrow @if(Request::is("qtri-choidau/users")) open @endif"></span>
                        </a>
                        <ul class="sub-menu">
                            <li @if(Request::is("qtri-choidau/users")) class="active" @endif>
                                <a @if(!Request::is("qtri-choidau/users")) href="{{URL::to("qtri-choidau/users")}}" @endif >
                                    <i class="icon icon-list"></i> Danh sách thành viên</a>
                            </li>
                            <li>
                                <a href="{{URL::to("qtri-choidau/users/create")}}">
                                    <i class="glyphicon glyphicon-plus-sign"></i> Thêm thành viên
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{--USER GROUP--}}
                @if(Entrust::can('manage_user_group'))
                    <li @if(Request::is("qtri-choidau/roles*")) class="active" @endif>
                        <a @if(!Request::is("qtri-choidau/roles")) href="{{URL::to("qtri-choidau/roles")}}" @endif>
                            <i class="icon icon-group"></i>
                            Nhóm thành viên
                        </a>
                    </li>
                @endif

                {{--ADS--}}
                @if(Entrust::can('manage_ads'))
                    <li>
                        <a href="#"><i class="icon-star-1"></i><span class="title"> QUẢNG CÁO</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#">Danh sách quảng cáo</a> </li>
                            <li><a href="#">Thêm quảng cáo</a></li>
                            <li><a href="#">Cài đặt quảng cáo</a></li>
                        </ul>
                    </li>
                @endif

                {{--SLIDER--}}
                @if(Entrust::can('manager_slider'))
                    <li>
                        <a href="#"><i class="icon-leaf"></i><span class="title">SLIDER</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#">Danh sách slider</a></li>
                            <li><a href="#">Thêm slider</a></li>
                            <li><a href="#">Cài đặt slider</a></li>
                        </ul>
                    </li>
                @endif


                {{--SETTING--}}
                @if(Entrust::can('manager_setting'))
                    <li @if(Request::is("qtri-choidau/setting*")) class="active" @endif>
                        <a href="javascript:;">
                            <i class="icon-cogs"></i>
                            <span class="title">CÀI ĐẶT</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="#"><i class="icon-home"></i>Giao diện</a></li>
                            <li><a href="#"><i class="icon-home"></i>Nội dung</a></li>
                            <li><a href="ecommerce_orders.html"><i class="icon-basket"></i>Editer</a></li>
                            <li><a href="ecommerce_orders_view.html"><i class="icon-tag"></i>Popup</a></li>
                            <li @if(Request::is("qtri-choidau/setting/script*")) class="active" @endif>
                                <a href="{{URL::to("qtri-choidau/setting/script")}}"><i class="icon-code"></i> Script</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->


    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">

            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Widget settings form goes here
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn blue">Save changes</button>
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

            <!-- END STYLE CUSTOMIZER -->
            <!-- BEGIN PAGE HEADER-->

            <h3 class="page-title">
                <i class="font-16px font-weight-600 @if(isset($page_icon)){{$page_icon}}@else{{'icon-desktop-1'}}@endif"></i>
                <span class="font-weight-600" style="font-size: 18px;">
                    @if(isset($page_name)){{$page_name}}@else{{'Trang quản trị'}}@endif
                </span>
                <small>
                    @if(isset($detail_name_page))
                        - {{$detail_name_page}}
                    @endif
                </small>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="{{URL::to('qtri-choidau')}}">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="@if(isset($url_page)){{$url_page}} @endif">
                            @if(isset($name_page)){{$name_page}}  @endif
                        </a>
                    </li>
                </ul>

            </div>
            <!-- END PAGE HEADER-->
            @include('notifications')

            <!-- Main Content Admin Choidau start-->
            @section('content')
                <h1>Lỗi load trang</h1>
                @show
                        <!-- Main Content Admin Choidau end-->
        </div>
    </div>
    <!-- END CONTENT -->


    <!-- BEGIN QUICK SIDEBAR -->
    <a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>

    <div class="page-quick-sidebar-wrapper">
        <div class="page-quick-sidebar">
            <div class="nav-justified">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#quick_sidebar_tab_1" data-toggle="tab">
                            Users <span class="badge badge-danger">2</span>
                        </a>
                    </li>
                    <li>
                        <a href="#quick_sidebar_tab_2" data-toggle="tab">
                            Alerts <span class="badge badge-success">7</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            More<i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                    <i class="icon-bell"></i> Alerts </a>
                            </li>
                            <li>
                                <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                    <i class="icon-info"></i> Notifications </a>
                            </li>
                            <li>
                                <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                    <i class="icon-speech"></i> Activities </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a href="#quick_sidebar_tab_3" data-toggle="tab">
                                    <i class="icon-settings"></i> Settings </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                        <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd"
                             data-wrapper-class="page-quick-sidebar-list">
                            <h3 class="list-heading">Staff</h3>
                            <ul class="media-list list-items">
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-success">8</span>
                                    </div>
                                    <img class="media-object" src="{{asset("assets/admin/layout/img/avatar3.jpg")}}"
                                         alt="...">

                                    <div class="media-body">
                                        <h4 class="media-heading">Bob Nilson</h4>

                                        <div class="media-heading-sub">
                                            Project Manager
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="media-object" src="{{asset("assets/admin/layout/img/avatar1.jpg")}}"
                                         alt="...">

                                    <div class="media-body">
                                        <h4 class="media-heading">Nick Larson</h4>

                                        <div class="media-heading-sub">
                                            Art Director
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-danger">3</span>
                                    </div>
                                    <img class="media-object" src="{{asset("assets/admin/layout/img/avatar4.jpg")}}"
                                         alt="...">

                                    <div class="media-body">
                                        <h4 class="media-heading">Deon Hubert</h4>

                                        <div class="media-heading-sub">
                                            CTO
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="media-object" src="{{asset("assets/admin/layout/img/avatar2.jpg")}}"
                                         alt="...">

                                    <div class="media-body">
                                        <h4 class="media-heading">Ella Wong</h4>

                                        <div class="media-heading-sub">
                                            CEO
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <h3 class="list-heading">Customers</h3>
                            <ul class="media-list list-items">
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-warning">2</span>
                                    </div>
                                    <img class="media-object" src="{{asset("assets/admin/layout/img/avatar6.jpg")}}"
                                         alt="...">

                                    <div class="media-body">
                                        <h4 class="media-heading">Lara Kunis</h4>

                                        <div class="media-heading-sub">
                                            CEO, Loop Inc
                                        </div>
                                        <div class="media-heading-small">
                                            Last seen 03:10 AM
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="label label-sm label-success">new</span>
                                    </div>
                                    <img class="media-object" src="{{asset("assets/admin/layout/img/avatar7.jpg")}}"
                                         alt="...">

                                    <div class="media-body">
                                        <h4 class="media-heading">Ernie Kyllonen</h4>

                                        <div class="media-heading-sub">
                                            Project Manager,<br>
                                            SmartBizz PTL
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="media-object" src="{{asset("assets/admin/layout/img/avatar8.jpg")}}"
                                         alt="...">

                                    <div class="media-body">
                                        <h4 class="media-heading">Lisa Stone</h4>

                                        <div class="media-heading-sub">
                                            CTO, Keort Inc
                                        </div>
                                        <div class="media-heading-small">
                                            Last seen 13:10 PM
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-success">7</span>
                                    </div>
                                    <img class="media-object" src="{{asset("assets/admin/layout/img/avatar9.jpg")}}"
                                         alt="...">

                                    <div class="media-body">
                                        <h4 class="media-heading">Deon Portalatin</h4>

                                        <div class="media-heading-sub">
                                            CFO, H&D LTD
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="media-object" src="{{asset("assets/admin/layout/img/avatar10.jpg")}}"
                                         alt="...">

                                    <div class="media-body">
                                        <h4 class="media-heading">Irina Savikova</h4>

                                        <div class="media-heading-sub">
                                            CEO, Tizda Motors Inc
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-danger">4</span>
                                    </div>
                                    <img class="media-object" src="{{asset("assets/admin/layout/img/avatar11.jpg")}}"
                                         alt="...">

                                    <div class="media-body">
                                        <h4 class="media-heading">Maria Gomez</h4>

                                        <div class="media-heading-sub">
                                            Manager, Infomatic Inc
                                        </div>
                                        <div class="media-heading-small">
                                            Last seen 03:10 AM
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="page-quick-sidebar-item">
                            <div class="page-quick-sidebar-chat-user">
                                <div class="page-quick-sidebar-nav">
                                    <a href="javascript:;" class="page-quick-sidebar-back-to-list"><i
                                                class="icon-arrow-left"></i>Back</a>
                                </div>
                                <div class="page-quick-sidebar-chat-user-messages">
                                    <div class="post out">
                                        <img class="avatar" alt=""
                                             src="{{asset("assets/admin/layout/img/avatar3.jpg")}}"/>

                                        <div class="message">
                                            <span class="arrow"></span>
                                            <a href="#" class="name">Bob Nilson</a>
                                            <span class="datetime">20:15</span>
											<span class="body">
											When could you send me the report ? </span>
                                        </div>
                                    </div>
                                    <div class="post in">
                                        <img class="avatar" alt=""
                                             src="{{asset("assets/admin/layout/img/avatar2.jpg")}}"/>

                                        <div class="message">
                                            <span class="arrow"></span>
                                            <a href="#" class="name">Ella Wong</a>
                                            <span class="datetime">20:15</span>
											<span class="body">
											Its almost done. I will be sending it shortly </span>
                                        </div>
                                    </div>
                                    <div class="post out">
                                        <img class="avatar" alt=""
                                             src="{{asset("assets/admin/layout/img/avatar3.jpg")}}"/>

                                        <div class="message">
                                            <span class="arrow"></span>
                                            <a href="#" class="name">Bob Nilson</a>
                                            <span class="datetime">20:15</span>
											<span class="body">
											Alright. Thanks! :) </span>
                                        </div>
                                    </div>
                                    <div class="post in">
                                        <img class="avatar" alt=""
                                             src="{{asset("assets/admin/layout/img/avatar2.jpg")}}"/>

                                        <div class="message">
                                            <span class="arrow"></span>
                                            <a href="#" class="name">Ella Wong</a>
                                            <span class="datetime">20:16</span>
											<span class="body">
											You are most welcome. Sorry for the delay. </span>
                                        </div>
                                    </div>
                                    <div class="post out">
                                        <img class="avatar" alt=""
                                             src="{{asset("assets/admin/layout/img/avatar3.jpg")}}"/>

                                        <div class="message">
                                            <span class="arrow"></span>
                                            <a href="#" class="name">Bob Nilson</a>
                                            <span class="datetime">20:17</span>
											<span class="body">
											No probs. Just take your time :) </span>
                                        </div>
                                    </div>
                                    <div class="post in">
                                        <img class="avatar" alt=""
                                             src="{{asset("assets/admin/layout/img/avatar2.jpg")}}"/>

                                        <div class="message">
                                            <span class="arrow"></span>
                                            <a href="#" class="name">Ella Wong</a>
                                            <span class="datetime">20:40</span>
											<span class="body">
											Alright. I just emailed it to you. </span>
                                        </div>
                                    </div>
                                    <div class="post out">
                                        <img class="avatar" alt=""
                                             src="{{asset("assets/admin/layout/img/avatar3.jpg")}}"/>

                                        <div class="message">
                                            <span class="arrow"></span>
                                            <a href="#" class="name">Bob Nilson</a>
                                            <span class="datetime">20:17</span>
											<span class="body">
											Great! Thanks. Will check it right away. </span>
                                        </div>
                                    </div>
                                    <div class="post in">
                                        <img class="avatar" alt=""
                                             src="{{asset("assets/admin/layout/img/avatar2.jpg")}}"/>

                                        <div class="message">
                                            <span class="arrow"></span>
                                            <a href="#" class="name">Ella Wong</a>
                                            <span class="datetime">20:40</span>
											<span class="body">
											Please let me know if you have any comment. </span>
                                        </div>
                                    </div>
                                    <div class="post out">
                                        <img class="avatar" alt=""
                                             src="{{asset("assets/admin/layout/img/avatar3.jpg")}}"/>

                                        <div class="message">
                                            <span class="arrow"></span>
                                            <a href="#" class="name">Bob Nilson</a>
                                            <span class="datetime">20:17</span>
											<span class="body">
											Sure. I will check and buzz you if anything needs to be corrected. </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="page-quick-sidebar-chat-user-form">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Type a message here...">

                                        <div class="input-group-btn">
                                            <button type="button" class="btn blue"><i class="icon-paper-clip"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane page-quick-sidebar-alerts" id="quick_sidebar_tab_2">
                        <div class="page-quick-sidebar-alerts-list">
                            <h3 class="list-heading">General</h3>
                            <ul class="feeds list-items">
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    You have 4 pending tasks. <span
                                                            class="label label-sm label-warning ">
													Take action <i class="fa fa-share"></i>
													</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            Just now
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-success">
                                                        <i class="fa fa-bar-chart-o"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        Finance Report for year 2013 has been released.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date">
                                                20 mins
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-danger">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    You have 5 pending membership that requires a quick review.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            24 mins
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    New order received with <span class="label label-sm label-success">
													Reference Number: DR23923 </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            30 mins
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-success">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    You have 5 pending membership that requires a quick review.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            24 mins
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info">
                                                    <i class="fa fa-bell-o"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    Web server hardware needs to be upgraded. <span
                                                            class="label label-sm label-warning">
													Overdue </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            2 hours
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-default">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        IPO Report for year 2013 has been released.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date">
                                                20 mins
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <h3 class="list-heading">System</h3>
                            <ul class="feeds list-items">
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    You have 4 pending tasks. <span
                                                            class="label label-sm label-warning ">
													Take action <i class="fa fa-share"></i>
													</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            Just now
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-danger">
                                                        <i class="fa fa-bar-chart-o"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        Finance Report for year 2013 has been released.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date">
                                                20 mins
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-default">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    You have 5 pending membership that requires a quick review.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            24 mins
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    New order received with <span class="label label-sm label-success">
													Reference Number: DR23923 </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            30 mins
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-success">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    You have 5 pending membership that requires a quick review.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            24 mins
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-warning">
                                                    <i class="fa fa-bell-o"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    Web server hardware needs to be upgraded. <span
                                                            class="label label-sm label-default ">
													Overdue </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            2 hours
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-info">
                                                        <i class="fa fa-briefcase"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        IPO Report for year 2013 has been released.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date">
                                                20 mins
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">
                        <div class="page-quick-sidebar-settings-list">
                            <h3 class="list-heading">General Settings</h3>
                            <ul class="list-items borderless">
                                <li>
                                    Enable Notifications <input type="checkbox" class="make-switch" checked
                                                                data-size="small" data-on-color="success"
                                                                data-on-text="ON" data-off-color="default"
                                                                data-off-text="OFF">
                                </li>
                                <li>
                                    Allow Tracking <input type="checkbox" class="make-switch" data-size="small"
                                                          data-on-color="info" data-on-text="ON"
                                                          data-off-color="default" data-off-text="OFF">
                                </li>
                                <li>
                                    Log Errors <input type="checkbox" class="make-switch" checked data-size="small"
                                                      data-on-color="danger" data-on-text="ON" data-off-color="default"
                                                      data-off-text="OFF">
                                </li>
                                <li>
                                    Auto Sumbit Issues <input type="checkbox" class="make-switch" data-size="small"
                                                              data-on-color="warning" data-on-text="ON"
                                                              data-off-color="default" data-off-text="OFF">
                                </li>
                                <li>
                                    Enable SMS Alerts <input type="checkbox" class="make-switch" checked
                                                             data-size="small" data-on-color="success" data-on-text="ON"
                                                             data-off-color="default" data-off-text="OFF">
                                </li>
                            </ul>
                            <h3 class="list-heading">System Settings</h3>
                            <ul class="list-items borderless">
                                <li>
                                    Security Level
                                    <select class="form-control input-inline input-sm input-small">
                                        <option value="1">Normal</option>
                                        <option value="2" selected>Medium</option>
                                        <option value="e">High</option>
                                    </select>
                                </li>
                                <li>
                                    Failed Email Attempts <input class="form-control input-inline input-sm input-small"
                                                                 value="5"/>
                                </li>
                                <li>
                                    Secondary SMTP Port <input class="form-control input-inline input-sm input-small"
                                                               value="3560"/>
                                </li>
                                <li>
                                    Notify On System Error <input type="checkbox" class="make-switch" checked
                                                                  data-size="small" data-on-color="danger"
                                                                  data-on-text="ON" data-off-color="default"
                                                                  data-off-text="OFF">
                                </li>
                                <li>
                                    Notify On SMTP Error <input type="checkbox" class="make-switch" checked
                                                                data-size="small" data-on-color="warning"
                                                                data-on-text="ON" data-off-color="default"
                                                                data-off-text="OFF">
                                </li>
                            </ul>
                            <div class="inner-content">
                                <button class="btn btn-success"><i class="icon-settings"></i> Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        2015 &copy; Suntorydesign.net.
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src={{asset("assets/global/plugins/respond.min.js")}}></script>
<script src={{asset("assets/global/plugins/excanvas.min.js")}}></script>
<![endif]-->

<script src={{asset("assets/global/plugins/jquery.min.js")}} type="text/javascript"></script>
<script src={{asset("assets/global/plugins/jquery-migrate.min.js")}} type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
{{--<script src="{{asset("assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js")}}" type="text/javascript"></script>--}}
<script src="{{asset("assets/global/plugins/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js")}}"
        type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}"
        type="text/javascript"></script>
{{--<script src="{{asset("assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js")}}" type="text/javascript"></script>--}}
<script src="{{asset("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js")}}"
        type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}"
        type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/datatables/datatables-bootstrap.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/datatables/datatables.fnReloadAjax.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/jquery.blockui.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/jquery.cokie.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/uniform/jquery.uniform.min.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/tinymce/tinymce.min.js")}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset("assets/global/scripts/metronic.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/admin/layout/scripts/layout.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/admin/layout/scripts/quick-sidebar.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/admin/layout/scripts/demo.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/admin/pages/scripts/index.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/admin/pages/scripts/tasks.js")}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="{{asset("assets/global/plugins/dropzone/dropzone.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/frontend/pages/scripts/media-manager.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/fancybox-v3beta/jquery.fancybox.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/global/plugins/fancybox-v3beta/jquery.fancybox-thumbs.js")}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>

<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
//        QuickSidebar.init(); // init quick sidebar
//        Demo.init(); // init demo features
//        Index.init();
//        Index.initDashboardDaterange();
//        Index.initJQVMAP(); // init index page's custom scripts
//        Index.initCalendar(); // init index page's custom scripts
//        Index.initCharts(); // init index page's custom scripts
//        Index.initChat();
//        Index.initMiniCharts();
//        Index.initIntro();
//        Tasks.initDashboardWidget();
    });
    $.ajaxSetup({data: {"_token": "{{Session::getToken()}}"}});
</script>
@yield("scripts")
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>