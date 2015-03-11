<div id="slider1_container"
     style="position: relative; width:530px; height: 515px; background: #191919; overflow: hidden;">

    <!-- Loading Screen -->
    <header class="row header-location">
        <div class="col-md-10 ">
            <input type="hidden" i_l="{{$location->id}}" id="input-data-value-location"/>

            <h1>{{$location->name}} <i class="icon-ok-circled-2"></i> <i
                        class="icon-help-circled-1"></i>
            </h1>
            <ul class="list-unstyled list-inline ul-list-rating">
                <li><i class="icon-star-filled"></i></li>
                <li><i class="icon-star-filled"></i></li>
                <li><i class="icon-star-filled"></i></li>
                <li><i class="icon-star-1"></i></li>
                <li><i class="icon-star-1"></i></li>
            </ul>
        </div>
        <div class="col-md-2">
            <div class="g-plusone" data-size="medium"></div>
            <div class="fb-like" data-send="true" data-width="450" data-show-faces="true">
            </div>

        </div>
    </header>

    <!-- Slides Container -->
    <section u="slides" class="slider-location"
             style="cursor: move; position: relative; padding: 15px 15px 15px; top: 60px; width: 530px; height: 360px; overflow: hidden;">
        @foreach($location->images()->get() as $image)
            <div>
                <img u="image" class="img-item-slider img-responsive"
                     src="{{asset($image->guid)}}"/>
                <img u="thumb" src="{{asset($image->thumbnail)}}"/>
            </div>
        @endforeach
        @if(!$location->images()->count())
            <div class="rt">
                <img u="image" src="{{asset("assets/global/img/no-image.png")}}"/>
                <img u="thumb" src="{{asset("assets/global/img/no-image.png")}}"/>
            </div>
        @endif
    </section>

    <!-- Arrow Navigator Skin Begin -->

    <!-- Arrow Left -->
								<span u="arrowleft" class="jssora05l"
                                      style="width: 40px; height: 40px; top: 158px; left: 15px;">
								</span>
    <!-- Arrow Right -->
								<span u="arrowright" class="jssora05r"
                                      style="width: 40px; height: 40px; top: 158px; right: 15px">
								</span>

    <!-- Arrow Left -->
    <div style="position:absolute;text-transform:uppercase;font-weight: bold; height: 50px; bottom: 80px; left: 15px;">
        <button class="btn text-primary btn-xs do-post-review" @if(Auth::check()) data-toggle="modal"
                data-target="#reviewModal" @endif
        type="submit">Viết bình luận <i class="icon-edit"></i></button>
    </div>


    @if(Auth::check())
        <!-- Arrow Right -->
        <span style="position:absolute;text-transform:uppercase;font-weight: bold; height: 50px; bottom: 80px; right: 15px">
                    <button class="btn btn-xs text-primary do-upload-image" @if(Auth::check()) data-toggle="modal"
                            data-target="#uploadImageModal" @endif
                    type="button">Đăng hình <i class="icon-camera"></i></button>
                </span>
        <!-- Arrow Navigator Skin End -->

        @endif
                <!-- Thumbnail Navigator Skin Begin -->
        <div u="thumbnavigator" class="jssort01"
             style="position: absolute; height: 100px;right:0; left:0px; bottom: 0px;">
            <!-- Thumbnail Item Skin Begin -->

            <div u="slides" style="cursor: move;">
                <div u="prototype" class="p"
                     style="position: absolute; width: 72px; height: 72px; top: 0; left: 0;">
                    <div class=w>
                        <div u="thumbnailtemplate"
                             style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;">
                        </div>
                    </div>
                    <div class=c>
                    </div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- Thumbnail Navigator Skin End -->

</div>