@extends('site.layouts.right_sidebar')
@section('topa')
    <!-- banner -->
    <div class="row margin-bottom-10 margin-top-10">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="banner-top">
                <img src="http://www.collectivehospitality.co.nz/media/1228/col_H_fingerfood.jpg" class="img-responsive" alt="Image">
            </div>
        </div>
    </div>
    <!-- banner end -->
@stop
@section('sidebar')
    @include("site.faq.sidebar")
@stop

{{-- Content --}}
@section('content')

    <div class="col-sm-12 col-md-9 col-lg-9 padding-left-0">
    fdssdfdsf
    </div>
@stop


@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function () {
        {{--$('.btn-popup-faq').on('click',function(){--}}
            {{--$('#popup-faq-create').modal('show');--}}
        {{--});--}}

        {{--$('#frm-create-faq').submit(function(e){--}}
            {{--e.preventDefault();--}}
            {{--var self = $(this);--}}
            {{--$.ajax({--}}
                {{--url: '{{URL::to('faq/tao-chu-de.html')}}',--}}
                {{--type: 'post',--}}
                {{--data: self.serialize(),--}}
                {{--success: function(respon){--}}
                    {{--if(respon){--}}
                        {{--alert('Thêm câu hỏi thành công.');--}}
                    {{--}else{--}}
{{--//                        alert('')--}}
                    {{--}--}}
                    {{--window.location = '{{URL::current()}}';--}}
                {{--}--}}
            {{--})--}}

        {{--});--}}
    });
</script>
@stop