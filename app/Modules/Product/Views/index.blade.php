@extends('layouts.master')
@section('title','Product' )
@section('breadcrumb')
<h4><i class="icon-arrow-left52 position-left"></i>Product - List</h4>
@stop
@section('quick_link')
<a href="{{URL::route("product.create")}}" class="btn bg-primary-400 btn-labeled" title="Add New"><b><i class="icon-plus2"></i></b>Add New</a>
@stop
@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        <table id="table" class="table table-striped dataTable no-footer dtr-inline">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product Title</th>
                    <th>SKU</th>
                    <th>Created On</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</div>
@stop
@push("scripts")
<script type="text/javascript">
    
    $(document).ready(function () {
        $('#table').DataTable({
            autoWidth: false,
            processing: true,
            responsive: true,
            serverside: true,
            ajax: '{{route('product.index')}}',
            columnDefs: [
                {
                    width: '4%',
                    targets: 0,
                    data: 'id'
                },
                {
                    width: '15%',
                    targets: 1,
                    data: 'product_pic'
                },
                {
                    width: '15%',
                    targets: 2,
                    data: 'product_title'
                },
                {
                    width: '15%',
                    targets: 3,
                    data: 'product_sku'
                },
                {
                    width: '13%',
                    targets: 4,
                    data: 'created_at'
                },

                {
                    targets: 5,
                    data: 'status',
                    width: '10%',
                },
                {
                    orderable: false,
                    targets: 6,
                    data: 'actions',
                    width: '8%',
                }
            ],
            lengthMenu: [15, 25, 50, 75, 100],
            displayLength: 15,
            order: [[ 0, "desc" ]],
            dom: '<"datatable-header"fl><"datatable-scroll-lg"t><"datatable-footer"ip>'

        });

        $('.dataTables_length select').select2({
             minimumResultsForSearch: "-1",
            width: 'auto'
        });
    });

</script>
@endpush

