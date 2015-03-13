<div class="row">
    <section class="person-photo person-wrapper choidau-bg">
        <header class="blog-setting-header padding-5 margin-bottom-5 white">
            <div class="wrapper-header">
                <i class="blog-icon-bg icon-folder"></i>
                <i class="blog-icon-content icon-camera"></i>
                <span class="text-1em2">Album ảnh</span>
            </div>
        </header>

        <ul class="nav nav-tabs blog-tabs" data-tabs="tabs">
            <li>
                <a aria-expanded="false" href="#photo-tab-all" data-toggle="tab">Tất cả
                    <span class="badge circle tab-avatar">1</span>
                </a>
            </li>
            <li>
                <a aria-expanded="false" href="#photo-tab-avatar" data-toggle="tab">Ảnh đại diện
                    <span class="badge circle tab-avatar">1</span>
                </a>
            </li>
            <li>
                <a aria-expanded="true" href="#photo-tab-location" data-toggle="tab">Ảnh địa điểm
                    <span class="badge circle tab-location">3</span>
                </a>
            </li>
            <li>
                <a aria-expanded="true" href="#photo-tab-member" data-toggle="tab">Ảnh từ thành viên
                    <span class="badge circle tab-location">3</span>
                </a>
            </li>
        </ul>
        <div id="my-tab-content" style="padding: 10px 5px 10px 5px;" class="tab-content">
            <div class="tab-pane" id="photo-tab-all">
                @foreach($reviewsImages as $image)

                @endforeach
            </div>
            <div class="tab-pane" id="photo-tab-avatar">
                @foreach($reviewsImages as $image)

                @endforeach
            </div>
            <div class="tab-pane" id="photo-tab-location">
                @foreach($location->images() as $image)
                    
                @endforeach
            </div>
            <div class="tab-pane active" id="photo-tab-member">
                <div class="row thumbnails margin-none ">
                    <div class="col-md-3 col-sm-6 padding-lr-5 margin-bottom-10">
                        <div class="s" style="position: relative">
                            <span class="badge-num-image">4</span>

                            <div class="badge-name">dia diem moi</div>
                            <img class="avatar-pad2"
                                 src="http://choidau.net/upload/media_user/5/foody-the-chapel-restaurant-869-635564030638738641.JPG"
                                 alt="" width="100%"></div>
                    </div>
                </div>
                <div class="hidden box-fancy"></div>
            </div>
        </div>
    </section>
</div>