<!-- JavaScript required for CMS-->
@if (isset($js_variable))
{{$js_variable}}
@endif


<script type="text/javascript">
    URL = '{{URL::to('/')}}';


</script>


<!-- END fast view of a product -->

<!-- Load javascripts at bottom, this will reduce page load time -->
<!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>

<![endif]-->


<!-- START CORE GLOBAL -->

@if (isset($js_global))
{{$js_global}}
@endif

@section('js_global')
@show

<!-- END CORE GLOBAL -->




<!-- START CORE PLUGINS -->


<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-alerts/jquery.alerts.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootbox/bootbox.min.js')}}"></script>

@if (isset($js_plugin))
{{$js_plugin}}
@endif

@section('js_plugin')
@show

<!-- END CORE PLUGINS -->



<!-- START CORE PAGE -->
<script src="{{asset('assets/frontend/layout/scripts/back-to-top.js')}}"></script>
@if (isset($js_page))
{{$js_page}}
@endif

@section("js_page")
@show
<!-- START CORE PAGE -->




<!-- START CORE JS SCRIPT -->
<script src="{{asset('assets/frontend/layout/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/pages/scripts/form-fileupload.js')}}"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        $.ajaxSetup({
            data:{"_token":"{{Session::getToken()}}"}
        });
        // Active menu


        $(function() {
            var pgurl = window.location.href.substr( window.location.href.lastIndexOf("/") + 1 );
            $("#nav1 li a").each(function(){
                var href = $(this).attr("href");
                var ctr = href.substr( href.lastIndexOf("/") + 1 ) ;
                if(ctr == pgurl || ctr == '' )
                    $(this).parent().addClass("on");
            });
        });

        Layout.init();
        try {
            FormFileUpload.init();
        }
        catch(err) {}

        @if (isset($js_script))
                {{$js_script}}
        @endif

        @section("js_script")
        @show



    });
</script>

<!-- END CORE JS SCRIPT -->
@yield('scripts')

