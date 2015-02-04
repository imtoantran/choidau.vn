@extends('site.layouts.default')
@section("content")
    <p class="title">
        <a href="#"><strong class="text-primary">{{$categoryTitle}}</strong></a>
    </p>
    <div class="col-md-12 margin-bottom-10 col-no-padding">
        @foreach($locations as $location)
            <?php
            $reviews = null;
            $review = null;
            if($hasReview = $location->reviews()->count()){
                $reviews = $location->reviews()->orderBy("created_at","desc");
                $review = $reviews->first();
            }
            ?>
            <div class="col-md-4 col-xs-12 col-sm-6  col-no-padding-left">
                <a href="{{$location->url()}}">
                    <div class="box-product-img-content">
                        <img src="{{asset("$location->avatar")}}" width="317px" height="180px" />
                        <div class="location-description">
                            <p><strong class="title">{{$location->name}}</strong></p>
                            <small>{{$location->address_detail}}</small>
                        </div>
                        <div class="review-rating">
                            <ul class="list-unstyled list-inline ul-list-rating">
                                {{--*/ $rCount = $location->rating() /*--}}
                                @for($i=0;$i<5;$i++)
                                    @if($i<$rCount)
                                        <li><i class="icon-star-filled"></i></li>
                                    @else
                                        <li><i class="icon-star-1"></i></li>
                                    @endif
                                @endfor
                            </ul>
                        </div>
                        <div class="absolute-top-right bg-primary">
                            <span href="#" class="like-action @if(Auth::check()&&$location->isLiked(Auth::user()->id)) active @endif " data-id="{{$location->id}}"><i class="icon-heart"></i></span>
                            <i class="icon-export"></i>
                        </div>
                    </div>
                </a>
                <p>{{String::tidy(Str::limit($location->description, 100))}}</p>
                <div class="row box-product-comment">
                    <div class="col-md-8">
                        <div class="row">
                            <img  class="img-circle" src="@if($hasReview) {{asset($review->author->avatar)}} @else {{asset("assets/global/img/no-image.png")}} @endif"/>
                            @if($hasReview)
                                <a href="{{URL::to($review->author->url())}}">
                                    {{$review->author->username}}
                                </a>
                                <p>Vừa đánh giá địa điểm</p>
                            @else
                                Chưa có bình luận nào.
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="row">
                            @if($hasReview) <span>{{date_format($review->created_at,"d-m-Y")}}</span> <i class="icon-clock-6"></i> @endif
                        </div>
                    </div>
                </div>

                <div class="row box-product-like">
                    <div class="col-md-10 col-xs-10 col-sm-10">
                        <div class="row">
                            @if($location->whoLiked()->count())
                                @foreach($location->whoLiked()->get() as $userLiked)
                                    <img  class="img-circle" src="{{asset($userLiked->avatar)}}"/>
                                @endforeach
                            @endif
                            <p class="quantity-like">{{$location->userAction()->whereAction_type("like")->count()}} lượt thích</p>

                        </div>
                    </div >

                    <div class="col-md-2 col-xs-2 col-sm-2 ">
                        <div class="row">
                            <i class="icon-comment-empty icon-comment">
                                <p class="quantity-comment">
                                    @if($hasReview)
                                        {{$reviews->count()}}
                                    @else
                                        0
                                    @endif
                                </p>
                            </i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="paging">{{$locations->links()}}</div>
@stop