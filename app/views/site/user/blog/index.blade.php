@extends('site.layouts.default')
@section('content')
    <div id="choidau-person">
        @include('site.user.blog.header')
        <div class="person-body">
            <div class="row margin-none">
                <div class="col-md-9 col-none-padding person-body-content">
                    <div class="tab-content col-none-padding">
                        <div role="tabpanel" class="tab-pane active" id="blog-tab-action">
                            <section class="person-content choidau-bg">

                                {{--post statetus--}}
                                @if($user_auth->id == $user_blog->id)
                                    <div class="row person-content-item form-add-status" style="padding-bottom: 10px;">
                                        <div class="action-comment">

                                            <header class="action-comment-subject text-weight600">Cập nhật trạng thái
                                            </header>
                                            <div class="action-comment-input">
                                                <textarea name="content-status" id="content-status" minlength="5"
                                                          data-required="1" rows="2"
                                                          style="width: 100%; padding: 5px; border: none;"
                                                          placeholder=" Bạn đang nghĩ gì?" required></textarea>
                                            </div>

                                            <div class="text-right action-comment-submit">
                                                <div class="btn-group person-type-scopy margin-none">
                                                    <button type="button" id="main-status" value_id="18"
                                                            class="btn btn-default btn-xs">
                                                        Cộng đồng
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
                                                <button class="btn choidau-bg-font btn-xs btn-post-status">Đăng</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="anchor_load text-center hidden">
                                    <span class="white">.:: <i class="icon-spin4 animate-spin white"
                                                               style=" font-size: 18px; margin-bottom: 10px;"></i> ::.</span>
                                </div>
                                <div class="my-tab-content" style="background-color: #fff;">

                                    <div id="anchor_top"></div>
                                    <?php $object_action = json_decode($actions); ?>
                                    @foreach($object_action as $key=>$val)
                                        {{--chuan bi du lieu --}}
                                        <?php
                                        $note = '';
                                        $description = '';
                                        switch ($val->post_type) {
                                            case 'checkin':
                                                $note = 'Đã check in địa điểm này.';
                                                $description = $val->location->description;
                                                break;
                                            case 'like-location'   :
                                                $note = 'Đã thích địa điểm này.';
                                                if (!is_null($val->location)) {
                                                    $description = $val->location->description;
                                                }
                                                break;
                                            case 'review' :
                                                $note = 'Đã nhận xét địa điểm này.';
                                                $description = $val->content;
                                                break;
                                            default :
                                                $note = 'Đã cập nhật trạng thái.';
                                                $description = $val->content;
                                                break;
                                        }
                                        $date_updated = new DateTime($val->updated_at);
                                        $date_updated = date_format($date_updated, 'H:i d/m/Y');
                                        ?>

                                        <div class="row person-content-item">
                                            <div class="col-md-12 col-none-padding">
                                                <div class="col-md-9 article-img-text col-none-padding">
                                                    @if(empty($user_blog->avatar))
                                                        <img class="avatar-pad2"
                                                             src="{{URL::to("assets/global/img/no-image.png")}}" alt="">
                                                    @else
                                                        <img class="avatar-pad2"
                                                             src="{{URL::to('/').$user_blog->avatar}}" alt="">
                                                    @endif
                                                    <div class="person-content-info">
                                                        <div>
                                                            <a>{{empty($user_blog->fullname)?$user_blog->username : $user_blog->fullname;}}</a><span> - {{$val->level}}</span>
                                                        </div>
                                                        <span>{{$note}}</span><br>
                                                        <span>{{$date_updated}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-none-padding text-right">
                                                    @if($user_blog->id == $user_auth->id)
                                                        <div class="btn-group person-type-scopy">
                                                            <button type="button"
                                                                    class="btn btn-default btn-xs btn-privacy-val"
                                                                    post_id="{{$val->id}}"
                                                                    value_id="{{$val->privacy}}">{{$val->privacy_description}}</button>
                                                            <button type="button"
                                                                    class="btn btn-default btn-xs dropdown-toggle"
                                                                    data-toggle="dropdown">
                                                                <i class="icon-down-dir"></i>
                                                            </button>
                                                            <ul class="dropdown-menu btn-privacy-change" role="menu">
                                                                <li value_id="15">Chỉ mình tôi</li>
                                                                <li value_id="16">Bạn bè</li>
                                                                <li value_id="17">Bạn của bạn tôi</li>
                                                                <li value_id="18">Cộng đồng</li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            @if($val->post_type == 'status')
                                                @if(!is_null($description) && !empty($description) && $description!="")
                                                    <div class="col-md-12 col-none-padding person-content-article">
                                                        <div class="row margin-none">
                                                            <section
                                                                    class="article-img-text clearfix content-article-wrapper">
                                                                <div class="text-algin-img">
                                                                    <article>
                                                                        {{$description;}}
                                                                    </article>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="col-md-12 col-none-padding person-content-article">
                                                    @if(!is_null($val->location))
                                                        <div class="row margin-none">
                                                            <section
                                                                    class="article-img-text clearfix content-article-wrapper">
                                                                @if(empty($val->location->avatar))
                                                                    <img class="avatar-pad2"
                                                                         src="{{URL::to("assets/global/img/no-image.png")}}"
                                                                         alt="">
                                                                @else
                                                                    <img class="avatar-pad2"
                                                                         src="{{URL::to('/').$val->location->avatar}}"
                                                                         alt="">
                                                                @endif
                                                                <div class="text-algin-img">
                                                                    <header>
                                                                        <a href="{{$val->location->url}}">
                                                                            <h2>{{$val->location->name}}</h2></a>
                                                                    </header>
                                                                    <article>
                                                                        {{$description}}
                                                                    </article>
                                                                    <a href="{{$val->location->url}}"><i>{{$val->location->url}}</i></a>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <!-- slide img -->
                                                        <div class="row margin-none">
                                                            @if(count($val->location->album) >0)
                                                                <ul class="list-unstyled person-content-slide">
                                                                    @foreach($val->location->album as $key=>$image)
                                                                        @if($key<=6)
                                                                            <li>
                                                                                <img src="{{URL::to('/').$image->thumbnail}}"
                                                                                     alt=""></li>
                                                                        @endif
                                                                    @endforeach
                                                                    <li class="text-right"><a
                                                                                href="{{$val->location->url}}">
                                                                            <button class="btn btn-default">xem thêm
                                                                            </button>
                                                                        </a></li>
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                                @endif
                                                        <!-- comment - like - share -->
                                                <div class="row margin-none">
                                                    <div class="person-text-assoc">
                                                        <a href="#" class="action-assoc" data-action="{{$val->is_like}}"
                                                           data-type="post_item" data-user-id="{{$user_auth->id}}"
                                                           data-post-id="{{$val->id}}">
                                                            @if($val->is_like == 'like') Thích @else Bỏ thích @endif
                                                        </a>
                                                        <a href="#" class="comment-hint">Bình luận <span
                                                                    class="total-comment badge badge-default">{{count($val->post_comment)}}</span></a>
                                                        <a href="#">Chia sẻ</a>
                                                    </div>
                                                </div>

                                                <!-- comment - like - share -->
                                                <div class="box-comment">
                                                    <ul class="row margin-none blog-comment-wrapper">
                                                        @if(count($val->post_comment)>0)
                                                            @foreach($val->post_comment as $key=>$val_comment)
                                                                <li class="margin-bottom-10 clearfix @if($key < count($val->post_comment)-3) hidden @endif">
                                                                    <div class="col-md-12 article-img-text col-none-padding">
                                                                        @if(empty($val_comment->user->avatar))
                                                                            <img class="avatar-pad2"
                                                                                 src="{{URL::to("assets/global/img/no-image.png")}}"
                                                                                 alt="">
                                                                        @else
                                                                            <img class="avatar-pad2"
                                                                                 src="{{URL::to('/').$val_comment->user->avatar}}"
                                                                                 alt="">
                                                                        @endif


                                                                        <div class="person-content-info blog-comment-item">
                                                                            <div>
                                                                                <a href="{{URL::to('/trang-ca-nhan/'.$val_comment->user->username.'.html')}}">@if(isset($val_comment->user->fullname)) {{$val_comment->user->fullname}} @else {{$val_comment->user->username}} @endif</a>
                                                                                -
                                                                                <span class="content-comment"> {{$val_comment->content}} </span>
                                                                            </div>
                                                                            <span class="grey">{{date_format(new DateTime($val_comment->updated_at),'H:i d/m/Y')}}</span>
                                                                            -
                                                                            <span> <a href="#" class="action-assoc"
                                                                                      data-action="{{$val_comment->is_like_comment}}"
                                                                                      data-type="post_comment"
                                                                                      data-user-id="{{$user_auth->id}}"
                                                                                      data-post-id="{{$val_comment->id}}">@if($val_comment->is_like_comment == 'like')
                                                                                        Thích @else Bỏ thích @endif</a></span>
                                                                            -
                                                                            <span class="click-like-comment"><i
                                                                                        class="icon-thumbs-up"></i></span><span
                                                                                    class="total-comment-like">{{$val_comment->total_like}}</span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                    @if(count($val->post_comment)>3)
                                                        <div class="margin-bottom-10">...<a href="#"
                                                                                            class="action-view-more"
                                                                                            type="show">Xem thêm</a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="row margin-none person-command">
                                                    <div class="col-md-12 col-none-padding">
                                                        <a href="#" class="click-like"><i
                                                                    class="@if($val->is_like == 'like') icon-thumbs-up-alt @else icon-thumbs-down-alt @endif"></i></a>
                                                        <span class="total-like">{{$val->total_like}}</span> người thích
                                                        điều này
                                                    </div>
                                                    <div class="col-md-12 article-img-text col-none-padding">
                                                        <div class="row margin-none">
                                                            <img class="col-md-1 col-ms-1 avatar-pad2"
                                                                 src="{{URL::to('/').$user_auth->avatar}}" alt="">
                                                            @if(empty($user_auth->avatar))
                                                                <img class="col-md-1 col-ms-1 avatar-pad2"
                                                                     src="{{URL::to("assets/global/img/no-image.png")}}"
                                                                     alt="">
                                                            @else
                                                                <img class="col-md-1 col-ms-1 avatar-pad2"
                                                                     src="{{URL::to('/').$user_auth->avatar}}" alt="">
                                                            @endif
                                                            <input class="col-md-11 col-ms-11 col-xs-11 comment"
                                                                   data-post-id="{{$val->id}}" type="text"
                                                                   placeholder="Viết bình luận...">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    @endforeach
                                    <div id="anchor_bottom" data-offet="5"></div>
                                </div>
                                <div class="btn green btn-block btn-action-more">
                                    Xem thêm hoạt động
                                </div>
                            </section>

                        </div>

                        {{--luuhoabk tab photo --}}
                        <div role="tabpanel" class="tab-pane" id="blog-tab-photo">
                            <section class="person-photo person-wrapper choidau-bg">
                                <header class="blog-setting-header padding-5 margin-bottom-5 white">
                                    <div class="wrapper-header">
                                        <i class="blog-icon-bg icon-folder"></i>
                                        <i class="blog-icon-content icon-camera"></i>
                                        <span class="text-1em2">Album ảnh</span>
                                    </div>
                                </header>

                                <ul id="tabs" class="nav nav-tabs blog-tabs" data-tabs="tabs">
                                    <li class="active">
                                        <a href="#photo-tab-avatar" data-toggle="tab">Ảnh đại diện
                                            <span class="badge circle tab-avatar">1</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#photo-tab-location" data-toggle="tab">Ảnh địa điểm
                                            <span class="badge circle tab-location">0</span>
                                        </a>
                                    </li>
                                </ul>
                                <div id="my-tab-content" style="padding: 10px 5px 10px 5px;" class="tab-content">
                                    <div class="tab-pane active" id="photo-tab-avatar">
                                        <span class="" style="font-size: 1.3em;"><i
                                                    class="icon-spin4 animate-spin black"></i> loading...</span>
                                    </div>

                                    <div class="tab-pane" id="photo-tab-location">
                                        <div class="row thumbnails margin-none ">
                                            <span class="white" style="font-size: 1.3em;"><i
                                                        class="icon-spin4 animate-spin blackss"></i> loading...</span>
                                        </div>
                                        {{-- de chua nhung hinh anh cho album khi hien len--}}
                                        <div class="hidden box-fancy"></div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        {{--END luuhoabk tab photo --}}

                        {{--luuhoabk tab location --}}
                        <div role="tabpanel" class="tab-pane" id="blog-tab-location">
                            <section class="person-location person-wrapper choidau-bg">
                                <header class="blog-setting-header padding-5 margin-bottom-5 white">
                                    <div class="wrapper-header">
                                        <i class="blog-icon-bg icon-folder"></i>
                                        <i class="blog-icon-content icon-location-outline"></i>
                                        <span class="text-1em2">Danh sách địa điểm</span>
                                    </div>
                                </header>
                                <nav>
                                    <ul class="mix-filter padding-left-10 margin-bottom-5">
                                        <li data-filter="location-cat-posted active" class="filter active"><span
                                                    class="ver-mid">Đã đăng</span> <span
                                                    class="total-location-post badge circle">0</span></li>
                                        <li data-filter="location-cat-like" class="filter"><span class="ver-mid">Yêu thích</span>
                                            <span class="total-location-like badge circle">0</span></li>
                                        <li data-filter="location-cat-checkin" class="filter "><span class="ver-mid">Checkin</span>
                                            <span class="total-location-checkin badge circle">0</span></li>
                                    </ul>
                                </nav>
                                <div class="row mix-grid thumbnails margin-none blog-content">
                                    load dia diem
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
                                <div class="row person-friends-list margin-none">
                                    <span class="white" style="font-size: 1.3em;"><i
                                                class="icon-spin4 animate-spin white"></i> loading...</span>
                                </div>
                            </section>
                        </div>

                        {{--luuhoabk tab setting infor user--}}
                        <div role="tabpanel" class="tab-pane" id="blog-tab-setting">
                            <section class="person-setting choidau-bg">
                                <header class="blog-setting-header padding-5 margin-bottom-5 white">
                                    <div class="wrapper-header">
                                        <i class="blog-icon-bg icon-folder"></i>
                                        <i class="blog-icon-content icon-cog"></i>
                                        <span class="text-1em2">Thiết lập</span>
                                    </div>
                                </header>
                                <div class="row blog-wrapper margin-none">
                                    <div class="blog-content col-md-12 padding-bottom-10">
                                        <div class="row">
                                            {{----}}
                                            <div class="col-md-3">
                                                <div class="row blog-setting-user">
                                                    <div class="col-md-12 text-center padding-top-20">
                                                        @if(empty($user_blog->avatar))
                                                            <img class="avatar-pad2 blog-setting-img"
                                                                 src="{{URL::to("assets/global/img/no-image.png")}}"
                                                                 alt="">
                                                        @else
                                                            <img class="avatar-pad2 blog-setting-img"
                                                                 src="{{URL::to("/").$user_blog->avatar}}" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12 text-center username">
                                                        {{empty($user_blog->fullname)?$user_blog->username : $user_blog->fullname;}}
                                                    </div>
                                                    <div class="col-md-12 text-center level">
                                                        <i class="icon-sitemap grey tooltips"
                                                           data-original-title="Cấp bậc"></i> -
                                                        @if(isset($blog_info['level']) && !empty($blog_info['level']))
                                                            {{$blog_info['level']}}
                                                        @else
                                                            <span class="updateting">Đang cập nhật</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12 text-center gift-point">
                                                        Điểm thưởng - <span
                                                                class="badge badge-roundless badge-danger">{{$user_blog->giftpoint}} </span>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-9 col-none-padding">
                                                <div class="person-info margin-right-10">
                                                    <div class="row wrapper-info">
                                                        <div class="col-md-12 infor-user-header">
                                                            <i class="icon-vcard"></i>
                                                            Thông tin cá nhân
                                                        </div>
                                                        <form action="#" id="frm-user-info" name="frm-user-info"
                                                              class="form-horizontal">
                                                            <div class="form-body">
                                                                <input type="hidden" name="_token"
                                                                       value="{{Session::token()}}"/>
                                                                {{--username --}}
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label"><span
                                                                                class="required"
                                                                                aria-required="true">*</span> Họ tên
                                                                    </label>

                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                        <i class="icon-user"></i>
                                                                        </span>
                                                                            <input type="text" id="fullname"
                                                                                   name="fullname" class="form-control"
                                                                                   placeholder="Nhập họ tên."
                                                                                   value="{{$user_blog->fullname}}"
                                                                                   required>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{--address --}}
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Địa
                                                                        chỉ</label>

                                                                    <div class="col-md-6">
                                                                        <textarea id="address" name="address"
                                                                                  class="form-control"
                                                                                  rows="2">{{$user_blog->street}}</textarea>
                                                                    </div>
                                                                </div>

                                                                {{--province --}}
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label"><span
                                                                                class="required"
                                                                                aria-required="true">*</span> Tỉnh/Thành
                                                                        phố</label>

                                                                    <div class="col-md-6">
                                                                        <select name="user-province" id="user-province"
                                                                                required class="form-control"
                                                                                title="Hãy chọn thành phố của bạn">
                                                                            <option value="">-- Chọn Tỉnh/ Thành phố
                                                                                --
                                                                            </option>
                                                                            @if (Cache::has('listProvince'))
                                                                                <?php $listProvince = Cache::get('listProvince');?>
                                                                            @else
                                                                                <?php $listProvince = Province::all();?>
                                                                                <?php Cache::forever('listProvince', $listProvince);?>
                                                                            @endif

                                                                            @foreach($listProvince as $item)
                                                                                <option value="{{$item->id}}" @if($user_blog->province_id == $item->id)
                                                                                        selected @endif>{{$item->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="privacy_province"
                                                                                id="privacy_province"
                                                                                class="form-control user-privacy"
                                                                                title="">
                                                                            @foreach($blog_info['listPrivacy'] as $item)
                                                                                <option value="{{$item->id}}" @if($blog_info['privacy_province']['meta_value'] == $item->id)
                                                                                        selected @endif>{{$item->description}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                {{--province --}}
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Tình trạng hôn
                                                                        nhân</label>

                                                                    <div class="col-md-6">
                                                                        <select name="status-marriage"
                                                                                id="status-marriage"
                                                                                class="form-control" title="">
                                                                            <option value="">-- Chọn tình trạng hôn nhân
                                                                                --
                                                                            </option>
                                                                            @if (Cache::has('listMarriage'))
                                                                                <?php $listMarriage = Cache::get('listMarriage');?>
                                                                            @else
                                                                                <?php $listMarriage = Option::whereName('user_status_marriage')->get();?>
                                                                                <?php Cache::forever('listMarriage', $listMarriage);?>
                                                                            @endif

                                                                            @foreach($listMarriage as $item)
                                                                                <option value="{{$item->id}}" @if($item->id == $user_blog->status_marriage_id)
                                                                                        selected @endif>{{$item->description}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="privacy_marriage"
                                                                                id="privacy_marriage"
                                                                                class="form-control user-privacy"
                                                                                title="">
                                                                            @foreach($blog_info['listPrivacy'] as $item)
                                                                                <option value="{{$item->id}}" @if($blog_info['privacy_status_marriage']['meta_value'] == $item->id)
                                                                                        selected @endif>{{$item->description}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                {{--birthday--}}
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Ngày
                                                                        sinh</label>

                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                            <i class="icon-birthday"></i>
                                                                            </span>
                                                                            <input id="birthday" name="birthday"
                                                                                   type="text" class="form-control"
                                                                                   value="@if(isset($blog_info['birthday']) && !empty($blog_info['birthday'])) {{$blog_info['birthday']}} @endif"
                                                                                   placeholder="Ngày sinh">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="privacy_birthday"
                                                                                id="privacy_birthday"
                                                                                class="form-control user-privacy"
                                                                                title="">
                                                                            @foreach($blog_info['listPrivacy'] as $item)
                                                                                <option value="{{$item->id}}" @if($blog_info['privacy_birthday']['meta_value'] == $item->id)
                                                                                        selected @endif>{{$item->description}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                {{--gender--}}
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Giới
                                                                        tính</label>

                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="gender"
                                                                                       id="male" @if($user_blog->gender == 1)
                                                                                       checked @endif value="1">Nam
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="gender"
                                                                                       id="female" @if($user_blog->gender == 0)
                                                                                       checked @endif value="0">Nữ
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="privacy_gender"
                                                                                id="privacy_gender"
                                                                                class="form-control user-privacy"
                                                                                title="">
                                                                            @foreach($blog_info['listPrivacy'] as $item)
                                                                                <option value="{{$item->id}}" @if($blog_info['privacy_gender']['meta_value'] == $item->id)
                                                                                        selected @endif>{{$item->description}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                {{--phone --}}
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Điện
                                                                        thoại</label>

                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="icon-phone"></i>
                                                                            </span>
                                                                            <input type="number" id="phone" name="phone"
                                                                                   class="form-control"
                                                                                   placeholder="Điện thoại của bạn."
                                                                                   value="{{$user_blog->phone}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="privacy_phone" id="privacy_phone"
                                                                                class="form-control user-privacy"
                                                                                title="">
                                                                            @foreach($blog_info['listPrivacy'] as $item)
                                                                                <option value="{{$item->id}}" @if($blog_info['privacy_phone']['meta_value'] == $item->id)
                                                                                        selected @endif>{{$item->description}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                {{--about --}}
                                                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Giới thiệu bạn
                                                                        thân</label>

                                                                    <div class="col-md-6">
                                                                        <textarea class="form-control" rows="3"
                                                                                  id="about"
                                                                                  name="about">{{$user_blog->about}}</textarea>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select name="privacy_about" id="privacy_about"
                                                                                class="form-control user-privacy"
                                                                                title="">
                                                                            @foreach($blog_info['listPrivacy'] as $item)
                                                                                <option value="{{$item->id}}" @if($blog_info['privacy_about']['meta_value'] == $item->id)
                                                                                        selected @endif>{{$item->description}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-8">
                                                                        <button type="submit" class="btn green btn-sm">
                                                                            Thay đổi
                                                                        </button>
                                                                        {{--<button type="reset" class="btn default btn-sm">Hủy</button>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                {{--change password--}}

                                                <div class="person-acount">
                                                    <div class="row wrapper-info">
                                                        <div class="col-md-12 infor-user-header">
                                                            <i class="icon-key"></i>
                                                            Mật khẩu
                                                        </div>
                                                        <form action="#" name="frm-acount-info" id="frm-acount-info"
                                                              class="form-horizontal">
                                                            <div class="form-body">
                                                                <input type="hidden" name="_token"
                                                                       value="{{Session::token()}}"/>
                                                                {{--username --}}
                                                                <div class="form-group">
                                                                    <label class="col-md-5 control-label">Tên tài
                                                                        khoản</label>

                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <label class="control-label"
                                                                                   style="font-weight: 700;">{{$user_blog->username}}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-5 control-label">Email</label>

                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <label class="control-label"
                                                                                   style="font-weight: 700;">{{$user_blog->email}}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{--username --}}
                                                                <div class="form-group">
                                                                    <label class="col-md-5 control-label">Mật khẩu
                                                                        mới</label>

                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="icon-key-inv"></i>
                                                                            </span>
                                                                            <input type="password" name="password"
                                                                                   id="password" class="form-control "
                                                                                   required
                                                                                   pattern="[a-z|A-z|0-9|\S]{6,40}"
                                                                                   title="Mật khẩu phải từ 6 kí tự và không có khoảng trắng">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{--username --}}
                                                                <div class="form-group">
                                                                    <label class="col-md-5 control-label">Xác nhận mật
                                                                        khẩu mới</label>

                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="icon-key-inv"></i>
                                                                            </span>
                                                                            <input type="password"
                                                                                   name="password_confirmation"
                                                                                   id="password_confirmation"
                                                                                   class="form-control" required
                                                                                   pattern="[a-z|A-z|0-9|\S]{6,40}"
                                                                                   title="Mật khẩu phải từ 6 kí tự và không có khoảng trắng">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-8">
                                                                        <button type="submit" id="submit-pass"
                                                                                class="btn green btn-sm">Thay đổi
                                                                        </button>
                                                                        <button type="reset" id="reset-pass"
                                                                                class="btn default btn-sm">Hủy
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
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
                                {{--level--}}
                                <li>
                                    <div class="row margin-none padding-left-0 padding-right-0">
                                        <div class="col-md-4 col-sm-4 box-right-title">Cấp bậc</div>
                                        <div class="col-md-8 col-sm-8 box-right-content">:
                                            @if(isset($blog_info['level']) && !empty($blog_info['level']))
                                                {{$blog_info['level']}}
                                            @else
                                                <span class="updateting">Đang cập nhật</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>

                                {{--address--}}
                                <li>
                                    <div class="row margin-none padding-left-0 padding-right-0">
                                        <div class="col-md-4 col-sm-4 box-right-title">Địa chỉ</div>
                                        <div class="col-md-8 col-sm-8 box-right-content">:
                                            @if(isset($user_blog->street) && !empty($user_blog->street))
                                                {{$user_blog->street}}
                                            @else
                                                <span class="updateting">Đang cập nhật</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>

                                {{--province--}}
                                @if($blog_info['show_info_province'] == 1)
                                    <li>
                                        <div class="row margin-none padding-left-0 padding-right-0">
                                            <div class="col-md-4 col-ms-4 box-right-title">Thành phố</div>
                                            <div class="col-md-8 col-ms-8 box-right-content">:
                                                @if(isset($blog_info['province']) && !empty($blog_info['province']))
                                                    {{$blog_info['province']}}
                                                @else
                                                    <span class="updateting">Đang cập nhật</span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endif

                                {{--birthday--}}
                                @if($blog_info['show_info_birthday'] == 1)
                                    <li>
                                        <div class="row margin-none padding-left-0 padding-right-0">
                                            <div class="col-md-4 box-right-title">Ngày sinh</div>
                                            <div class="col-md-8 box-right-content">:
                                                @if(isset($blog_info['birthday']) && !empty($blog_info['birthday']))
                                                    {{$blog_info['birthday']}}
                                                @else
                                                    <span class="updateting">Đang cập nhật</span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endif

                                {{--birthday--}}
                                @if($blog_info['show_info_gender'] == 1)
                                    <li>
                                        <div class="row margin-none padding-left-0 padding-right-0">
                                            <div class="col-md-4 box-right-title">Giới tính</div>
                                            <div class="col-md-8 box-right-content">:
                                                @if(isset($user_blog->gender))
                                                    @if($user_blog->gender == 0) Nữ @else Nam @endif
                                                @else
                                                    <span class="updateting">Đang cập nhật</span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endif

                                {{--phone--}}
                                @if($blog_info['show_info_phone'] == 1)
                                    <li>
                                        <div class="row margin-none padding-left-0 padding-right-0">
                                            <div class="col-md-4 box-right-title">Điện thoại</div>
                                            <div class="col-md-8 box-right-content">:
                                                @if(isset($user_blog->phone) && !empty($user_blog->phone))
                                                    {{$user_blog->phone}}
                                                @else
                                                    <span class="updateting">Đang cập nhật</span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endif

                                {{--phone--}}
                                @if($blog_info['show_info_marriage'] == 1)
                                    <li>
                                        <div class="row margin-none padding-left-0 padding-right-0">
                                            <div class="col-md-4 box-right-title">Hôn nhân</div>
                                            <div class="col-md-8 box-right-content">:
                                                @if(isset($user_blog->status_marriage_id) && $user_blog->status_marriage_id !=0)
                                                    {{$blog_info['marriage_status']['description']}}
                                                @else
                                                    <span class="updateting">Đang cập nhật</span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endif

                                <li>
                                    <div class="row margin-none padding-left-0 padding-right-0">
                                        <div class="col-md-4 box-right-title">Lượt thích</div>
                                        <div class="col-md-8 box-right-content">:
                                            @if(isset($blog_info['total_like']) && !empty($blog_info['total_like']))
                                                {{$blog_info['total_like']}} Địa điểm</span>
                                            @else
                                                <span class="updateting">Đang cập nhật</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>

                                {{--about--}}
                                @if($blog_info['show_info_about'] == 1)
                                    <li>
                                        <div class="row margin-none padding-left-0 padding-right-0">
                                            <div class="col-md-12 box-right-title margin-bottom-5">Về bản thân:</div>
                                            <div class="col-md-12 box-right-content grey" style="text-align: justify;">
                                                @if(isset($user_blog->about) && !empty($user_blog->about))
                                                    {{$user_blog->about}}
                                                @else
                                                    <span class="updateting">Đang cập nhật</span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endif

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
                                                <div class="row margin-none">
                                                    <div class="col-md-8 col-sm-8 col-xs-8 col-none-padding article-img-text">
                                                        <a href="{{URL::to('/')}}/trang-ca-nhan/{{$val->username}}.html">
                                                            @if(empty($val->avatar))
                                                                <img class="avatar-pad2 "
                                                                     src="{{URL::to("assets/global/img/no-image.png")}}"
                                                                     alt="">
                                                            @else
                                                                <img class="avatar-pad2" src="{{$val->avatar}}" alt="">
                                                            @endif

                                                        </a>

                                                        <div class="aside-items-text">
                                                            <a href="{{URL::to('/')}}/trang-ca-nhan/{{$val->username}}.html">
                                                                <b>@if(isset($val->fullname)){{$val->fullname}}@else{{$val->username}}@endif</b>
                                                            </a>

                                                            <p>{{$val->num_muatal}} bạn chung</p></div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-center">
                                                        @if(count($val->state_user)>0)
                                                            <button class="btn btn-default btn-sm-8 margin-none btn-friend-suggest"
                                                                    data-type="delete" friend_id="{{$val->id}}"><i
                                                                        class="icon-user-delete"
                                                                        style="font-size: 1.2em;"></i>
                                                                Hủy
                                                            </button>
                                                            </br>
                                                            @if($val->state_user->status_id == 35)
                                                                <span class="italic text-grey font-10px sub-alert"> Đã gửi lời mời</span>
                                                            @else
                                                                <span class="italic text-grey font-10px sub-alert"> Đã kết bạn</span>
                                                            @endif
                                                        @elseif(count($val->state_friend)>0)
                                                            @if($val->state_friend->status_id == 35)
                                                                <button class="btn btn-default btn-sm-8 margin-none btn-friend-suggest"
                                                                        data-type="confirm" friend_id="{{$val->id}}"><i
                                                                            class="icon-user-add"
                                                                            style="font-size: 1.2em;"></i>
                                                                    Chấp nhận
                                                                </button>
                                                                </br><span class="italic text-grey font-10px sub-alert"> Đang chờ</span>
                                                            @else
                                                                <button class="btn btn-default btn-sm-8 margin-none btn-friend-suggest"
                                                                        data-type="delete" friend_id="{{$val->id}}"><i
                                                                            class="icon-user-delete"
                                                                            style="font-size: 1.2em;"></i>
                                                                    Hủy
                                                                </button>
                                                                </br><span class="italic text-grey font-10px sub-alert"> Đã kết bạn</span>
                                                            @endif
                                                        @else
                                                            <button class="btn btn-default btn-sm-8 margin-none btn-friend-suggest"
                                                                    data-type="add" friend_id="{{$val->id}}"><i
                                                                        class="icon-user-add"
                                                                        style="font-size: 1.2em;"></i>
                                                                Kết bạn
                                                            </button>
                                                            </br><span class="italic text-grey font-10px sub-alert">Chưa kết bạn</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if(count($arrFriendSuggset)>3)
                                        <div class="aside-item-viewmore">
                                            <button class="btn btn-block default tooltips"
                                                    data-original-title="Xem thêm kết bạn">
                                                <i class="icon-down-dir"></i>
                                            </button>
                                        </div>
                                    @endif
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
                                <ul class="list-unstyled aside-items" id="friend-online">
                                    @foreach(Auth::user()->friends()->get() as $user)
                                        <li data-id="{{$user->id}}">
                                            <div class="row margin-none">
                                                <div class="col-md-8 col-sm-8 col-xs-8 col-none-padding article-img-text">
                                                    <img class="avatar-pad2" data-id="{{$user->id}}"
                                                         src="{{$user->avatar}}" alt="">

                                                    <div class="aside-items-text">
                                                        <b>
                                                            <a class="friend-online"
                                                               title="{{$user->url()}}"
                                                               data-avatar="{{$user->avatar}}"
                                                               data-id="{{$user->id}}">{{$user->display_name()}}</a>
                                                        </b>

                                                        <p>12 bạn chung</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-4 col-none-padding text-center">
                                                    <div class="aside-link-web">
                                                        <a class="aside-link-web" href="#">Web <i
                                                                    class="icon-website"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="aside-item-viewmore">
                                    <button class="btn btn-block default ">
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
            data: {"_token": "{{Session::getToken()}}"}
        });
        jQuery(document).ready(function () {
            //hieu ung hinh anh
            Portfolio.init();
            $('#birthday').datepicker({format: 'dd/mm/yyyy'});


            /**--- luuhoabk - update - bacground  ---**/
            $("#btn-blog-bg").mediaupload({
                url: "{{URL::to("media/upload")}}",
                token: "{{Session::token()}}",
                "multi-select": false,
                complete: function (images) {
                    var url_bg = '/upload/thumbnail/1140x180-' + images[0].name;
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('thanh-vien/cap-nhat-thong-tin')}}",
                        data: {
                            'update_type': 'background',
                            'url_bg': url_bg
                        },
                        dataType: 'json',
                        success: function (respon) {
                            console.log(respon);
                            if (respon) {
                                $('.person-header-bg').css('background-image', 'url("' + url_bg + '")');
                            }
                        }
                    });
                }
            });
            /**--- END luuhoabk - update - bacground  ---**/

            /**--- luuhoabk - update - avatar  ---**/
            $("#btn-blog-avatar").mediaupload({
                token: "{{Session::token()}}",
                "multi-select": false,
                complete: function (images) {
                    var url_bg = '/upload/thumbnail/150x150-' + images[0].name;
                    $.ajax({
                        type: "POST",
                        url: "{{URL::to('thanh-vien/cap-nhat-thong-tin')}}",
                        data: {
                            'update_type': 'avatar',
                            'url_bg': url_bg
                        },
                        dataType: 'json',
                        success: function (respon) {
                            if (respon) {
                                $('.blog-img-avatar').attr('src', url_bg);
                            }
                        }
                    });
                }
            });
            /**--- END luuhoabk - update - avatar  ---**/

            /**--- luuhoabk - load location in blog ---**/
            $('#btn-tag-blog-location').on('click', function () {
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
                        var html_location = '';
                        html_location += getHtmlItem(respon.posted, 'posted');
                        html_location += getHtmlItem(respon.like, 'like');
                        html_location += getHtmlItem(respon.checkin, 'checkin');
                        tag_location.find('.blog-content').html(html_location);
                        tag_location.find('li.filter.active').trigger('click');
                    }
                });
            });
            //type: "posted, like, checkin"
            var getHtmlItem = function (arrObject, type) {
                var html_item = '';
                $.each(arrObject, function (key, val) {
                    html_item += '   <div class="col-md-4 col-sm-6 mix location-cat-' + type + '">';
                    html_item += '   <div class="mix-inner">';
                    if (val.avatar.length < 0) {
                        html_item += '<img alt="" style="width: 258px; height: 184px;" src="{{URL::to("assets/global/img/no-image.png")}}" class="img-responsive">';
                    } else {
                        html_item += '   <img alt="" style="width: 258px; height: 184px;" src="{{URL::to('/')}}' + val.avatar + '" class="img-responsive">';
                    }
                    html_item += '   <div class="title">' + val.name + '</div>';
                    html_item += '   <div class="mix-details choidau-bg-light-a9">';
                    html_item += '   <h4 class="white"><a href="' + val.url + '" class="white font-weight-600">' + val.name + '</a></h4>';
                    html_item += '   <p>' + val.address_detail + '</p>';
                    html_item += '   <a class="mix-link choidau-bg tolltips" href="' + val.url + '" data-original-title="Đi đến "><i class="icon-link"></i></a>';
                    html_item += '   <a data-rel="fancybox-button" title="Project Name" href="{{URL::to('/')}}' + val.avatar + '" class="mix-preview choidau-bg fancybox-button"><i class="icon-search"></i></a>';
                    html_item += '   </div>';
                    html_item += '   </div>';
                    html_item += '   </div>';
                })
                return html_item;
            }


            /**--- END luuhoabk - load location in blog ---**/

            /**--- luuhoabk - load album in blog ---**/
            $('#btn-tag-blog-photo').on('click', function () {
                var photo_location = $('#photo-tab-location .row');
                var photo_avatar = $('#photo-tab-avatar');
                @if(empty($blog['avatar']))
                photo_avatar.html('<img class="avatar-pad2" src="{{URL::to("assets/global/img/no-image.png")}}"/>');
                @else
                    photo_avatar.html('<img class="avatar-pad2" src="{{URL::to('/').$blog_info['avatar']}}"/>');
                @endif
            $.ajax({
                            type: "POST",
                            url: "{{URL::to('dia-diem/loc-hinh-anh')}}",
                            data: {'id_user_blog': '{{$blog_info['id']}}'},
                            dataType: 'json',
                            success: function (respon) {
                                var tab_photo = $('#blog-tab-photo');
                                tab_photo.find('span.tab-location').text(respon.length);
                                if (!(respon.length > 0)) {
                                    photo_location.html('<span>Không có địa điểm nào.</span>');
                                    return false;
                                }

                                photo_location.html('');
                                $.each(respon, function (key, val) {
                                    //--- photo-------
                                    var html = '';
                                    html += '<div class="avatar-pad2" style="position: relative">';
                                    html += '<span class= "badge-num-image">' + val.album.length + '</span>';
                                    if (val.name.length < 0) {
                                        html += '<img class="" width="100%" src="{{URL::to("assets/global/img/no-image.png")}}" alt="">';
                                    } else {
                                        html += '<img class="" width="100%" src="{{URL::to('/')}}' + val.avatar + '" alt="">';
                                    }

                                    html += '<div class= "badge-name"><i class="icon-picture"></i> ' + val.name + '</div>';
                                    html += '</div>';

                                    var tag_html = $('<div/>', {class: 'col-md-3 col-sm-6 padding-lr-5 margin-bottom-10'}).html(html);
                                    tag_html.find('img').on('click', function () {
                                        var html_album = '';
                                        if (val.album.length > 0) {
                                            $.each(val.album, function (key_album, val_album) {
                                                html_album += '<a class="fancybox-thumb hidden" rel="fancy-thumb-blog-' + val.id + '" href="{{URL::to('/')}}' + val_album.guid + '" title="' + val_album.title + '">';
                                                html_album += '<img class="avatar-pad2" width="100%" src="{{URL::to('/')}}' + val_album.guid + '" alt="ALT_TITLE">';
                                                html_album += '</a>';
                                            })
                                            $('.box-fancy').html(html_album);
                                            $('.fancybox-thumb').fancybox({
                                                helpers: {
                                                    thumbs: true
                                                },
                                                title: {stype: 'inside'},
                                                autoSize: false,
                                                autoScale: true,
                                                fitToView: true
                                            });
                                            $('.fancybox-thumb').first().trigger('click');
                                        }
                                    });
                                    photo_location.append(tag_html);
                                });
                            }
                        });
            });
            /**--- END luuhoabk - load album inblog ---**/

//------------------------
            /**---- luuhoabk - post status ---**/
            $('.btn-post-status').on('click', function () {
                postStatus();
            });

            $('#content-status').keypress(function (event) {
                var code = event.keyCode || event.which;
                if (code == 13) { //Enter keycode
                    event.preventDefault();
                    postStatus();
                }
            });
            /**---- END luuhoabk - post status ---**/

            /**---- luuhoabk - action more ---**/
                // change privace
            $('ul.btn-privacy-change li').on('click', function () {
                $(this).closest('.person-type-scopy').find('.btn-privacy-val').blogPrivacy({
                    callback: function (respon) {
                    }
                });
            });
            /**---- END luuhoabk - action more ---**/

            /**---- luuhoabk - action more ---**/
            $('.btn-action-more').on('click', function () {
                var btb_action = $(this);
                var anchor_bottom = $('#anchor_bottom');
                var data_offset = anchor_bottom.attr('data-offet');
                $.ajax({
                    type: "POST",
                    url: URL + "/trang-ca-nhan/trang-thai.html",
                    data: {
                        'type_edit': 'action_more',
                        'blog_id': '{{$blog_info['id']}}',
                        'data_offset': data_offset
                    },
                    async: true,
                    success: function (respon) {
                        var data = $.parseJSON(respon);
                        console.log(data);
                        if (data.length > 0) {
                            var html = '';
                            var note = '';
                            var description = '';
                            $.each(data, function (key, val) {
                                switch (val.post_type) {
                                    case 'checkin':
                                        note = 'Đã check in địa điểm này.';
                                        description = val.location.description;
                                        break;
                                    case 'like'   :
                                        note = 'Đã thích địa điểm này.';
                                        description = val.location.description;
                                        break;
                                    case 'review' :
                                        note = 'Đã nhận xét địa điểm này.';
                                        description = val.content;
                                        break;
                                    default :
                                        note = 'Đã cập nhật trạng thái.';
                                        description = val.content;
                                        break;
                                }

                                var date_updated = formatDate(val.updated_at);

                                html += '<div class="row person-content-item">';
                                html += '<div class="col-md-12 col-none-padding">';
                                html += '<div class="col-md-9 article-img-text col-none-padding">';
                                @if(empty($user_blog->avatar))
                                html += '<img class="avatar-pad2" src="{{URL::to("assets/global/img/no-image.png")}}" alt="">';
                                @else
                                    html += '<img class="avatar-pad2" src="{{URL::to('/').$user_blog->avatar}}" alt="">';
                                @endif
                                html += '<div class="person-content-info">';
                                html += '<div><a>{{empty($user_blog->fullname)?$user_blog->username : $user_blog->fullname;}}</a><span> - ' + val.level + '</span></div>';
                                html += '<span>' + note + '</span><br>';
                                html += '<span>' + date_updated + '</span>';
                                html += '</div>';
                                html += '</div>';
                                html += '<div class="col-md-3 col-none-padding text-right">';
                                @if($user_blog->id == $user_auth->id)
                                html += '<div class="btn-group person-type-scopy">';
                                html += '<button type="button" class="btn btn-default btn-xs btn-privacy-val" post_id="' + val.id + '"  value_id="' + val.privacy + '">' + val.privacy_description + '</button>';
                                html += '<button type="button" class="btn btn-default btn-xs dropdown-toggle"  data-toggle="dropdown">';
                                html += '<i class="icon-down-dir"></i>';
                                html += '</button>';
                                html += '<ul class="dropdown-menu btn-privacy-change" role="menu">';
                                html += '<li value_id="15">Chỉ mình tôi</li>';
                                html += '<li value_id="16">Bạn bè</li>';
                                html += '<li value_id="17">Bạn của bạn tôi</li>';
                                html += '<li value_id="18">Cộng đồng</li>';
                                html += '</ul>';
                                html += '</div>';
                                @endif
                                html += '</div>';
                                html += '</div>';
                                if (val.post_type == 'status') {
                                    if (description != null && description != "") {
                                        html += '<div class="col-md-12 col-none-padding person-content-article">';
                                        html += '<div class="row margin-none">';
                                        html += '<section class="article-img-text clearfix content-article-wrapper">';
                                        html += '<div class="text-algin-img">';
                                        if (description.length > 0) {
                                            html += '<article>';
                                            html += description;
                                            html += '</article>';
                                        }
                                        html += '</div>';
                                        html += '</section>';
                                        html += '</div>';
                                        html += '</div>';
                                    }
                                } else {
                                    html += '<div class="col-md-12 col-none-padding person-content-article">';
                                    if (val.location != null) {
                                        html += '<div class="row margin-none">';
                                        html += '<section class="article-img-text clearfix content-article-wrapper">';
                                        if (val.location.avatar.length < 0) {
                                            html += '<img class="avatar-pad2" src="{{URL::to("assets/global/img/no-image.png")}}" alt="">';
                                        } else {
                                            html += '<img class="avatar-pad2" src="{{URL::to('/')}}' + val.location.avatar + '" alt="">';
                                        }
                                        html += '<div class="text-algin-img">';
                                        html += '<header>';
                                        html += '<a href="' + val.location.url + '"><h2>' + val.location.name + '</h2></a>';
                                        html += '</header>';
                                        html += '<article>';
                                        html += description;
                                        html += '</article>';
                                        html += '<a href="' + val.location.url + '"><i>' + val.location.url + '</i></a>';
                                        html += '</div>';
                                        html += '</section>';
                                        html += '</div>';
                                        <!-- slide img -->
                                        html += '<div class="row margin-none">';
                                        if (val.location.album.length > 0) {
                                            html += '<ul class="list-unstyled person-content-slide">';
                                            $.each(val.location.album, function (key, image) {
                                                if (key <= 6) {
                                                    html += '<li><img src="{{URL::to('/')}}' + image.thumbnail + '" alt=""></li>';
                                                }
                                            });
                                            html += '<li class="text-right"> <a href="' + val.location.url + '"><button class="btn btn-default">xem thêm</button></a></li>';
                                            html += '</ul>';
                                        }
                                        html += '</div>';
                                    }
                                    html += '</div>';
                                }

                                <!-- comment - like - share -->
                                html += '<div class="row margin-none">';
                                html += '<div class="person-text-assoc">';
                                html += '<a href="#" class="action-assoc" data-type="post_item" data-action="' + val.is_like + '" data-user-id="{{$user_auth->id}}" data-post-id="' + val.id + '">';
                                html += (val.is_like == 'like') ? 'Thích' : 'Bỏ thích';
                                html += '</a>';
                                html += '<a href="#" class="comment-hint">Bình luận <span class="total-comment badge badge-default">' + val.post_comment.length + '</span></a>';
                                html += '<a href="#">Chia sẻ</a>';
                                html += '</div>';
                                html += '</div>';
                                html += '<div class="box-comment">';
                                html += '<ul class="row margin-none blog-comment-wrapper">';
                                if (val.post_comment.length > 0) {
                                    $.each(val.post_comment, function (key_comment, val_commnent) {
                                        var type_appear = (key_comment < val.post_comment.length - 3) ? "hidden" : "";
                                        html += '<li class="margin-bottom-10 clearfix ' + type_appear + '" style="list-style: none!important;">';
                                        html += '<div class="col-md-12 article-img-text col-none-padding">';
                                        html += '<img class="avatar-pad2" style="width: 36px!important; height: 36px!important;" src="{{URL::to('/')}}' + val_commnent.user.avatar + '" alt="">';
                                        html += '<div class="person-content-info blog-comment-item">';
                                        html += '<div>';
                                        html += '<a href="' + URL + '/trang-ca-nhan/' + val_commnent.user.username + '.html">' + ((val_commnent.user.fullname == null) ? (val_commnent.user.username) : (val_commnent.user.fullname)) + '</a>';
                                        html += '<span class="content-comment" style="font-weight: 500; font-size: 1em;"> - ' + val_commnent.content + '</span>';
                                        html += '</div>';
                                        html += '<span class="grey">' + val_commnent.updated_at + '</span> -';
                                        html += '<span> <a href="#" style="font-weight: 600; font-size: 0.9em;" class="action-assoc" data-action="like" data-type="post_comment" data-user-id="{{$user_auth->id}}" data-post-id="' + val_commnent.id + '">Thích</a></span> -';
                                        html += '<span class="click-like-comment"><i class="icon-thumbs-up"></i></span><span class="total-comment-like">0</span>';
                                        html += '</div>';
                                        html += '</div>';
                                        html += '</li>';
                                    });
                                }
                                html += '</ul>';

                                if (val.post_comment.length > 3) {
                                    html += ' <div class="margin-bottom-10">...<a href="#" class="action-view-more" type="show">Xem thêm</a></div>';
                                }

                                <!-- comment - like - share -->
                                html += '</div>';
                                html += '<div class="row margin-none person-command">';
                                html += '<div class="col-md-12 col-none-padding">';
                                html += '<a href="#" class = "click-like">';
                                html += (val.is_like == 'like') ? '<i class="icon-thumbs-up-alt"></i>' : '<i class="icon-thumbs-down-alt"></i>';
                                html += '</a>';
                                html += '<span class="total-like">' + val.total_like + '</span> người thích điều này';
                                html += '</div>';
                                html += '<div class="col-md-12 article-img-text col-none-padding">';
                                html += '<div class="row margin-none">';
                                html += '<img class="col-md-1 col-ms-1 avatar-pad2" src="{{URL::to('/').$user_auth->avatar}}" alt="">';
                                html += '<input class="col-md-11 col-ms-11 col-xs-11 comment" data-post-id="' + val.id + '" type="text" placeholder="Viết bình luận...">';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>'
                            })
                            var item_person = $('<div/>').append(html);

                            // bat su kien cho item action load more
                            item_person.find('ul.btn-privacy-change li').on('click', function () {
                                var tag_privacy_val = $(this).closest('.person-type-scopy').find('.btn-privacy-val');
                                var privacy_text = tag_privacy_val.text();
                                var privacy_id = tag_privacy_val.attr('value_id');

                                tag_privacy_val.attr('value_id', $(this).attr('value_id'));
                                tag_privacy_val.text($(this).text());

                                tag_privacy_val.blogPrivacy({
                                    callback: function (respon) {
                                        if (!respon) {
                                            tag_privacy_val.text(privacy_text);
                                            tag_privacy_val.attr('value_id', privacy_id);
                                        }
                                    }
                                });
                            });
                            anchor_bottom.before(item_person).attr('data-offet', parseInt(data_offset) + 5);

                            // bat su kien like cho item load more
                            item_person.find('.action-assoc').on('click', function (e) {
                                e.preventDefault();
                                blogLike($(this));
                            })

                            //event dup like
                            item_person.find('.click-like').click(function (e) {
                                e.preventDefault();
//                                $(this).closest('.person-content-item').find('.action-assoc').trigger('click');
                            });

//                            trigger event enter comment
                            item_person.find('.comment').keypress(function (e) {
                                comment($(this), e);
                            });

                            //focus den binh luan
                            item_person.find('.comment-hint').on('click', function (e) {
                                e.preventDefault();
                                $(this).closest('.person-content-item').find('.comment').focus();
                            });

                            item_person.find('.action-view-more').on('click', function (e) {
                                e.preventDefault();
                                loadCommentItem($(this));
                            });
                        }
                        else {
                            btb_action.addClass('disabled').text('.:: Kết thúc ::.');
                        }
                    }
                });
            });
            /**---- END luuhoabk - action more ---**/

            $('.comment-hint').on('click', function (e) {
                e.preventDefault();
                $(this).closest('.person-content-item').find('.comment').focus();
            });
//----------------------------
            // like
            $('.action-assoc').on('click', function (e) {
                e.preventDefault();
                blogLike($(this));
            });
            //event dup like
            $('.click-like').click(function (e) {
                e.preventDefault();
//                $(this).closest('.person-content-item').find('.action-assoc').trigger('click');
            });

            // trigger event enter comment
            $('.comment').keypress(function (e) {
                comment($(this), e);
            });

            //action view more comment
            $('.action-view-more').on('click', function (e) {
                e.preventDefault();
                loadCommentItem($(this));
            });

            //submit form blog infor
            $('form#frm-user-info').submit(function (e) {
                e.preventDefault();
                $.blockUI({message: '<div class="block-ui"><i class="icon-spin2 animate-spin"></i> Đang xử lý</div>'});
                $.ajax({
                    url: "{{URL::to('thanh-vien/update-info')}}",
                    type: 'post',
                    data: $(this).serialize() + '&update_type=user_info',
                    success: function (respon) {
                        console.log(respon);
//                            if(respon){
//                                alert('Cập nhật thành công.');
//                            }else{ alert('Cập nhật thất bại.');}
                    },
                    complete: function () {
                        $.unblockUI();
                    }

                });
            });

            //submit form acount infor
            $('form#frm-acount-info').submit(function (e) {
                var self = $(this);
                e.preventDefault();
                if (self.find('#password').val() != self.find('#password_confirmation').val()) {
                    alert('Mật khẩu xác nhận không khớp. Xin vui lòng thử lại.');
                    self.find('#password').focus();
                    self.find('#reset-pass').trigger('click');
                    return;
                }
                $.blockUI({message: '<div class="block-ui"><i class="icon-spin2 animate-spin"></i> Đang xử lý</div>'});
                $.ajax({
                    url: "{{URL::to('thanh-vien/update-info')}}",
                    type: 'post',
                    data: $(this).serialize() + '&update_type=acount_info',
                    success: function (respon) {
                        if (respon) {
                            alert('Cập nhật mật khẩu thành công.');
                        } else {
                            alert('Cập nhật mật khẩu thất bại.');
                        }
                    },
                    complete: function () {
                        self.find('#password').focus();
                        self.find('#reset-pass').trigger('click');
                        $.unblockUI();
                    }

                });
            });

//--------------------------------

            /**---- END luuhoabk - action more ---**/
            function blogLike(self) {
                var action = self.attr('data-action');
                var type = self.attr('data-type');
                if (type == 'post_item') {
                    var tag_icon = self.closest('.person-content-item').find('.click-like i');
                } else {
                    var tag_icon = self.closest('.blog-comment-item').find('.click-like-comment i');
                }
                tag_icon.iconLoad(tag_icon.attr('class'));
                self.like({
                    callback: function (respon) {
                        console.log(respon);
                        if (respon != -1) {
                            if (type == 'post_item') {
                                if (action == 'like') {
                                    self.text('Bỏ thích');
                                    self.attr('data-action', 'unlike');
                                    self.closest('.person-content-item').find('.click-like i').iconUnload('icon-thumbs-down-alt');
                                } else if (action == 'unlike') {
                                    self.text('Thích');
                                    self.attr('data-action', 'like');
                                    self.closest('.person-content-item').find('.click-like i').iconUnload('icon-thumbs-up-alt');
                                }
                                self.closest('.person-content-item').find('.total-like').text(respon);
                            } else {
                                if (action == 'like') {
                                    self.text('Bỏ thích');
                                    self.attr('data-action', 'unlike');
                                    self.closest('.blog-comment-item').find('.click-like-comment i').iconUnload('icon-thumbs-up');
                                } else if (action == 'unlike') {
                                    self.text('Thích');
                                    self.attr('data-action', 'like');
                                    self.closest('.blog-comment-item').find('.click-like-comment i').iconUnload('icon-thumbs-up');
                                }
                                self.closest('.blog-comment-item').find('.total-comment-like').text(respon);
                            }

                        }
                    }
                });
            }

            /**---- luuhoabk - handle event comment ---**/
            function comment(self, event) {
                var code = event.keyCode || event.which;
                if (code == 13) { //Enter keycode
                    var comment_content = self.val();
                    var post_id = self.attr('data-post-id');
                    if (comment_content.length <= 0) {
                        alert('Bình luận không được để trống');
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "{{URL::to('thanh-vien/comment-post')}}",
                            data: {
                                'comment_content': comment_content,
                                'post_type': 'comment',
                                'post_id': post_id
                            },
                            dataType: 'json',
                            success: function (respon) {
                                if (respon.success) {
                                    self.val('');
                                    var html = '';
                                    html += '<div class="col-md-12 article-img-text col-none-padding">';
                                    html += '<img class="avatar-pad2" style="width: 36px!important; height: 36px!important;" src="{{URL::to('/').$user_auth->avatar}}" alt="">';
                                    html += '<div class="person-content-info blog-comment-item">';
                                    html += '<div>';
                                    html += '<a href="' + URL + '/trang-ca-nhan/{{$user_auth->username}}.html">@if(isset($user_auth->fullname)) {{$user_auth->fullname}} @else {{$user_auth->username}} @endif</a> -';
                                    html += '<span class="content-comment" style="font-weight: 500; font-size: 1em;">' + comment_content + '</span>';
                                    html += '</div>';
                                    html += '<span class="grey">' + respon.updated_date + '</span> -';
                                    html += '<span> <a href="#" style="font-weight: 600; font-size: 0.9em;" class="action-assoc" data-action="like" data-type="post_comment" data-user-id="{{$user_auth->id}}" data-post-id="' + respon.post_id + '">Thích</a></span> -';
                                    html += '<span class="click-like-comment"><i class="icon-thumbs-up"></i></span><span class="total-comment-like">0</span>';
                                    html += '</div>';
                                    html += '</div>';

                                    var tag_comment = $('<li/>', {
                                        'class': 'margin-bottom-10 clearfix',
                                        'style': 'list-style: none!important;'
                                    }).append(html);
                                    tag_comment.find('.action-assoc').on('click', function (e) {
                                        e.preventDefault();
                                        blogLike($(this));
                                    });
                                    self.closest('.person-content-item').find('ul.blog-comment-wrapper').append(tag_comment);
                                    var total_comment = self.closest('.person-content-item').find('.total-comment');
                                    total_comment.text(parseInt(total_comment.text()) + 1);
                                }
                            }
                        });
                    }
                }
            }

            /**---- luuhoabk - handle event like comment ---**/
            function postStatus(self) {
                var content_status = $('#content-status').val();
                if (content_status.length <= 0) {
                    alert('Trạng thái không được rỗng   .');
                    $('#content-status').focus();
                    return false;
                }
                var privacy_status = $('#main-status').attr('value_id');
                var anchor_load = $('.anchor_load');
                anchor_load.removeClass('hidden').fadeIn;
                $.ajax({
                    type: "POST",
                    url: URL + "/trang-ca-nhan/trang-thai.html",
                    data: {
                        'content_status': content_status,
                        'privacy_status': privacy_status,
                        'type_edit': 'add_status',
                        'blog_id': '{{$user_blog->id}}'
                    },
//                    async: true,
                    success: function (data) {
                        data = $.parseJSON(data);
                        if (data.success) {
                            var html = ' <div class="row person-content-item">';
                            html += '<div class="col-md-12 col-none-padding">';
                            html += '<div class="col-md-9 article-img-text col-none-padding">';
                            html += '<img class="avatar-pad2" src="{{URL::to('/').$user_blog->avatar}}" alt="">';
                            html += '<div class="person-content-info">';
                            html += '<div><a>{{empty($user_blog->fullname)?$user_blog->username : $user_blog->fullname;}}</a><span> - {{$blog_info['level']}}</span></div>';
                            html += '<span>Đã cập nhật trạng thái.</span><br>';
                            html += '<span>' + data.updated_date + '</span>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="col-md-3 col-none-padding text-right">';
                            html += '<div class="btn-group person-type-scopy">';
                            html += '<button type="button" class="btn btn-default btn-xs btn-privacy-val" post_id="' + data.id + '" value_id="' + data.privacy + '">' + data.privacy_description + '</button>';
                            html += '<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">';
                            html += '<i class="icon-down-dir"></i>';
                            html += '</button>';
                            html += '<ul class="dropdown-menu btn-privacy-change" role="menu">';
                            html += '<li value_id="15">Chỉ mình tôi</li>';
                            html += '<li value_id="16">Bạn bè</li>';
                            html += '<li value_id="17">Bạn của bạn tôi</li>';
                            html += '<li value_id="18">Cộng đồng</li>';
                            html += '</ul>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="col-md-12 col-none-padding person-content-article">';
                            html += '<div class="row margin-none">';
                            html += '<section class="article-img-text clearfix content-article-wrapper">';
                            html += '<div class="text-algin-img">';
                            html += '<article>';
                            html += data.content;
                            html += '</article>';
                            html += '</div>';
                            html += '</section>';
                            html += '</div>';
                            html += '</div>';
                            <!-- comment - like - share -->
                            html += '<div class="row margin-none">';
                            html += '<div class="person-text-assoc">';
                            html += '<a href="#" class="action-assoc" data-action="like" data-type="post_item" data-user-id="{{$user_auth->id}}" data-post-id="' + data.id + '">Thích</a>';
                            html += '<a href="#" class="comment-hint">Bình luận <span class="total-comment badge badge-default">0</span></a>';
                            html += '<a href="#">Chia sẻ</a>';
                            html += '</div>';
                            html += '</div>';

                            <!-- comment - like - share -->
                            html += '<ul class="row margin-none blog-comment-wrapper">';
                            html += '</ul>';
                            html += '<div class="row margin-none person-command">';
                            html += '<div class="col-md-12 col-none-padding">';
                            html += '<a href="#" class="click-like"><i class="icon-thumbs-up-alt"></i></a>';
                            html += '<span class="total-like">0</span> người thích điều này';
                            html += '</div>';
                            html += '<div class="col-md-12 article-img-text col-none-padding">';
                            html += '<div class="row margin-none">';
                            html += '<img class="col-md-1 col-ms-1 avatar-pad2" src="{{URL::to('/').$user_auth->avatar}}" alt="">';
                            html += '<input class="col-md-11 col-ms-11 col-xs-11 comment" data-post-id="' + data.id + '" type="text" placeholder="Viết bình luận...">';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';


                            var item_person = $('<div/>').append(html);
                            // bat su kien thay doi quyen post
                            item_person.find('ul.btn-privacy-change li').on('click', function () {
                                var tag_privacy_val = $(this).closest('.person-type-scopy').find('.btn-privacy-val');
                                var privacy_text = tag_privacy_val.text();
                                var privacy_id = tag_privacy_val.attr('value_id');

                                tag_privacy_val.attr('value_id', $(this).attr('value_id'));
                                tag_privacy_val.text($(this).text());
                                tag_privacy_val.blogPrivacy({
                                    callback: function (respon) {
                                        if (!respon) {
                                            tag_privacy_val.text(privacy_text);
                                            tag_privacy_val.attr('value_id', privacy_id);
                                        }
                                    }
                                });
                            });

                            item_person.find('.action-assoc').on('click', function (e) {
                                e.preventDefault();
                                blogLike($(this));
                            });
                            //event dup like
                            item_person.find('.click-like').click(function (e) {
                                e.preventDefault();
                                $(this).closest('.person-content-item').find('.action-assoc').trigger('click');
                            });
                            item_person.find('.comment-hint').on('click', function (e) {
                                e.preventDefault();
                                $(this).closest('.person-content-item').find('.comment').focus();
                            });
                            item_person.find('.comment').keypress(function (e) {
                                comment($(this), e);
                            });

                            $('#anchor_top').after(item_person);
                        } else {
                            alert('Cập nhật trạng thái thất bại. Xin vui lòng thử lại.');
                        }
                    },
                    complete: function () {
                        anchor_load.addClass('hidden').fadeOut;
                    }
                });
//                $("#content-status").attr('value',null);
                $("#content-status").val('');
                $("#content-status").focus();
            }

            function loadCommentItem(self) {
                if (self.attr('type') == 'show') {
                    self.closest('.box-comment').find('li.hidden').removeClass('hidden');
                    self.text('Thu gọn');
                    self.attr('type', 'hidden');
                } else {
                    var length_tag = self.closest('.box-comment').find('li').length;
                    self.closest('.box-comment').find('li').each(function (key, val) {
                        var index = $(this).index();
                        if (index <= length_tag - 4) {
                            $(this).addClass('hidden');
                        }
                    })
                    self.text('Xem thêm');
                    self.attr('type', 'show');
                }
            }
        });
    </script>
@if(Auth::check())
    <script>
        /* imtoantran fchat start */
        var fb = 'https://choidau.firebaseio.com/chat', ur = 0, f, b = "body", m = '.mI', k = 'keydown', w = "#chat-wrapper", cl = "click", mc = "ch-message-chat";
        var ca = function (snt) {
            //GET DATA
            var data = snt.val();
            if (data.sender == "{{Auth::id()}}" || data.receiver == "{{Auth::id()}}") {
                id = ((data.sender == "{{Auth::id()}}") ? data.receiver : data.sender);
                var ml = $(w).find("ul[data-id=" + id + "]");
                if (ml.length) {
                    var message_container = $("<div/>", {class: "message-container"});
                    time = new Date(data.timestamp);
                    var message = $("<div/>", {class: "message", text: data.text, title: time.toLocaleDateString()});
                    //CREATE ELEMENTS MESSAGE & SANITIZE TEXT
                    var messageElement = $("<li>");
                    if (data.receiver == parseInt("{{Auth::id()}}")) {
                        avatar = $("<img />", {src: $("#friend-online img[data-id=" + data.sender + "]").attr("src")});
                        nameElement = $("<div class='ch-message-chat-username'>").append(avatar);
                        messageElement.append(nameElement).addClass("left");
                        if ($("." + mc + ".active").length) {
                            ur = 0;
                        } else {
                            ur++;
                            $("." + mc).addClass("new");
                        }
                    } else if (data.sender == parseInt("{{Auth::id()}}")) {
                        messageElement.addClass("right");
                    }
                    message_container.append(message).append(("<div class='time'><small><time> " + time.toLocaleTimeString() + " </time></small></div>"));
                    messageElement.append(message_container);
                    //ADD MESSAGE
                    ml.append(messageElement);
                    messageElement.append("<div class='clearfix'>");

                    //SCROLL TO BOTTOM OF MESSAGE LIST
                    ml[0].scrollTop = ml[0].scrollHeight;
                }
            }
        };
        $.fn.c = function (options) {
            $(this).on(cl, ".friend-online", function (e) {
                e.stopPropagation();
                sessionStorage.currentChat = $(this).data("id");
                if ($(b).find(".ch-message-chat[data-id=" + $(this).data("id") + "]").length) {
                    $(".ch-message-chat").addClass("active");
                    return;
                }
                $(".ch-message-chat").remove();
                var fchat = $("<div/>", {class: mc + " active", "data-id": $(this).data("id")});
                fchat.append($("<header/>", {text: $(this).text()}).append("<span class='right'>x</span>"));
                fchat.append($("<ul class='ch-message-chat-messages' data-id='" + $(this).data("id") + "'/>"));
                var footer = $("<footer/>");
                footer.append($("<input type = 'text' class = 'mI' placeholder = 'Viết tin nhắn ...'/>").data("id", $(this).data("id")));
                fchat.append(footer);
                $(w).append(fchat);
                if (f) f.off('child_added', ca);
                f = new Firebase(fb);
                f.on('child_added', ca);
            });
        };
        $(b).c();
        var fk = function (e) {
            e.stopPropagation();
            if (e.keyCode == 13) {
                //FIELD VALUES
                var message = this.value;

                f.push({
                    timestamp: Firebase.ServerValue.TIMESTAMP,
                    receiver: $(this).data("id"),
                    text: message,
                    read: 0,
                    sender: {{Auth::id()}}
                });
                this.value = '';
            }
        };
        $(b).on(k, m, fk);
        $(w).on(cl, "header", function (e) {
            $("." + mc).removeClass("new").toggleClass("active",function(e){
                sessionStorage.currentChatWindowState = "inActive";
                if($(this).hasClass("active")){
                    sessionStorage.currentChatWindowState = "active";
                }
            });
        });
        $(w).on(cl, "header span.right", function (e) {
            $("." + mc).remove();
            sessionStorage.currentChat = 0;
        });
        if (sessionStorage.currentChat) {
            $("#friend-online .friend-online[data-id=" + sessionStorage.currentChat + "]").trigger("click");
        }
        /* imtoantran fchat stop */
    </script>
    <script>
        /* imtoantran friends online start */
        new Firebase('https://choidau.firebaseio.com/online').on("child_changed",function(s){$("#friend-online li[data-id="+s.key()+"]").addClass('active').data("timestamp",new Date());});
        checkOnlineFriend = setInterval(function(e){
            $.each($("#friend-online li.active"), function(i,e){
                if(new Date() - $(e).data("timestamp") > 8000){
                    $(e).removeClass("active");
                }
            });
        },4000);
        /* imtoantran friends online stop */
    </script>
@endif
@stop