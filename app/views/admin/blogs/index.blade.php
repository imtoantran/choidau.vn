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
		<a data-catid="{{{$catId}}}" href="#" class="btn btn-small btn-info iframe btn-create"><span class="glyphicon glyphicon-plus-sign"></span> Đăng bài</a>
	</div>
	<div class="pull-right">
		<div class="form-group">
			<div class="col-sm-12">
				<select name="name" id="inputID" class="form-control">
					<option value=""> -- Danh mục bài viết -- </option>
					<option value="all" @if($slug === "all") selected @endif> -- Tất cả -- </option>
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
		var _$ = "#blogs";
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

			$('.btn-create').on('click', function(e){
				e.preventDefault();
				if($(this).attr('data-catid') == 'all'){
					alert('Bạn hãy chọn một danh mục');
				}else{
					window.location = '{{{URL::to('qtri-choidau/blog/create/') }}}/{{{$catId}}}';
				}
			});
		});
	</script>
@stop