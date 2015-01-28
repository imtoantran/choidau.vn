<div class="row person-content-item">
    <div class="col-md-12 col-none-padding">
        <div class="col-md-9 article-img-text col-none-padding">
            <img class="avatar-pad2" src="{{$userIn['avatar']}}" alt="">
            <div class="person-content-info">
                <div><a>{{$userIn['username']}}</a><span> - {{$userIn['level']}}</span></div>
                <span>đã check địa điểm này</span><br>
                <span>01/01/2014 - 05:15</span>
            </div>
        </div>
        <div class="col-md-3 col-none-padding text-right">
            <div class="btn-group person-type-scopy">
                <button type="button" class="btn btn-default btn-xs">Công khai</button>
                <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="icon-down-dir"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    @foreach($listStatusPost as $item)
                    <li value_id="{{$item['id']}}">{{$item['description']}}</li>
                    @endforeach



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
            <a href="#">Thích</a>
            <a href="#">Bình luận</a>
            <a href="#">Chia sẻ</a>
        </div>
    </div>

    <!-- comment - like - share -->
    <div class="row margin-none person-command">
        <div class="col-md-12 col-none-padding">
            <a href=""><i class="icon-thumbs-up-alt"></i></a>
            <span>12</span> người thích điều này
        </div>
        <div class="col-md-12 article-img-text col-none-padding">
            <div class="row margin-none">
                <img class="col-md-1 col-ms-1 avatar-pad2"
                     src="./img-data-demo/avatar-1.JPG" alt="">
                <input class="col-md-11 col-ms-11 col-xs-11" type="text"
                       placeholder="Viết bình luận...">
            </div>
        </div>
    </div>
</div>