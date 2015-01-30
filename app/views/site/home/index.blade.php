@extends('site.layouts.default')
@section('topa')
	<!-- BEGIN SLIDER -->
	<section class="page-slider margin-bottom-10">
		<div class="fullwidthbanner-container revolution-slider">
			<div class="fullwidthabnner">
				<ul id="revolutionul">
					<!-- THE NEW SLIDE -->
					<li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400" data-thumb="{{asset("assets/frontend/pages/img/revolutionslider/thumbs/thumb2.jpg")}}">
						<!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
						<img src="{{asset("assets/frontend/pages/img/revolutionslider/bg9.jpg")}}" alt="">

						<div class="caption lft slide_title_white slide_item_left"
							 data-x="30"
							 data-y="90"
							 data-speed="400"
							 data-start="1500"
							 data-easing="easeOutExpo">
							Explore the Power<br><span class="slide_title_white_bold">of Metronic</span>
						</div>
						<div class="caption lft slide_subtitle_white slide_item_left"
							 data-x="87"
							 data-y="245"
							 data-speed="400"
							 data-start="2000"
							 data-easing="easeOutExpo">
							This is what you were looking for
						</div>
						<a class="caption lft btn dark slide_btn slide_item_left" href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes"
						   data-x="187"
						   data-y="315"
						   data-speed="400"
						   data-start="3000"
						   data-easing="easeOutExpo">
							Purchase Now!
						</a>
						<div class="caption lfb"
							 data-x="640"
							 data-y="0"
							 data-speed="700"
							 data-start="1000"
							 data-easing="easeOutExpo">
							<img src="../../assets/frontend/pages/img/revolutionslider/lady.png" alt="Image 1">
						</div>
					</li>

					<!-- THE FIRST SLIDE -->
					<li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400" data-thumb="{{asset("assets/frontend/pages/img/revolutionslider/thumbs/thumb2.jpg")}}">
						<!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
						<img src="{{asset("assets/frontend/pages/img/revolutionslider/bg1.jpg")}}" alt="">

						<div class="caption lft slide_title slide_item_left"
							 data-x="30"
							 data-y="105"
							 data-speed="400"
							 data-start="1500"
							 data-easing="easeOutExpo">
							Need a website design?
						</div>
						<div class="caption lft slide_subtitle slide_item_left"
							 data-x="30"
							 data-y="180"
							 data-speed="400"
							 data-start="2000"
							 data-easing="easeOutExpo">
							This is what you were looking for
						</div>
						<div class="caption lft slide_desc slide_item_left"
							 data-x="30"
							 data-y="220"
							 data-speed="400"
							 data-start="2500"
							 data-easing="easeOutExpo">
							Lorem ipsum dolor sit amet, dolore eiusmod<br> quis tempor incididunt. Sed unde omnis iste.
						</div>
						<a class="caption lft btn green slide_btn slide_item_left" href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes"
						   data-x="30"
						   data-y="290"
						   data-speed="400"
						   data-start="3000"
						   data-easing="easeOutExpo">
							Purchase Now!
						</a>
						<div class="caption lfb"
							 data-x="640"
							 data-y="55"
							 data-speed="700"
							 data-start="1000"
							 data-easing="easeOutExpo">
							<img src="../../assets/frontend/pages/img/revolutionslider/man-winner.png" alt="Image 1">
						</div>
					</li>

					<!-- THE SECOND SLIDE -->
					<li data-transition="fade" data-slotamount="7" data-masterspeed="300" data-delay="9400" data-thumb="{{asset("assets/frontend/pages/img/revolutionslider/thumbs/thumb2.jpg")}}">
						<img src="{{asset("assets/frontend/pages/img/revolutionslider/bg2.jpg")}}" alt="">
						<div class="caption lfl slide_title slide_item_left"
							 data-x="30"
							 data-y="125"
							 data-speed="400"
							 data-start="3500"
							 data-easing="easeOutExpo">
							Powerfull &amp; Clean
						</div>
						<div class="caption lfl slide_subtitle slide_item_left"
							 data-x="30"
							 data-y="200"
							 data-speed="400"
							 data-start="4000"
							 data-easing="easeOutExpo">
							Responsive Admin &amp; Website Theme
						</div>
						<div class="caption lfl slide_desc slide_item_left"
							 data-x="30"
							 data-y="245"
							 data-speed="400"
							 data-start="4500"
							 data-easing="easeOutExpo">
							Lorem ipsum dolor sit amet, consectetuer elit sed diam<br> nonummy amet euismod dolore.
						</div>
						<div class="caption lfr slide_item_right"
							 data-x="635"
							 data-y="105"
							 data-speed="1200"
							 data-start="1500"
							 data-easing="easeOutBack">
							<img src="../../assets/frontend/pages/img/revolutionslider/mac.png" alt="Image 1">
						</div>
						<div class="caption lfr slide_item_right"
							 data-x="580"
							 data-y="245"
							 data-speed="1200"
							 data-start="2000"
							 data-easing="easeOutBack">
							<img src="../../assets/frontend/pages/img/revolutionslider/ipad.png" alt="Image 1">
						</div>
						<div class="caption lfr slide_item_right"
							 data-x="735"
							 data-y="290"
							 data-speed="1200"
							 data-start="2500"
							 data-easing="easeOutBack">
							<img src="../../assets/frontend/pages/img/revolutionslider/iphone.png" alt="Image 1">
						</div>
						<div class="caption lfr slide_item_right"
							 data-x="835"
							 data-y="230"
							 data-speed="1200"
							 data-start="3000"
							 data-easing="easeOutBack">
							<img src="../../assets/frontend/pages/img/revolutionslider/macbook.png" alt="Image 1">
						</div>
						<div class="caption lft slide_item_right"
							 data-x="865"
							 data-y="45"
							 data-speed="500"
							 data-start="5000"
							 data-easing="easeOutBack">
							<img src="../../assets/frontend/pages/img/revolutionslider/hint1-red.png" id="rev-hint1" alt="Image 1">
						</div>
						<div class="caption lfb slide_item_right"
							 data-x="355"
							 data-y="355"
							 data-speed="500"
							 data-start="5500"
							 data-easing="easeOutBack">
							<img src="../../assets/frontend/pages/img/revolutionslider/hint2-red.png" id="rev-hint2" alt="Image 1">
						</div>
					</li>

					<!-- THE THIRD SLIDE -->
					<li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400" data-thumb="{{asset("assets/frontend/pages/img/revolutionslider/thumbs/thumb2.jpg")}}">
						<img src="{{asset("assets/frontend/pages/img/revolutionslider/bg3.jpg")}}" alt="">
						<div class="caption lfl slide_item_left"
							 data-x="30"
							 data-y="95"
							 data-speed="400"
							 data-start="1500"
							 data-easing="easeOutBack">
							<iframe src="http://player.vimeo.com/video/56974716?portrait=0" width="420" height="240" style="border:0" allowFullScreen></iframe>
						</div>
						<div class="caption lfr slide_title"
							 data-x="470"
							 data-y="100"
							 data-speed="400"
							 data-start="2000"
							 data-easing="easeOutExpo">
							Responsive Video Support
						</div>
						<div class="caption lfr slide_subtitle"
							 data-x="470"
							 data-y="170"
							 data-speed="400"
							 data-start="2500"
							 data-easing="easeOutExpo">
							Youtube, Vimeo and others.
						</div>
						<div class="caption lfr slide_desc"
							 data-x="470"
							 data-y="220"
							 data-speed="400"
							 data-start="3000"
							 data-easing="easeOutExpo">
							Lorem ipsum dolor sit amet, consectetuer elit sed diam<br> nonummy amet euismod dolore.
						</div>
						<a class="caption lfr btn yellow slide_btn" href=""
						   data-x="470"
						   data-y="280"
						   data-speed="400"
						   data-start="3500"
						   data-easing="easeOutExpo">
							Watch more Videos!
						</a>
					</li>

					<!-- THE FORTH SLIDE -->
					<li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400" data-thumb="{{asset("assets/frontend/pages/img/revolutionslider/thumbs/thumb2.jpg")}}">
						<!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
						<img src="{{asset("assets/frontend/pages/img/revolutionslider/bg4.jpg")}}" alt="">
						<div class="caption lft slide_title"
							 data-x="30"
							 data-y="105"
							 data-speed="400"
							 data-start="1500"
							 data-easing="easeOutExpo">
							What else included ?
						</div>
						<div class="caption lft slide_subtitle"
							 data-x="30"
							 data-y="180"
							 data-speed="400"
							 data-start="2000"
							 data-easing="easeOutExpo">
							The Most Complete Admin Theme
						</div>
						<div class="caption lft slide_desc"
							 data-x="30"
							 data-y="225"
							 data-speed="400"
							 data-start="2500"
							 data-easing="easeOutExpo">
							Lorem ipsum dolor sit amet, consectetuer elit sed diam<br> nonummy amet euismod dolore.
						</div>
						<a class="caption lft slide_btn btn red slide_item_left" href="http://www.keenthemes.com/preview/index.php?theme=metronic_admin" target="_blank"
						   data-x="30"
						   data-y="300"
						   data-speed="400"
						   data-start="3000"
						   data-easing="easeOutExpo">
							Learn More!
						</a>
						<div class="caption lft start"
							 data-x="670"
							 data-y="55"
							 data-speed="400"
							 data-start="2000"
							 data-easing="easeOutBack"  >
							<img src="../../assets/frontend/pages/img/revolutionslider/iphone_left.png" alt="Image 2">
						</div>

						<div class="caption lft start"
							 data-x="850"
							 data-y="55"
							 data-speed="400"
							 data-start="2400"
							 data-easing="easeOutBack"  >
							<img src="../../assets/frontend/pages/img/revolutionslider/iphone_right.png" alt="Image 3">
						</div>
					</li>
				</ul>
				<div class="tp-bannertimer tp-bottom"></div>
			</div>
		</div>
	</section>
	<!-- END SLIDER -->
@stop

@section('topb')
	<section class="row margin-bottom-10">
	<section class="col-md-3 col-xs-12 col-sm-6 box-post-hot">
		<header>
			<h1>TOP REVIEW</h1>
		</header>
		<article>
			<img src="img-data-demo/avatar-1.jpg" height="100px" width="100px" />
			<div class="col-none-padding">
				<h1>Beer tô 08- Nguyễn Trãi, Q 10</h1>
				<h2>meomatxi</h2><span>bình luận</span>
				<time> cách đây 20 giờ</time>

			</div>
			<div class="clearfix"></div>
			<header>
				<h2> Món ăn ngon, phục vụ tốt !!!</h2>
							  <span>
								Quán nằm ở vị trí đẹp , rất yên tĩnh, Phong cách phục vụ chuyên nghiệp với thực đơn phong phú, nhiều món ăn lại miệng.
							  </span>
				<p><a href="#">xem thêm</a></p>
			</header>


		</article>

	</section>
	<section class="col-md-3 col-xs-12 col-sm-6 box-post-hot">
		<header>
			<h1>TOP REVIEW</h1>
		</header>
		<article>
			<img src="img-data-demo/avatar-1.jpg" height="100px" width="100px" />
			<div class="col-none-padding">
				<h1>Beer tô 08- Nguyễn Trãi, Q 10</h1>
				<h2>meomatxi</h2><span>bình luận</span>
				<time> cách đây 20 giờ</time>

			</div>
			<div class="clearfix"></div>
			<header>
				<h2> Món ăn ngon, phục vụ tốt !!!</h2>
							  <span>
								Quán nằm ở vị trí đẹp , rất yên tĩnh, Phong cách phục vụ chuyên nghiệp với thực đơn phong phú, nhiều món ăn lại miệng.
							  </span>
				<p><a href="#">xem thêm</a></p>
			</header>


		</article>

	</section>
	<section class="col-md-3 col-xs-12 col-sm-6 box-post-hot">
		<header>
			<h1>TOP REVIEW</h1>
		</header>
		<article>
			<img src="img-data-demo/avatar-1.jpg" height="100px" width="100px" />
			<div class="col-none-padding">
				<h1>Beer tô 08- Nguyễn Trãi, Q 10</h1>
				<h2>meomatxi</h2><span>bình luận</span>
				<time> cách đây 20 giờ</time>

			</div>
			<div class="clearfix"></div>
			<header>
				<h2> Món ăn ngon, phục vụ tốt !!!</h2>
							  <span>
								Quán nằm ở vị trí đẹp , rất yên tĩnh, Phong cách phục vụ chuyên nghiệp với thực đơn phong phú, nhiều món ăn lại miệng.
							  </span>
				<p><a href="#">xem thêm</a></p>
			</header>


		</article>

	</section>
	<section class="col-md-3 col-xs-12 col-sm-6  box-face-hot">
		<header>
			<h1>Choidau.net <i class="icon-facebook-squared"></i></h1>
		</header>
		<article class="col-md-12">
			<div class="fb-like-box" data-href="https://www.facebook.com/FacebookDevelopers" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>

		</article>

	</section>
	</section>
@stop

@section('scripts')
	<!-- BEGIN RevolutionSlider -->
	<script src="{{asset("assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js")}}" type="text/javascript"></script>
	<script src="{{asset("assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js")}}" type="text/javascript"></script>
	<script src="{{asset("assets/frontend/pages/scripts/revo-slider-init.js")}}" type="text/javascript"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			RevosliderInit.initRevoSlider();
		});
	</script>
	<!-- END RevolutionSlider -->
@stop

@section('styles')
	<link href="{{asset("assets/global/plugins/slider-revolution-slider/rs-plugin/css/settings.css")}}" rel="stylesheet">
@stop

	{{-- Content --}}
@section('content')
	<div class="margin-bottom-10">
		<img src="">
	</div>
	<div class="margin-bottom-10">
		<div class="row quote-v1">
			<div class="col-md-9">
				<span>Ăn gì ngon ?</span>
			</div>
			<div class="col-md-3 text-right">
			</div>
		</div>	
	</div>
	<div class="col-md-12 margin-bottom-10 col-no-padding">
		@foreach($locations as $location)
			<?php
			$reviews = null;
			$review = null;
			if($hasReview = $location->reviews()->count()){
				$reviews = $location->reviews()->orderBy("created_at","desc");
				$review = $reviews->first();
			}
			?>
			<div class="col-md-4 col-xs-12 col-sm-6  col-no-padding-left">
				<div class="box-product-img-content">
					<img src="{{asset("$location->thumbnail")}}" width="317px" height="180px" />
					<h1>{{$location->name}}</h1>
					<span></span>
					<h2>{{String::tidy(Str::limit($location->description, 100))}}</h2>
				</div>
				<div class="row box-product-comment">
					<div class=" col-md-8 pull-left" style="">
						<img  class="img-circle" src="@if($hasReview) {{$review->author->avatar}} @else anonimous @endif"/>
						<h5> @if($hasReview) {{$review->author->username}} @else anonimous @endif</h5>
						<p>Vừa đánh giá địa điểm</p>

					</div>
					<div class="col-md-4 " style="padding-top:11px">
						@if($hasReview) {{date_format($review->created_at,"d-m-Y")}} @endif <i class="icon-clock-6"></i>
					</div>
				</div>

				<div class="row box-product-like">
					<div class="col-md-8 col-xs-8 col-sm-8 pull-left">
						@if($hasReview)
							@foreach($reviews->get() as $reviewer)
								<img  class="img-circle" src="{{asset($reviewer->author->avatar)}}"/>
							@endforeach
						@endif
						<p class="quantity-like">{{$location->userAction()->where("user_location_type","=","0")->count()}} lượt thích</p>
					</div >

					<div class="col-md-4 col-xs-4 col-sm-4 ">
						<i class="icon-comment-empty icon-comment">
							<p class="quantity-comment">
								@if($hasReview)
									{{$reviews->count()}}
								@else
									0
								@endif
							</p>
						</i>

					</div>
				</div>
			</div>
			@endforeach
	</div>

@stop
