

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
    <div  id="btn-blog-bg" class="single-picture-wrapper change-img" style="top: 15px;  left: 20px;">
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
                <img class="avatar-pad2 blog-img-avatar" src="{{$blog_info['avatar']}}" width="150" height="150" alt="">
            @else
                <img class="avatar-pad2 blog-img-avatar" src="{{URL::asset('/assets/global/img/no-image.png')}}" width="150" height="150" alt="">
            @endif

            <div  id="btn-blog-avatar"  class="single-picture-wrapper change-img" style="top: 10px;  left: 40px;">
                @if(Auth::check() && Auth::user()->id == $blog_info['id'])
                    <i class="icon-camera" style="font-size: 18px;"></i>
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
                <ul class="nav nav-tabs nav-justified blog-navigation" role="tablist">
                    {{--action--}}
                    <li role="presentation" class="active">
                        <a href="#blog-tab-action" id="btn-tag-blog-action" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">Hoạt động</a>
                    </li>

                    {{--photo--}}
                    <li role="presentation" class="">
                        <a href="#blog-tab-photo" id="btn-tag-blog-photo" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Ảnh</a>
                    </li>

                    {{--location--}}
                    <li role="presentation" class="">
                        <a href="#blog-tab-location" id="btn-tag-blog-location"  aria-controls=""  role="tab" data-toggle="tab" aria-expanded="false">Địa điểm</a>
                    </li>
                    {{--End location--}}
                    <li role="presentation">
                        <a href="#blog-tab-friend" id="btn-tag-blog-friend" aria-controls="tab-settings" role="tab" data-toggle="tab" aria-expanded="true">Bạn bè</a>
                    </li>
                    <li role="presentation"  class="">
                        <a href="#blog-tab-setting" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="true"><i class="icon-cog"></i></a>
                    </li>
                </ul>

            </nav>
        </div>
    </div>
</div>

<!-- end choidau-person-header -->
