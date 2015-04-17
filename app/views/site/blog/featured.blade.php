<!-- bai viet noi bat -->
<div class="row">
    @if($blogs->count())
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 margin-bottom-5">
            <h2 class="margin-bottom-0 margin-top-10 text-primary"><i class="icon-tag"></i> Bài viết nổi bật</h2>
        </div>
        @foreach($blogs as $blog)
            <div class="col-xs-12 col-sm-6 col-lg-3 gallery-item" style="position: relative">
                <a data-rel="fancybox-button" title="Project Name" href="{{$blog->url()}}" class="fancybox-button">
                    @if(isset($blog->avatar) && !empty($blog->avatar))
                        <img alt="" src="{{$blog->avatar}}" class="img-responsive" style="width: 100%">
                    @else
                        <img alt="" src="{{URL::to('assets/global/img/no-image.png')}}" class="img-responsive">
                    @endif
                </a>
                <a href="{{$blog->url()}}"><strong>{{$blog->title}}</strong></a>
                <div class="text-justify">
                    @if( strlen(strip_tags($blog->content)) > 100)
                    <span>{{Str::limit(strip_tags($blog->content),99)}}</span>
                    <a href="{{$blog->url()}}" class="font-italic font-weight-600 font-12px">
                        xem thêm
                    </a>
                    @else
                        <span>{{strip_tags($blog->content)}}</span>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
<!-- bai viet noi bat end -->