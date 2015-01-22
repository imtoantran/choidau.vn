@extends('site.layouts.right_sidebar')
@section('topa')
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		top a here
	</div>
@stop
@section('sidebar')
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		sidebar here
	</div>
@stop

{{-- Content --}}
@section('content')
	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
		<div class="row">
			<ul class="nav nav-tabs nav-justified" role="tablist">
				<li class="active"><a href="{{URL::to('bai-viet.html')}}"> ĂN-UỐNG-CHƠI</a></li>
				<li class=""><a href="{{URL::to('bai-viet/su-kien.html')}}">SỰ KIỆN</a></li>
				<li class=""><a href="{{URL::to('bai-viet/kinh-nghiem.html')}}">KINH NGHIỆM</a></li>
			</ul>

		</div>
<div class="row">
	<div class="tab-content">
		{{--bai viet--}}
		<div class="tab-pane row fade active in">
			@foreach ($posts as $post)
			<div class="margin-bottom-10 item-blog ">
				<div class="col-md-3 col-none-padding-left col-sm-3 margin-bottom-10 ">
					<a href="{{{ $post->url() }}}" class="fancybox-button" title="Image Title" data-rel="fancybox-button thumbnail">
						<img class="img-responsive" src="http://placehold.it/260x180" alt="">
					</a>
				</div>
				<div class="col-md-9 col-sm-9">
					<p><strong><a href="{{{ $post->url() }}}">{{ String::title($post->title) }}</a></strong></p>
					<p>{{{ $post->date() }}} <span class="glyphicon glyphicon-comment"></span> <a href="{{{ $post->url() }}}#comments">{{$post->comments()->count()}} {{ \Illuminate\Support\Pluralizer::plural('Comment', $post->comments()->count()) }}</a></p>
					<p class="margin-bottom-10">{{ String::tidy(Str::limit($post->content, 200)) }}</p>
					<p><a class="more" href="#">Read more <i class="icon-angle-right"></i></a></p>
				</div>
				<div class="clearfix"></div>
			</div>
			@endforeach
			{{ $posts->links() }}

		</div>
	</div>

</div>
	</div>
@stop
