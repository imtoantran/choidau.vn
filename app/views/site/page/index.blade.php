@extends('site.layouts.default')
{{-- Content --}}
@section('content')
    @if(isset($page) && count($page))
        <div class="row margin-top-15">
            <div class="col-md-12">
                <h2 class="text-center" style="color: #799595;">{{$page->title}}</h2>
                <div style="border-bottom: 1px solid #f6f6f6; margin-bottom: 10px;"></div>
            </div>
        </div>
        <div class="row margin-bottom-15">
            <div class="col-md-12">
                {{$page->content}};
            </div>
        </div>
    @endif

@stop


@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function () {

    });
</script>
@stop