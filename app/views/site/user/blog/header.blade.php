

<!-- choidau-person-header -->
<div class="person-header">
   <div style="position: relative;">
    <div class="person-header-bg" style="background-image: url('{{$blogList['background']}}')"></div>
    <div  id="iM_user_slide" type_insert="insert_one_img_anh_bia" class="single-picture-wrapper imageManager_openModal insertMedia change-img"  data-toggle="modal" data-target="#imageManager_modal"  style="top: 5px;  left: 38px;">

        <i class="icon-camera"></i><span></span>
    </div>
    <div class="change-img btn-save-anh-bia"  data-toggle="modal"  style="top: 5px;  left: 78px;display: none">

        <i class="icon-ok-circle-1"></i>
    </div>
   </div>
    <div class="row margin-none">
        <div class="col-md-2 text-right person-header-avatar">

            <img class="avatar-pad2" src=" {{$blogList['avatar']}}" width="150" height="150" alt="">

            <div  id="iM_user_slide" type_insert="insert_one_img_avatar" class="single-picture-wrapper imageManager_openModal insertMedia change-img"  data-toggle="modal" data-target="#imageManager_modal"  style="top: 5px;  left: 38px;"> <i class="icon-camera"></i></div>
            <div class="change-img btn-save-avatar"  data-toggle="modal"  style="top: 5px;  left: 78px;display: none">

                <i class="icon-ok-circle-1"></i>
            </div>
        </div>
        <div class="col-md-10 col-none-padding">
            <header class="person-header-username"> {{$blogList['name']}}</header >
            <nav class="person-header-nav">

                <ul class="">
                    <li>Hoạt động</li>
                    <li>Ảnh</li>
                    <li>Địa điểm yêu thích</li>
                    <li>Checkin</li>
                    <li>Bạn bè</li>
                    <li><i class="icon-cog"></i></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- end choidau-person-header -->
