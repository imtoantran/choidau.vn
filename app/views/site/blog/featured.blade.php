<!-- bai viet noi bat -->
<div class="row">
    @if($blogs->count())
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 margin-bottom-5">
            <h2 class="margin-bottom-0 margin-top-10 text-primary"><i class="icon-tag"></i> Bài viết nổi bật</h2>
        </div>
        @foreach($blogs as $blog)
            <div class="col-xs-12 col-sm-6 col-lg-3 gallery-item" style="position: relative">
                <a data-rel="fancybox-button" title="Project Name" href="{{$blog->url()}}" class="fancybox-button">
                    <img alt="" src="../../assets/frontend/pages/img/works/img1.jpg" class="img-responsive">
                    <div class="zoomix"><i class="icon-cancel-circled2"></i></div>
                </a>
                <a href="{{$blog->url()}}"><strong>{{$blog->title}}</strong></a>
                <p class="text-justify">
                    {{String::tidy(Str::limit($blog->content,65))}}
                    <a class="font-italic font-weight-600 font-12px" style="position: absolute;bottom: 10px;right:20px;" href="#">xem thêm</a>
                </p>
            </div>
        @endforeach
    @endif
</div>
<!-- bai viet noi bat end -->