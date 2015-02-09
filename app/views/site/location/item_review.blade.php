<div class="reviews row item-post-element-parent">

    <input type="hidden" i_p="{{$review->id}}" i_u="{{$review->user_id}}" class="input-data-value-post"/>
    <div class="media">
        <a href="#" class="pull-left">
            <img src="{{$review->author->avatar}}" alt="" class="media-object">
        </a>
        <div class="media-body">
            <div class="media-heading">
                <div class="col-sm-6">
                    <div class="row"><a href="#"><strong>{{$review->author->username}} </strong></a></div>
                </div>
                <div class="col-sm-6">
                    <div class="pull-right">

                        <ul class="list-unstyled list-inline ul-list-rating">
                            @for($i=0;$i<5;$i++)
                            @if($i<$review->getMetaKey("review_rating"))
                            <li><i class="icon-star-filled"></i></li>
                            @else
                            <li><i class="icon-star-1"></i></li>
                            @endif
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col-lg-6">
                    <div>?ã ?ánh giá ??a ?i?m</div>
                    <div><small><i>Vào lúc {{date_format($review->created_at,"h:i:s d-m-Y")}}</i></small></div>
                </div>
                <div class="col-lg-6">
                    <small class="pull-right">S? ng??i {{ $review->getMetaKey("review_visitors")}} + | Chi phí {{$review->getMetaKey("review_price")}} ?+ | S? quay l?i: @if(isset($options[$review->getMetaKey("review_visit_again")])) {{$options[$review->getMetaKey("review_visit_again")]}} @else không @endif</small>
                </div>
            </div>
        </div>
    </div>
    <div class="review-content">
        <div>
            <p class="title">{{$review->title}}</p>
            <p class="content">
                {{$review->content}}
            </p>
        </div>
    </div>
    <!-- hinh anh -->
    <?php $list_album=PostMeta::where('post_id','=',$review->id)->where('meta_key','=','review_image')->get();
    // print_r($list_album);
    ?>

    <div class="">
        @foreach($list_album as $img)
        <?php $img=Post::find($img->meta_value);
        $img_link=$img->getMetaKey('url');
        ?>

        <div class="col-md-2 col-sm-4 gallery-item">
            <a data-rel="fancybox-button" title="Project Name" href="{{$img_link}}" class="fancybox-button">
                <img alt="" src="{{$img_link}}" class="img-responsive">
                <div class="zoomix"><i class="fa fa-search"></i></div>
            </a>
        </div>
        @endforeach

    </div>
    <!-- hinh anh -->
    <!-- thao luan,like,dislike,report -->
    <?php
    if($review->userAction()->whereUser_id(Auth::check()&&Auth::user()->id)->wherePost_user_type_id('31')->count()){
        $lab_like='?ã thích ';
    }else{
        $lab_like='Thích ';
    }

    if($review->userAction()->whereUser_id(Auth::check()&&Auth::user()->id)->wherePost_user_type_id('32')->count()){
        $lab_dislike='?ã không thích ';
    }else{
        $lab_dislike='không Thích ';
    }


    if($review->userAction()->whereUser_id(Auth::check()&&Auth::user()->id)->wherePost_user_type_id('37')->count()){

        $lab_spam='Đã báo cáo xấu';
    }else{
        $lab_spam='Báo cáo xấu ';
    }
    ?>

    <div class="col-md-12 review-action padding-left-0">
        <a class="btn-post-comment"><i class="icon-edit"></i>Th?o lu?n</a>
        <a class="btn-post-like" type_action="31"><i class="icon-thumbs-up"></i><span class="lab_text_like">{{$lab_like}}</span><span class="lab_num_like">{{ $review->countLike()}}</span></a>
        <a class="btn-post-dislike"  type_action="32"><i class="icon-thumbs-down"></i><span class="lab_text_dislike">{{$lab_dislike}}</span><span class="lab_num_dislike">{{ $review->countDisLike()}}</span></a>
        <a class="btn-post-spam" type_action="37"><i class="icon-block"></i><span class="lab_text_spam">{{$lab_spam}}</span></a>
        <a class="btn-post-view_more pull-right"><i>Xem thêm</i></a>
    </div>
    <!-- thao luan,like,dislike,report end-->

</div>