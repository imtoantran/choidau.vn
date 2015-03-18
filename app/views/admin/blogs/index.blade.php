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
	<div class="pull-right">
		<a href="{{{ URL::to('qtri-choidau/blog/create/') }}}/{{{$catId}}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> {{Lang::get("admin/blogs/button.create")}}</a>
	</div>
	<div class="pull-right">
		<div class="form-group">
			<div class="col-sm-12">
				<select name="name" id="inputID" class="form-control">
					<option value=""> -- Danh mục bài viết -- </option>
					@foreach($categories as $category)
						<option value="{{$category->slug}}" @if($slug === $category->slug) selected @endif> -- {{$category->name}} </option>
						@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="page-header">
		<h3>
			{{{ $title }}}
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
{{-- Scripts --}}
@section('scripts')
{{--	<script src="{{asset("assets/global/plugins/fancybox/source/jquery.fancybox.pack.js")}}" type="text/javascript"></script>--}}
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
		        "sAjaxSource": "{{ URL::to('qtri-choidau/blog/data/'.$slug) }}",
		        "fnDrawCallback": function ( oSettings ) {
	     		}
			});
			$("#inputID").change(function(e){
				if($(this).val()){
					location.href = "{{URL::to("qtri-choidau/blog/danh-muc-")}}"+$(this).val();
				}
			});
		});
	</script>
@stop