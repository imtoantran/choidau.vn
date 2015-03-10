@extends('site.layouts.default')
@section('content')
    <div id="choidau-person">

        @include('site.user.blog.header')

        <div class="person-body">
            <div class="row margin-none">
                <div class="col-md-9 col-none-padding person-body-content">

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="blog-tab-action">
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

                                <div class="row action-view-more margin-none text-center text-1em2 choidau-font">
                                    Xem thêm hoạt động
                                </div>
                            </section>

                        </div>

                        <div role="tabpanel" class="tab-pane" id="blog-tab-photo">


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
                        {{--luuhoabk tab location --}}
                        <div role="tabpanel" class="tab-pane" id="blog-tab-location">
                            <section class="person-location choidau-bg">
                                <header class="blog-setting-header padding-5 margin-bottom-5 white">
                                    <div class="wrapper-header">
                                        <i class="blog-icon-bg icon-folder"></i>
                                        <i class="blog-icon-content icon-location-outline"></i>
                                        <span class="text-1em2">Danh sách địa điểm</span>
                                    </div>
                                </header>
                                <nav>
                                    <ul class="mix-filter padding-left-10 margin-bottom-5">
                                        <li data-filter="location-cat-posted active" class="filter active"><span class="ver-mid">Đã đăng</span> <span class="total-location-post badge circle">0</span>  </li>
                                        <li data-filter="location-cat-like" class="filter"><span class="ver-mid">Yêu thích</span> <span class="total-location-like badge circle">0</span> </li>
                                        <li data-filter="location-cat-checkin" class="filter "><span class="ver-mid">Checkin</span> <span class="total-location-checkin badge circle">0</span> </li>
                                    </ul>
                                </nav>
                                <div class="row mix-grid thumbnails margin-none blog-content">
                                    {{--load dia diem--}}
                                </div>
                            </section>
                        </div>
                        {{--END luuhoabk tab location --}}
                        <div role="tabpanel" class="tab-pane" id="blog-tab-friend">
                            <section class="person-friends choidau-bg">
                                <header class="padding-5">
                                    <i class="icon-group white"></i>
                                    Tất cả bạn bè <span class="person-friends-list-total"></span>
                                </header>
                                <div class="row person-friends-list margin-none"></div>
                            </section>
                        </div>

                        {{--luuhoabk tab setting infor user--}}
                        <div role="tabpanel" class="tab-pane" id="blog-tab-setting">
                            <section class="person-setting choidau-bg">
                                <header class="blog-setting-header padding-5 margin-bottom-5 white">
                                    <div class="wrapper-header">
                                        <i class="blog-icon-bg icon-folder"></i>
                                        <i class="blog-icon-content icon-cog"></i>
                                        <span class="text-1em2">Cập nhật thông tin</span>
                                    </div>
                                </header>
                                <div class="row blog-wrapper margin-none">
                                    <div class="blog-content">
                                        cap nhat thong tin
                                    </div>
                                </div>

                            </section>
                        </div>
                        {{--END luuhoabk tab setting infor user--}}
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

{{--luuhoatest--}}
@section('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        data:{"_token":"{{Session::getToken()}}"}
    });
    jQuery(document).ready(function() {
        // luuhoabk - load location in blog
                $('#btn-tag-blog-location').on('click', function(){
                    var tag_location = $('#blog-tab-location');

                    tag_location.find('.blog-content').html('');
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('dia-diem/loc-dia-diem')}}",
                        data: {'userBlog_id': '{{$blog_info['id']}}'},
                        dataType: 'json',
                        success: function (respon) {
                            tag_location.find('.total-location-post').text(respon.posted.length);
                            tag_location.find('.total-location-like').text(respon.like.length);
                            tag_location.find('.total-location-checkin').text(respon.checkin.length);
                            var html_location ='';
                                html_location += getHtmlItem(respon.posted, 'posted');
                                html_location += getHtmlItem(respon.like, 'like');
                                html_location += getHtmlItem(respon.checkin, 'checkin');
                            tag_location.find('.blog-content').html(html_location);
                            tag_location.find('li.filter.active').trigger('click');
                        }
                    });
                });

                //type: "posted, like, checkin"
               var getHtmlItem = function(arrObject,type){
                   var html_item = '';
                   $.each(arrObject, function(key, val){
                       html_item += '   <div class="col-md-4 col-sm-6 mix location-cat-'+type+'">';
                       html_item += '   <div class="mix-inner">';
                       html_item += '   <img alt="" src="{{URL::to('/')}}'+val.avatar+'" class="img-responsive">';
                       html_item += '   <div class="title">'+val.name+'</div>';

                       html_item += '   <div class="mix-details choidau-bg-light-a9">';
                       html_item += '   <h4 class="white"><a href="'+val.url+'" class="white font-weight-600">'+val.name+'</a></h4>';
                       html_item += '   <p>'+val.address_detail+'</p>';
                       html_item += '   <a class="mix-link choidau-bg tolltips" href="'+val.url+'" data-original-title="Đi đến "><i class="icon-link"></i></a>';
                       html_item += '   <a data-rel="fancybox-button" title="Project Name" href="{{URL::to('/')}}'+val.avatar+'" class="mix-preview choidau-bg fancybox-button"><i class="icon-search"></i></a>';
                       html_item += '   </div>';
                       html_item += '   </div>';
                       html_item += '   </div>';
                   })
                   return html_item;
               }
        // end luuhoabk - load location in blog
    });
</script>
@stop