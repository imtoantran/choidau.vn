

<!-- choidau-person-header -->
<div class="person-header">
   <div style="position: relative;">
    <div class="person-header-bg" style="background-image: url('{{$blog_info['background']}}'); position: relative;">
        {{--luuhoabk - action duoc xu ly ben layout.js -> loadActionFriend() --}}
        @if(Auth::check() && Auth::user()->id != $blog_info['id'])
            <span i_u="{{$blog_info['id']}}" class="box-top-friend" style="position: absolute; right: 10px; z-index:10; bottom: 5px;">
                @if(count($blog_info['state_user'])>0)
                    <button class="btn btn-default btn-sm-8 margin-none btn-friend" data-type="delete" friend_id="{{$blog_info['id']}}"><i class="icon-user-delete" style="font-size: 1.2em;"></i>Hủy</button>
                    @if($blog_info['state_user']['status_id'] == 35)
                        <span class="italic text-grey font-10px sub-alert"> Đã gửi lời mời</span>
                    @else
                        <span class="italic text-grey font-10px sub-alert"> Đã kết bạn</span>
                    @endif
                @elseif(count($blog_info['state_friend'])>0)
                    @if($blog_info['state_friend']['status_id'] == 35)
                        <button class="btn btn-default btn-sm-8 margin-none btn-friend" data-type="confirm" friend_id="{{$blog_info['id']}}"><i class="icon-user-add" style="font-size: 1.2em;"></i>Chấp nhận</button>
                        <span class="italic text-grey font-10px sub-alert"> Đang chờ</span>
                    @else
                        <button class="btn btn-default btn-sm-8 margin-none btn-friend" data-type="delete" friend_id="{{$blog_info['id']}}"><i class="icon-user-delete" style="font-size: 1.2em;"></i>Hủy</button>
                        <span class="italic text-grey font-10px sub-alert"> Đã kết bạn</span>
                    @endif
                @else
                    <button class="btn btn-default btn-sm-8 margin-none btn-friend" data-type="add" friend_id="{{$blog_info['id']}}"><i class="icon-user-add" style="font-size: 1.2em;"></i>Kết bạn</button>
                    <span class="italic text-grey font-10px sub-alert"></span>
                @endif
            </span>
        @endif
    </div>
    <div  id="iM_user_slide" type_insert="insert_one_img_anh_bia" class="single-picture-wrapper imageManager_openModal insertMedia change-img"  data-toggle="modal" data-target="#imageManager_modal"  style="top: 15px;  left: 20px;">
        @if(Auth::check()&&Auth::user()->id==$blog_info['id'])
        <i class="icon-camera"></i>
        @endif
      <span></span>

    </div>
    <div class="change-img btn-save-anh-bia"  data-toggle="modal"  style="top: 5px;  left: 78px;display: none">
        <i class="icon-ok-circle-1"></i>
    </div>
   </div>
    <div class="row margin-none">
        <div class="col-md-2 text-right person-header-avatar">

            @if(isset($blog_info['avatar']) && !empty($blog_info['avatar']))
                <img class="avatar-pad2" src="{{$blog_info['avatar']}}" width="150" height="150" alt="">
            @else
                <img class="avatar-pad2" src="{{URL::asset('/assets/global/img/no-image.png')}}" width="150" height="150" alt="">
            @endif

            <div  id="iM_user_slide" type_insert="insert_one_img_avatar" class="single-picture-wrapper imageManager_openModal insertMedia change-img"  data-toggle="modal" data-target="#imageManager_modal"  style="top: 10px;  left: 40px;">
                @if(Auth::check()&&Auth::user()->id==$blog_info['id'])
                    <i class="icon-camera" style="font-size: 18px; padding:"></i>
                    {{--<span style="color: #fff; font-size: 0.9em;">Cập nhật ảnh đại diện</span>--}}
                @endif
            </div>
            <div class="change-img btn-save-avatar"  data-toggle="modal"  style="top: 5px;  left: 78px;display: none">

                <i class="icon-ok-circle-1"></i>


            </div>
        </div>
        <div class="col-md-10 col-none-padding">
            <header class="person-header-username" id_u_blo="{{$blog_info['id']}}">
                @if(isset($blog_info['name']) && !empty($blog_info['name']))
                   {{$blog_info['name']}}
                @elseif(isset($blog_info['username']) && !empty($blog_info['username']))
                    {{$blog_info['username']}}
                @else
                    Đang cập nhật
                @endif
            </header >
            <nav class="person-header-nav">
                <ul class="nav nav-tabs nav-justified location-navigation" role="tablist">
                    <li role="presentation">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">Hoạt động</a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#tag-blog-photo-content" id="btn-tag-blog-photo" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Ảnh</a>
                    </li>
                    {{--location--}}
                    <li role="presentation" class="">
                        <a href="#blog-tab-location" aria-controls="messages" id="btn-tag-blog-location-like" role="tab" data-toggle="tab" aria-expanded="false">Địa điểm</a>
                    </li>
                    {{--End location--}}
                    <li role="presentation" class="">
                        <a href="#tag-blog-checkin-content" aria-controls="tag-blog-checkin-content" id="btn-tag-blog-checkin" role="tab" data-toggle="tab" aria-expanded="true">Checkin</a>
                    </li>
                    <li role="presentation">
                        <a href="#tag-blog-friend-content" id="btn-tag-blog-friend" aria-controls="tab-settings" role="tab" data-toggle="tab" aria-expanded="true">Bạn bè</a>
                    </li>
                    <li role="presentation"  class="active">
                        <a href="#blog-tab-setting" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="true"><i class="icon-cog"></i></a>
                    </li>
                </ul>

            </nav>
        </div>
    </div>
</div>
<!-- end choidau-person-header -->
