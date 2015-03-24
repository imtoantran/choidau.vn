<meta charset="utf-8">
<title>
{{--   @if (isset($default_page_title)) {{$default_page_title}} @elseif(isset($page_title))  {{$page_title}} @endif--}}

</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

@section('meta_tag')
<meta name="keywords" content="@if (isset($default_keyword)) {{$default_keyword}} @endif " />
<meta name="author" content="choidau.net" />
<meta name="description" content="@if (isset($default_description)){{$default_description}} @endif " />
@show



<!-- Mobile Specific Metas
================================================= -->

<link rel="shortcut icon" href="favicon.ico">

<!-- Fonts START -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=all" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"><!--- fonts for slider on the index page -->
<!-- Fonts END -->

<!-- Global styles START -->
<link rel="stylesheet" href="{{asset('assets/global/plugins/fontello/css/fontello.css')}}">
<link rel="stylesheet" href="{{asset('assets/global/plugins/fontello/css/animation.css')}}">
<link rel="stylesheet" href="{{asset('assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}">
{{--<link rel="stylesheet" href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}">--}}
{{--<link rel="stylesheet" href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}">--}}
<link rel="stylesheet" href="{{asset('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')}}" />
<link rel="stylesheet" href="{{asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/global/plugins/rateit/rateit.css')}}">
<link rel="stylesheet" href="{{asset('assets/global/plugins/dropzone/dropzone.css')}}">
<link rel="stylesheet" href="{{asset('assets/global/plugins/fancybox-v3beta/jquery.fancybox-thumbs.css')}}">
<link rel="stylesheet" href="{{asset('assets/global/plugins/fancybox-v3beta/jquery.fancybox.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/css/chat.css')}}">
@if (isset($style_global))
{{$style_global}}
@endif

@section('style_global')
@show
<!-- Global styles END -->

<!-- Page level plugin styles START -->
@if (isset($style_plugin))
{{$style_plugin}}
@endif

@section('style_plugin')
@show
<!-- Page level plugin styles END -->



<!-- Theme styles START -->
<link rel="stylesheet" href="{{asset('assets/global/css/components.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/layout/css/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/pages/css/style-choidau.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/layout/css/style-responsive.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/layout/css/themes/choidau-green.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/layout/css/custom.css')}}">
@if (isset($style_page))
{{$style_page}}
@endif

@section('style_page')
@show
<!-- Theme styles END -->


<style>
    @if(isset($style_script))
    {{$style_script}}
    @endif
</style>
{{-- imtoantran add style section from blade template start --}}
@yield('styles')
{{-- imtoantran add style section from blade template end --}}
<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
