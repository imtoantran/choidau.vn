@extends('admin.layouts.main')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Blogs administration @stop
@section('author')Choi dau @stop
@section('description')Blogs Choi dau index @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}

			<div class="pull-right">
				<a href="{{{ URL::to('qtri-choidau/blog/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> {{Lang::get("admin/blogs/button.create")}}</a>
			</div>
		</h3>
	</div>

	<table id="blogs" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-4">{{{ Lang::get('admin/blogs/table.title') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/blogs/table.comments') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/blogs/table.created_at') }}}</th>
				<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
@stop
@section('styles')
	<link rel="stylesheet" href="{{asset("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css")}}">
	<link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="{{asset('assets/global/plugins/wysihtml5/css/prettify.css')}}">
	<link rel="stylesheet" href="{{asset("assets/global/plugins/wysihtml5/css/bootstrap-wysihtml5.css")}}">
	<link rel="stylesheet" href="{{asset('assets/global/plugins/colorbox/colorbox.css')}}">
@stop
{{-- Scripts --}}
@section('scripts')
	<script src="{{asset("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js")}}" type="text/javascript"></script>
	<script src="{{asset("assets/global/plugins/datatables/datatables-bootstrap.js")}}" type="text/javascript"></script>
	<script src="{{asset("assets/global/plugins/datatables/datatables.fnReloadAjax.js")}}" type="text/javascript"></script>
	<script src="{{asset("assets/global/plugins/datatables/jquery.colorbox.js")}}" type="text/javascript"></script>
	<script src="{{asset("assets/global/plugins/fancybox/source/jquery.fancybox.pack.js")}}" type="text/javascript"></script>
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#blogs').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('qtri-choidau/blog/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	           		//$(".iframe").fancybox({iframe:true, width:"80%", height:"80%"});
	     		}
			});
		});
	</script>
@stop