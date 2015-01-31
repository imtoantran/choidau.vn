<div class="list-blog-post-comment">
@foreach($listCommentPost as $item)
<div class="col-md-12 article-img-text lab-blog-post-item-comment col-none-padding" i_user="{{ $item['id_user']}}" i_comment="{{  $item['id_comment']}}">
    <div class="row margin-none">
        <img class="col-md-1 col-ms-1 avatar-pad2" src="{{$item['avatar_user']}}" alt="">
        <a style="font-size: 16px" class="lab-blog-post-content-comment" >{{$item['username']}}</a>   {{$item['updated_at_2']}}
        <span class="col-md-11 col-ms-11 col-xs-11 txt-blog-post-comment" value="" >{{$item['content']}}</span>
    </div>
    <div class="btn-blog-post-comment-delete"><i class="icon-pencil-3"></i></div>
</div>
@endforeach
</div>