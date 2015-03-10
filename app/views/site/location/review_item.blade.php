<script src="{{asset("assets/frontend/layout/scripts/layout.js")}}"></script>
@foreach($reviews as $review)
<div class="reviews row item-post-element-parent">

    <input type="hidden" i_p="{{$review->id}}" i_u="{{$review->user_id}}"
           class="input-data-value-post"/>

    <div class="media">
        <a href="#" class="pull-left">
            <img src="../../assets/frontend/pages/img/people/img4-small.jpg" alt=""
                 class="media-object">
        </a>

        <div class="media-body">
            <div class="media-heading">
                <div class="col-sm-6">
                    <div class="row"><a
                            href="#"><strong>@if(isset($review->author->fullname)) {{$review->author->fullname}} @else {{$review->author->username}} @endif </strong></a>
                    </div>
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
                    <div>Đã đánh giá địa điểm</div>
                    <div>
                        <small><i>Vào
                                lúc {{date_format($review->created_at,"h:i:s d-m-Y")}}</i>
                        </small>
                    </div>
                </div>
                <div class="col-lg-6">
                    <small class="pull-right">Số
                        người {{ $review->getMetaKey("review_visitors")}} + | Chi
                        phí {{$review->getMetaKey("review_price")}} đ+ | Sẽ quay
                        lại: @if(isset($options[$review->getMetaKey("review_visit_again")])) {{$options[$review->getMetaKey("review_visit_again")]}} @else
                        không @endif</small>
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
    <div class="">
        @if($review->recentImage())
        @foreach($review->recentImage() as $img)
        <div class="col-md-2 col-sm-4 gallery-item">
            <a data-rel="fancybox-button" title="Project Name" href="{{$img->guid}}"
               class="fancybox-button">
                <img alt="" src="{{$img->thumbnail}}" class="img-responsive">

                <div class="zoomix"><i class="fa fa-search"></i></div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
    <!-- hinh anh -->
    <!-- thao luan,like,dislike,report -->
    <div class="col-md-12 review-action padding-left-0">
        <a class="btn-post-comment">
            <i class="icon-edit"></i>Thảo luận
        </a>
        <a class="social-btn @if($review->isLiked()) true @endif" data-action="like" data-id="{{$review->id}}" href="{{URL::to("post/social/$review->id")}}">
            <span class="liked"><i class="icon-thumbs-down"></i>Đã thích</span>
            <span class="un-liked"><i class="icon-thumbs-up"></i>Thích</span>
            <span class="total-liked">{{ $review->totalLikes()}}</span>
        </a>
        <a @if(!$review->isReportedSpam()) href="{{URL::to("post/social/$review->id")}}" class="social-btn"  data-action="spam" data-id="{{$review->id}}" @else href="#" @endif>
            @if(!$review->isReportedSpam())
                <span class="report-spam"><i class="icon-block"></i>Báo xấu</span>
            @else
                <span class="report-spam"><i class="icon-block"></i>Đã báo xấu</span>
            @endif
        </a>
        <a class="btn-post-view_more pull-right"><i>Xem thêm</i></a>
    </div>
    <textarea class="form-control comment-btn" rows="1" data-id="{{$review->id}}"></textarea>
    <!-- thao luan,like,dislike,report end-->

</div>
@endforeach
{{--$reviews->setBaseUrl("location/$location->id/reviews");--}}
<div class="paging">{{$reviews->links()}}</div>
<script>
    /* load reviews start */
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        if ( $(this).attr('href') != '#' ) {
            $("html, body").animate({ href: "#review" }, "fast");
            $('#review').load($(this).attr('href'));
        }
    });
    $(".social-btn").social();
    /* load reviews stop */
    /* comment start */
    $(".comment-btn").comments({
        controller:"{{URL::to("post/comments")}}"
    });
    /* comment stop */
</script>