@extends('admin.layouts.main')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} :: @parent
@stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}
			<div class="pull-right">
				<a href="{{{ URL::to('qtri-choidau/users/create') }}}" class="btn btn-small btn-info"><span class="glyphicon glyphicon-plus-sign"></span> Thêm</a>
			</div>
		</h3>
	</div>

	<table id="users" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-2">{{{ Lang::get('admin/users/table.username') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/users/table.email') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/users/table.roles') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/users/table.activated') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/users/table.created_at') }}}</th>
				<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		var _$ = "#users";
		$(document).ready(function() {
				oTable = $('#users').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "ajax": "{{ URL::to('qtri-choidau/users/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
//	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}
			});
		});

		/* imtoantran user action start */
		$(_$).on("click","[data-action]",function(e){
			var _t = this;
			switch ($(_t).data("action")) {
				case "delete":
					if(!confirm("Bạn chắc chắn muốn xóa?","Có","Không")) return false;
					break;
				default:break;
			}
			$.blockUI();
			$.ajax({
				url:$(this).data("controller"),
				type:"post",
				dataType:"json",
				data:$(this).data(),
				success:function(response){
					if(response.success) {
						switch ($(_t).data("action")) {
							case "delete":
									$(_t).closest("tr").fadeOut("slow",function(_){$(this).remove()});
								break;
							default:
								break;
						}
					}
				},
				complete:function(_){
					$.unblockUI();
				}
			});
		});
		/* imtoantran user action end */
	</script>
@stop