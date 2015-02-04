<div class="reviews row item-post-element-parent">
    <input type="hidden" i_p="353" i_u="5" class="input-data-value-post">
    <div class="media">
        <a href="#" class="pull-left">
            <img src="{{$user_author->avatar}}" alt="" class="media-object">
        </a>
        <div class="media-body">
            <div class="media-heading">
                <div class="col-sm-6">
                    <div class="row"><a href="#"><strong>{{$user_author->username}} </strong></a></div>
                </div>
                <div class="col-sm-6">
                    <div class="pull-right">
                        <ul class="list-unstyled list-inline ul-list-rating">
                            <li><i class="icon-star-filled"></i></li>
                            <li><i class="icon-star-filled"></i></li>
                            <li><i class="icon-star-filled"></i></li>
                            <li><i class="icon-star-1"></i></li>
                            <li><i class="icon-star-1"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col-lg-6  col-none-padding">
                    <div>Đã đăng sự kiện</div>
                    <div><small><i>Vào lúc {{String::showTimeAgo($event->created_at())}}</i></small></div>
                </div>
                <div class="col-lg-6  col-none-padding">
                    <small class="pull-right">Số người  + | Chi phí  đ+ | Sẽ quay lại:  không </small>
                </div>
            </div>
        </div>
    </div>
    <div class="review-content">
        <div>
            <p class="title">{{$event['title']}}</p>
            <p class="content">
                bài test thứ 2&nbsp;bài test thứ 2&nbsp;bài test thứ 2bài test thứ 2bài test thứ 2bài test thứ 2bài test thứ 2bài test thứ 2
            </p>
        </div>
    </div>
    <!-- hinh anh -->


    <div class="">
        <div class="col-md-2 col-sm-4 gallery-item">
            <a data-rel="fancybox-button" title="Project Name" href="/upload/media_user/5/foody-bibimbap-korean-food.JPG" class="fancybox-button">
                <img alt="" src="/upload/media_user/5/foody-bibimbap-korean-food.JPG" class="img-responsive">
                <div class="zoomix"><i class="fa fa-search"></i></div>
            </a>
        </div>
        <div class="col-md-2 col-sm-4 gallery-item">
            <a data-rel="fancybox-button" title="Project Name" href="/upload/media_user/5/foody-the-chapel-restaurant-705-635564030635150634.JPG" class="fancybox-button">
                <img alt="" src="/upload/media_user/5/foody-the-chapel-restaurant-705-635564030635150634.JPG" class="img-responsive">
                <div class="zoomix"><i class="fa fa-search"></i></div>
            </a>
        </div>

    </div>
    <!-- hinh anh -->
    <!-- thao luan,like,dislike,report -->

    <div class="col-md-12 review-action padding-left-0">
        <a class="btn-post-comment"><i class="icon-edit"></i>Thảo luận</a>
        <a class="btn-post-like" type_action="31"><i class="icon-thumbs-up"></i><span class="lab_text_like">Thích </span><span class="lab_num_like">0</span></a>
        <a class="btn-post-dislike" type_action="32"><i class="icon-thumbs-down"></i><span class="lab_text_dislike">Đã không thích </span><span class="lab_num_dislike">1</span></a>
        <a class="btn-post-spam" type_action="37"><i class="icon-block"></i><span class="lab_text_spam">Đã báo cáo xấu</span></a>
        <a class="btn-post-view_more pull-right"><i>Xem thêm</i></a>
    </div>
    <!-- thao luan,like,dislike,report end-->

</div>