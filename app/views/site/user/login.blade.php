@extends('site.layouts.default')



{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>Login into your account</h1>
</div>
{{ Confide::makeLoginForm()->render() }}
@stop
