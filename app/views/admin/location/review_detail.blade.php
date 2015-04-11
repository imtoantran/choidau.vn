@extends('admin.layouts.main')
@section("content")
    <div class="">
        <h3>
            Chi tiết đánh giá
        </h3>
    </div>
    <div class="row detail-faq margin-0">
        <div class="col-sm-12 col-md-12 col-lg-12 col-none-padding">
            <div class="reviews row item-post-element-parent margin-0">
                <input type="hidden" i_p="{{$review->id}}" i_u="{{$review->user_id}}"
                       class="input-data-value-post"/>

                <div class="media" style=" background-color: #f8f8f8!important;  border: 1px solid #ddd!important; padding: 10px;">
                    <a href="{{$review->author->url()}}" class="pull-left">
                        <img src="{{$review->author->avatar}}" alt=""  class="media-object">
                    </a>
                    <div class="media-body">
                        <div class="media-heading">
                            <div class="col-sm-6">
                                <div class="row">
                                    <a href="{{$review->author->url()}}">
                                        <strong>@if(isset($review->author->fullname)) {{$review->author->fullname}} @else {{$review->author->username}} @endif </strong>
                                    </a>
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
                                    <small>
                                        <i>Vào lúc {{date_format($review->created_at,"h:i:s d-m-Y")}}</i>
                                    </small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <small class="pull-right">Số
                                    người {{ $review->getMetaKey("review_visitors")}} + | Chi
                                    phí {{$review->getMetaKey("review_price")}} đ+ | Sẽ quay
                                    lại: @if(isset($options[$review->getMetaKey("review_visit_again")])) {{$options[$review->getMetaKey("review_visit_again")]}} @else
                                        không @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="review-content margin-top-5 margin-bottom-15">
                    <div class="title font-weight-600" style="font-size: 1.2em; color: green; padding: 5px;">{{$review->title}}</div>
                    <div class="content" style="color: #aaa;"><i class="icon-comment-1"></i>{{$review->content}}</div>
                </div>

                <!-- hinh anh -->
                <div class="row margin-bottom-15">
                    @if($review->recentImage())
                        @foreach($review->recentImage() as $img)
                            <div class="col-xs-1 col-md-1 gallery-item">
                                <a rel="fancybox-button-{{$review->id}}" title="{{$img->title}}" href="{{$img->guid}}"
                                   class="fancybox">
                                    <img alt="" src="{{$img->thumbnail}}" class="img-responsive avatar-pad2 ">
                                </a>
                            </div>
                        @endforeach
                    @endif
                    <div class="clearfix"></div>
                </div>

                <div class="comment-item margin-bottom-20">
                    @if($review->comments()->count())
                        @if($review->comments()->count()>4)
                            <a class="view-more btn btn-xs btn-warning " data-id="{{$review->id}}">Xem thêm thảo luận</a>
                        @endif
                        @foreach($review->comments()->orderBy("created_at","desc")->get()->reverse() as $key=>$comment)
                            <div class="media @if($key<$review->comments()->count()-4) hidden more-{{$review->id}} @endif">
                                <a class="media-left" href="{{$comment->author->url()}}">
                                    <img src="{{$comment->author->avatar}}" style="width:32px;height:32px;">
                                </a>

                                <div class="media-body">
                                    <a href="{{$comment->author->url()}}">{{$comment->author->display_name()}}:</a>
                                    {{$comment->content}}
                                    <p>
                                        <small class="pull-right">Vào lúc {{date_format($comment->created_at,"h:i:s d-m-Y")}}</small>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- thao luan,like,dislike,report end-->
            </div>
        </div>
    </div>
@stop

@section("scripts")
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $(".fancybox").fancybox({
                openEffect: 'none',
                closeEffect: 'none',
                maxHeight: '400px',
                helpers: {
                    thumbs: {}
                }
            });
            $(".view-more").on("click", function (e) {
                e.stopPropagation();
                $(".more-" + $(this).data("id")).toggleClass("hidden");
            });
        });
    </script>
@stop