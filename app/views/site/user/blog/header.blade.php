

<!-- choidau-person-header -->
<div class="person-header">
   <div style="position: relative;">
    <div class="person-header-bg" style="background-image: url('{{$blog_info['background']}}'); position: relative;">
        @if(Auth::check()&&Auth::user()->id != $blog_info['id'])
            <span i_u="{{$blog_info['id']}}" class="box-top-friend" style="position: absolute; right: 10px; z-index:10; bottom: 5px;">
                @if($blog_info['friend_status'] == 35)
                    <button i_u="{{$blog_info['id']}}"  class="btn btn-default btn-sm btn-title-friend" style="text-transform: inherit; cursor: default; padding: 2px 8px 1px 4px;">
                        <i class="icon-hourglass black"> </i>
                        Đã gửi lời mời kết bạn
                    </button>
                @elseif($blog_info['friend_status'] == 34)
                    <button i_u="{{$blog_info['id']}}"  class="btn btn-default btn-delete-friend btn-sm btn-title-friend" style="text-transform: inherit; padding: 2px 8px 1px 4px;">
                        <i class="icon-user-delete black"> </i>
                        Hủy kết bạn
                    </button>
                @else
                    <button i_u="{{$blog_info['id']}}"  class="btn btn-default btn-header-add-friend btn-sm btn-title-friend" style="text-transform: inherit; padding: 2px 8px 1px 4px;">
                        <i class="icon-user-add black"> </i>
                        Kết bạn
                    </button>
                @endif

                <button i_u="{{$blog_info['id']}}"  class="btn btn-default btn-sm btn-delete-confirm-friend tooltips @if($blog_info['friend_status'] != 35) hidden @endif" data-original-title="Hủy kết bạn" style="padding: 2px 4px 1px 4px;">
                    <i class="icon-cancel-2"> </i>
                </button>
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
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">Hoạt động</a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#tag-blog-photo-content" id="btn-tag-blog-photo" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Ảnh</a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#tag-blog-location-like-content" aria-controls="messages" id="btn-tag-blog-location-like" role="tab" data-toggle="tab" aria-expanded="false">Địa điểm yêu thích</a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#tag-blog-checkin-content" aria-controls="settings" id="btn-tag-blog-checkin" role="tab" data-toggle="tab" aria-expanded="true">Checkin</a>
                    </li>
                    <li role="presentation">
                        <a href="#tag-blog-friend-content" id="btn-tag-blog-friend" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="true">Bạn bè</a>
                    </li>
                    <li role="presentation">
                        <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="true"><i class="icon-cog"></i></a>
                    </li>
                </ul>

            </nav>
        </div>
    </div>
</div>
<!-- end choidau-person-header -->
