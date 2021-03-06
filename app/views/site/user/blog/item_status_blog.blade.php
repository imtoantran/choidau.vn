<div class="row person-content-item">
    <input type="hidden" class="item-status-value" user_auth_id="@if(isset($userAuth['id'])) {{$userAuth['id']}} @endif" user_author_id="{{ $userAuthor['id']}}" post_id="{{$postIn['id']}}"/>
    <div class="col-md-12 col-none-padding">
        <div class="col-md-9 article-img-text col-none-padding">
            <img class="avatar-pad2" src="{{$userAuthor['avatar']}}" alt="">
            <div class="person-content-info">
                <div><a>{{ $userAuthor['username']}}</a><span> - {{$userAuthor['level']}}</span></div>
                <span> {{$postIn['post_type_user']}}</span><br>
                <span>{{$postIn['post_date']}}</span>
            </div>
        </div>
        <div class="col-md-3 col-none-padding text-right">
            <div class="btn-group person-type-scopy">

                <button type="button" id="privacy-status" value_id="{{$postIn['privacy_id']}}" class="btn btn-default btn-xs">{{$postIn['privacy_description']}}</button>
                <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="icon-down-dir"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    @foreach($listStatusPost as $item)
                    <li value_id="{{$item['id']}}">{{$item['description']}}</li>
                    @endforeach
                    <li class="btn-blog-post-status-delete">Xoá</li>


                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-none-padding person-content-article">
        <div class="row margin-none">
            <section class="article-img-text clearfix content-article-wrapper">
                <div class="text-algin-img">
                    <article>
                        {{$postIn['content']}}
                    </article>
                </div>
            </section>
        </div>
    </div>
    <!-- comment - like - share -->
    <div class="row margin-none">
        <div class="person-text-assoc">
            <a class="btn-blog-post-like" @if(isset($userAuth['type_action_like']))type_action_like="{{$userAuth['type_action_like']}}" @else type_action_like="type_action_like" @endif">@if(isset($userAuth['like_content'])){{$userAuth['like_content']}} @else Thích @endif</a>
            <a class="btn-blog-post-comment">Bình luận(<span class="lab-blog-post-number-comment">{{ $postIn['number_comment']}}</span>)</a>
            <a class="btn-blog-post-share">Chia sẻ</a>
        </div>
    </div>

    <!-- comment - like - share -->
    <div class="row margin-none person-command">
        <div class="col-md-12 col-none-padding">
            <a href=""><i class="icon-thumbs-up-alt"></i></a>
            <span class="lab-blog-post-like"> {{$postIn['number_like']}}</span> người thích điều này
        </div>
        {{$postIn['comment']}}
        @if(isset($userAuth['avatar']))
        <div class="col-md-12 article-img-text col-none-padding">
            <div class="row margin-none">
                <img class="col-md-1 col-ms-1 col-xs-1 avatar-pad2"

                     src=" {{ $userAuth['avatar']}}" alt="">
                <input  class="col-md-11 col-ms-11 col-xs-11 txt-blog-post-comment" type="text"
                       placeholder="Viết bình luận...">
            </div>
        </div>
        @endif

    </div>
</div>