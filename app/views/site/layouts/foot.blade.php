

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
<!-- END CORE GLOBAL -->




<!-- START CORE PLUGINS -->
<script src="{{asset('assets/global/plugins/jquery.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-migrate.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/frontend/layout/scripts/back-to-top.js')}}"></script>
@if (isset($js_plugin))
{{$js_plugin}}
@endif
<!-- END CORE PLUGINS -->


<!-- START CORE PAGE -->
@if (isset($js_page))
{{$js_page}}
@endif
<!-- START CORE PAGE -->




<!-- START CORE JS SCRIPT -->
<script src="{{asset('assets/frontend/layout/scripts/layout.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        Layout.init();
        URL = '{{URL::to('/')}}';
        @if (isset($js_script))
                {{$js_script}}
        @endif
    });
</script>

<!-- END CORE JS SCRIPT -->
@yield('scripts')

