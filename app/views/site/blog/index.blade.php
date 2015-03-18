@extends('site.layouts.right_sidebar')
@section('topa')
    <!-- bai viet noi bat -->
    @include("site.blog.featured")
    <!-- bai viet noi bat end -->
@stop
@section('sidebar')
    @include("site.layouts.sidebar")
@stop

{{-- Content --}}
@section('content')
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="row">
            <ul class="nav nav-tabs nav-justified blog-menu" role="tablist">
                <li @if($cat->slug == "an-uong-choi") class="active" @endif ><a href="{{URL::to('blog.html')}}">
                        ĂN-UỐNG-CHƠI</a></li>
                <li @if($cat->slug == "su-kien") class="active" @endif><a href="{{URL::to('blog/su-kien.html')}}">SỰ
                        KIỆN</a></li>
                <li @if($cat->slug == "kinh-nghiem") class="active" @endif><a
                            href="{{URL::to('blog/kinh-nghiem.html')}}">KINH NGHIỆM</a></li>
            </ul>

        </div>
        <div class="row">
            <div class="tab-content">
                {{--bai viet--}}
                <div class="tab-pane row fade active in">
                    @foreach ($posts as $post)
                        <div class="margin-bottom-10 item-blog ">
                            <div class="col-md-3 col-none-padding-left col-sm-3 margin-bottom-10 ">
                                <a href="{{{ $post->url() }}}" title="{{$post->title}}">
                                    <img class="img-responsive" src="@if(($post->getFeaturedImage())) {{$post->getFeaturedImage()->thumbnail260x180()}} @else http://placehold.it/260x180 @endif" alt="{{$post->title}}">
                                </a>
                            </div>
                            <div class="col-md-9 col-sm-9">
                                <p><strong><a href="{{{ $post->url() }}}">{{ String::title($post->title) }}</a></strong>
                                </p>

                                <p>
                                    {{ date_format($post->created_at,"d/m/Y - H:m:i") }}
                                    <i class = "icon-smile"></i>{{$post->totalView()}} lượt xem
                                    <i class = "icon-comment-empty"></i>{{$post->totalComment()}} thảo luận
                                    <i class = "icon-heart-empty"></i>{{$post->totalLikes()}} thích

                                </p>

                                <p class="margin-bottom-10">{{ String::tidy(Str::limit($post->excerpt(), 200)) }}</p>

                                <p><a class="more" href="{{$post->url()}}">Xem thêm<i class="icon-angle-right"></i></a></p>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                        </div>
                    @endforeach
                    {{ $posts->links() }}

                </div>
            </div>

        </div>
    </div>
@stop