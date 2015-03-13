<div class="row">
    <section class="person-photo person-wrapper choidau-bg">
        <header class="blog-setting-header padding-5 margin-bottom-5 white">
            <div class="wrapper-header">
                <i class="blog-icon-bg icon-folder"></i>
                <i class="blog-icon-content icon-camera"></i>
                <span class="text-1em2">Album ảnh</span>
            </div>
        </header>

        <ul class="nav nav-tabs blog-tabs" data-tabs="tabs">
            <li>
                <a aria-expanded="false" href="#photo-tab-avatar" data-toggle="tab">Ảnh đại diện
                    <span class="badge circle tab-avatar">1</span>
                </a>
            </li>
            <li>
                <a aria-expanded="true" href="#photo-tab-location" data-toggle="tab">Ảnh địa điểm
                    <span class="badge circle tab-location">{{$location->images()->count()}}</span>
                </a>
            </li>
            <li>
                <a aria-expanded="true" href="#photo-tab-member" data-toggle="tab">Ảnh từ thành viên
                    <span class="badge circle tab-location">{{count($reviewsImages)}}</span>
                </a>
            </li>
        </ul>
        <div id="my-tab-content" style="padding: 10px 5px 10px 5px;" class="tab-content">
            <div class="tab-pane" id="photo-tab-avatar">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="thumbnail">
                            <a href="@if(File::exists(public_path().$location->avatar)){{$location->avatar}} @else /assets/global/img/no-image.png @endif"
                               class="fancybox" rel="location-avatar"
                               title="{{$location->name}}">
                                <img width="100%" class="media-object"
                                     src="@if(File::exists(public_path().$location->avatar)){{$location->avatar}} @else /assets/global/img/no-image.png @endif"
                                     alt="{{$location->name}}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="photo-tab-location">
                <div class="row">
                    @foreach($location->images()->get() as $image)
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <div class="thumbnail">
                                <a href="{{$image->guid}}" class="fancybox" rel="location-photo"
                                   title="{{$image->author->display_name()}} - đã đăng: {{$image->title}}">
                                    <img width="100%" class="media-object" src="{{$image->thumbnail}}"
                                         alt="{{$image->title}}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-pane active" id="photo-tab-member">
                <div class="row">
                    @foreach($location->reviews()->get() as $review)
                        @if(count($review->images()))
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <div class="thumbnail tooltips" data-original-title="{{$review->content}}">
                                    @foreach($review->images() as $image)
                                        <a href="{{$image->guid}}" class="fancybox"
                                           data-thumbnail = "{{$image->thumbnail}}"
                                           rel="reviews-photo-{{$review->id}}"
                                           title="{{$image->author->display_name()}} - đã đăng: {{$image->title}}">
                                            <img width="100%" class="media-object" src="{{$image->thumbnail}}"
                                                 alt="{{$image->title}}">
                                        </a>
                                    @endforeach
                                    <div class="text-center"><a
                                                href="{{$review->author->url()}}">{{$review->author->display_name()}}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>