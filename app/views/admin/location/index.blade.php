@extends("admin.layouts.main")
@section("content")
    <table id="locations" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Tên</th>
            <th>Người tạo</th>
            <th>Tạo lúc</th>
            <th width="100">{{{ Lang::get('table.actions') }}}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@stop

@section("scripts")
    <script type="text/javascript">
        var oTable;
        $(document).ready(function () {
            oTable = $('#locations').dataTable({
                "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                },
                "bProcessing": true,
                "bServerSide": true,
                "ajax": "{{ URL::to('qtri-choidau/location/data') }}",
                "fnDrawCallback": function (oSettings) {
                }
            });
        });
    </script>
@stop