@extends('site.layouts.right_sidebar')

{{-- Web site Title --}}
@section('title')
    {{{ String::title($post->title) }}} ::
    @parent
@stop

{{-- Update the Meta Title --}}
@section('meta_title')
    @parent

@stop

{{-- Update the Meta Description --}}
@section('meta_description')
    <meta name="description" content="{{{ $post->meta_description() }}}"/>

@stop

{{-- Update the Meta Keywords --}}
@section('meta_keywords')
    <meta name="keywords" content="{{{ $post->meta_keywords() }}}"/>

@stop

@section('sidebar')
    @include("site.layouts.sidebar")
@stop

@section('meta_author')
    <meta name="author" content="{{{ $post->author->username }}}"/>
@stop
@section('topa')
    <!-- bai viet noi bat -->
    @include("site.blog.featured")
    <!-- bai viet noi bat end -->
@stop
{{-- Content --}}
@section('content')
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
<div class="row">
        <h3>{{ $post->title }}</h3>

        <p>{{ $post->content() }}</p>

        <div>
            <div>
                @if($post->isLiked())
                    <button class="btn btn-xs like-action" likeable="false" data-id="{{$post->id}}">Bỏ thích</button>
                @else
                    <button class="btn btn-xs btn-primary like-action" likeable="true" data-id="{{$post->id}}">Thích</button>
                @endif
                @if(Auth::check())
                        <button class="btn btn-xs">Thảo luận</button>
@endif
            </div>
            <div class="like-item">
                @if($post->totalLiked())
                    @if($post->isLiked())
                        <span class="me">Bạn</span>
                    @endif
                    @if($post->recentLiked()->count())
                        @foreach($post->recentLiked()->get() as $user)
                            <span> {{$user->meta_value}}</span>
                        @endforeach
                    @endif
                    <span> thích mục này</span>
                @else
                @endif
            </div>

        </div>

        <hr/>

        <div id="comments">
            <h4>{{ $comments->count() }} {{ \Illuminate\Support\Pluralizer::plural('Bình luận', $comments->count()) }}</h4>

            <div class="col-xs-12" style="display: none" id="hiddenComment">
                <div class="col-md-1">
                    <div class="row"><img class="thumbnail" src="http://placehold.it/60x60" alt="" width="70"
                                          height="70"></div>
                </div>
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="muted username">username</span>
                            &bull;
                            <time></time>
                        </div>

                        <div class="col-md-12 content">

                        </div>
                    </div>
                </div>
                <hr/>
            </div>

            @if ($comments->count())
                @foreach ($comments as $comment)
                    <div class="col-xs-12">
                        <div class="col-md-1">
                            <div class="row">
                                <img class="thumbnail" src="{{$comment->author->avatar}}" alt="" width="70" height="70">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{$comment->author->url()}}"><strong>{{{ $comment->author->username }}}</strong></a>
                                    &bull;
                                    {{{ $comment->date() }}}
                                </div>

                                <div class="col-md-12">
                                    {{ $comment->content() }}
                                </div>
                            </div>
                        </div>
                        <hr/>
                    </div>
                @endforeach
            @else
            @endif
        </div>
        {{--comment form--}}
        @if(Auth::check())
            <div class="col-xs-12">
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="thumbnail" src="http://placehold.it/60x60" alt="">
                    </a>

                    <div class="media-body">
                        <div class="form-group">
                            <textarea style="resize: none;overflow: hidden;" rows="3" name="name" id="comment_box"
                                      class="form-control" value="" title="" required="required"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        @else
            Hãy đăng nhập để viết bình luận.
        @endif
        {{--comment form--}}

</div>
    </div>
@stop

@section("scripts")
    @if(Auth::check())
        <script>
            $(document).ready(function () {
                $("#comment_box").keydown(function (e) {
                    if (e.which == 13) {
                        var el = $(this);
                        $.ajax({
                            url: "{{URL::to("blog/comment/")}}",
                            data: {content: $(this).val(), id: "{{$post->id}}"},
                            dataType: "json",
                            type: "post",
                            success: function (data) {
                                if (data.success) {
                                    var newComment = $("#hiddenComment").clone().removeAttr('id');
                                    newComment.find("time").text(data.date);
                                    newComment.find("img").attr("src", data.avatar);
                                    newComment.find(".content").text(data.content);
                                    newComment.find(".username").text(data.username);
                                    $("#comments").append(newComment);
                                    newComment.fadeIn();
                                }
                            }
                        });
                        return false;
                    }
                });
            })
            /* like */
            var likeUrl = "{{URL::to("blog/like")}}";
            var unLikeUrl = "{{URL::to("blog/unlike")}}";
            var loading = $("<i/>", {class: "animate-spin icon-spin3"});
            $(".like-action").click(function () {
                var element = $(this);
                element.attr("disabled", true);
                var likeable = true;
                var text = "Thích";
                var url = unLikeUrl;
                if (element.attr("likeable") == 'true') {
                    url = likeUrl;
                    likeable = false;
                    text = "Bỏ thích";
                }
                element.prepend(loading);
                $.ajax({
                    url: url,
                    data: {id: $(this).attr("data-id")},
                    dataType: "json",
                    type: "post",
                    success: function () {
                        element.attr("likeable", likeable);
                        element.text(text);
                    },
                    complete: function () {
                        loading.remove();
                        element.attr("disabled", false);
                    }
                })
            });
            /* like */
        </script>
    @endif
@stop