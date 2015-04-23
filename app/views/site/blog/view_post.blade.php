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
    {{--@include("site.blog.featured")--}}
    <!-- bai viet noi bat end -->
@stop
{{-- Content --}}
@section('content')
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 blog-post">
        <div class="page-header">
            <h1>{{ $post->title }}</h1>

            <div class="entry-meta">
                    <span class="posted-on">
                        <i class="icon icon-calendar"></i>
                        <a href="{{$post->url()}}" rel="bookmark">
                            <time class="entry-date published" datetime="{{$post->date()}}">{{$post->date()}}</time>
                        </a>
                    </span>
                    <span class="byline">
                        <i class="icon icon-user"></i>
                        <span class="author vcard">
                            <a class="url fn n" href="{{$post->author->url()}}">{{$post->author->username}}</a>
                        </span>
                    </span>
                    <span class="cat-links">
                        <i class="icon icon-folder-open"></i>
					    <a href="{{$post->categoryUrl()}}" rel="category tag">{{$post->category->name}}</a>
                    </span>
            </div>
        </div>
        <div>{{$post->content()}}</div>
        <hr>
        <div>
            <div>
                @if($post->isLiked())
                    <button class="btn btn-xs like-action" likeable="false" data-id="{{$post->id}}">Bỏ thích
                    </button>
                @else
                    <button class="btn btn-xs btn-primary like-action" likeable="true" data-id="{{$post->id}}">
                        Thích
                    </button>
                @endif
                @if(Auth::check())
                    <button class="btn btn-xs">Thảo luận</button>
                    <small class="comment-counter">{{ $comments->count() }}</small>
                    <small>bình luận.</small>
                @endif
            </div>
        </div>
        <hr>

        <div id="comments">

            <div class="comment-item">
                @if($comments->count())
                    @if($comments->count()>4)
                        <a class="view-more" data-id="{{$post->id}}">Xem thêm thảo luận</a>
                    @endif
                    @include("site.blog.comment")
                @endif
                {{--comment form--}}
                @if(Auth::check())
                        <textarea name="content" class="form-control comment-btn" rows="1" data-id="{{$post->id}}"></textarea>
                @else
                    Hãy đăng nhập để viết bình luận.
                @endif
                {{--comment form--}}
            </div>

        </div>
    </div>
@stop

@section("scripts")
    @if(Auth::check())
        <script>
            $(document).ready(function () {
                $("#comment_box").keydown(function (e) {
                    if (e.which == 13) {
                        var content = $(this).val();
                        $(this).val("");
                        $.ajax({
                            url: "{{URL::to("blog/comment/")}}",
                            data: {content: content, id: "{{$post->id}}"},
                            dataType: "json",
                            type: "post",
                            success: function (data) {
                                if (data.success) {
                                    var newComment = $("#hiddenComment").clone().removeAttr('id');
                                    newComment.find("time").text(data.date);
                                    newComment.find("img").attr("src", data.avatar);
                                    newComment.find(".content").text(data.content);
                                    newComment.find(".username").text(data.username);
                                    newComment.find(".user-url").attr("href", "{{Auth::user()->url()}}");
                                    $("#comments").append(newComment);
                                    newComment.fadeIn();
                                    count = parseInt($(".comment-counter").text(), 10) + 1;
                                    $(".comment-counter").text(count);
                                }
                            },
                            complete: function () {
                            }
                        });
                        return false;
                    }
                });
                $(".comment-item").social();
                $("#comments").on("click", ".btn-post-comment", function () {
                    txt = $("#review textarea[data-id=" + $(this).data("id") + "]").focus();
                });
                $("#comments").on("click", ".view-more", function (e) {
                    e.stopPropagation();
                    $(".more-" + $(this).data("id")).toggleClass("hidden");
                });
                $("#comments textarea").ag();
                $("#comments").on("keydown", "textarea", function (e) {
                    @if(Auth::check())
                    var _t = this;
                    if (e.which == 13) {
                        _t.disabled = true;
                        $.ajax({
                            url: "{{URL::to('blog/comments')}}/" + $(this).data("id"),
                            data: {content: $(this).val()},
                            type: "post",
                            dataType: "json",
                            success: function (data) {
                                if (data.success) {
                                    _t.value = "";
                                    _t.disabled = false;
                                    $(_t).before("<div class='media'>" + data.content + "</div>");
                                    $(".comment-counter").text(data.totalComments);
                                }
                            },
                            complete: function () {
                                _t.disabled = false;
                            }
                        })
                        return false;
                    }
                    @else
                        this.value = "";
                    @endif

                });
            });
        </script>
    @endif
@stop