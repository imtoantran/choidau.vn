<!-- bai viet noi bat -->
<div class="row">
    @if($blogs->count())
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2 class="margin-bottom-0 margin-top-10 text-primary"><i class="icon-tag"></i> Bài viết nổi bật</h2>
        </div>
        @foreach($blogs as $blog)
            <div class="col-xs-12 col-sm-6 col-lg-3 gallery-item">
                <a data-rel="fancybox-button" title="Project Name" href="{{$blog->url()}}" class="fancybox-button">
                    <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                    <div class="zoomix"><i class="icon-cancel-circled2"></i></div>
                </a>
                <a href="{{$blog->url()}}"><strong>{{$blog->title}}</strong></a>
                <p>{{String::tidy(Str::limit($blog->content,50))}}</p>
            </div>
        @endforeach
    @endif
</div>
<!-- bai viet noi bat end -->