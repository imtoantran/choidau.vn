<article class="person-location-item col-md-12 col-sm-12 col-xs-12">
    <div class="media row margin-none">
        <div class="col-md-3 col-sm-4 col-xs-6 col-none-padding padding-right-5" style="padding-right: 3px;">
            <a href="#" class="pull-left">
                <img src="{{$location->avatar}}" alt="" class="media-object img-responsive">
            </a>
        </div>
        <div class="col-xs-6"></div>
        <div class="col-md-9 col-sm-8 col-xs-12 col-none-padding">
            <div class="row margin-none">
                <div class="col-md-9 col-none-padding">
                    <header><a href="#" class="media-heading text-1em2 text-left">{{$location->name}}</a></header>
                </div>
                <div class="col-md-3 text-right col-none-padding">

                    {{--*/ $rCount = $location->rating() /*--}}
                    @for($i=0;$i<5;$i++)
                    @if($i<$rCount)
                    <i class="icon-star choidau-font"></i>
                    @else
                    <i class="icon-star-empty choidau-font"></i>
                    @endif
                    @endfor

                </div>
            </div>
            <p>{{$location->address_detail}}</p>
            <p class="text-justify margin-none">
                {{$location->description}}
            </p>
            <p class="text-right margin-none text-weight600"><a href="{{$location->url()}}">&gt;&gt;&gt; xem thêm</a></p>
        </div>
    </div>
</article>