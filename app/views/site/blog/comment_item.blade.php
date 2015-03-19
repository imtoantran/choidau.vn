<a class="media-left" href="{{$comment->author->url()}}">
    <img src="{{$comment->author->avatar}}" class="img-circle" style="width:32px;height:32px;">
</a>

<div class="media-body">
    <a href="{{$comment->author->url()}}">{{$comment->author->display_name()}}:</a>
    {{$comment->content}}
    <p>
        <a class="social-btn @if(Auth::check()&& $comment->isLiked()) true  @endif" data-action="like"
           data-id="{{$comment->id}}" data-controller="{{URL::to("post/social/$comment->id")}}">
            <span class="liked"><i class="icon-thumbs-down"></i><small>Đã thích</small></span>
            <span class="un-liked"><i class="icon-thumbs-up"></i><small>Thích</small></span>
            <small><span class="total-liked">@if($comment->totalLikes()) {{$comment->totalLikes()}} @endif</span>
            </small>
        </a>
        <small class="pull-right">{{$comment->date()}}</small>
    </p>
</div>