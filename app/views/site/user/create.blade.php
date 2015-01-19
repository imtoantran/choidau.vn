@extends('site.layouts.default')




{{-- Content --}}
@section('content')

<div class="bg-primary">
    <div class="page-header padding-top-10 padding-left-20">
        <h2>Đăng ký thành viên </h2>
        <span>Hãy đăng ký tham gia cộng đồng choidau.net để cùng nhau tận hưởng cuộc sống nhé bạn !</span>
    </div>

</div>

{{ Confide::makeSignupForm()->render() }}

@stop
