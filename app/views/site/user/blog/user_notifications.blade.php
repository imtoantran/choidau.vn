@extends('site.layouts.default')
@section('content')
@stop
@section('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            data: {"_token": "{{Session::getToken()}}"}
        });
    </script>
@stop