@extends('layouts.app')

@section('title', 'Questions')

@section('breadcrumb')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="active">Questions</li>
    </ul><!-- /.breadcrumb -->
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="main-widget-container">
            <div class="row">
                <div class="col-xs-12 widget-container-col ui-sortable">
                    <div class="widget-box ui-sortable-handle">
                        <div class="widget-body">
                            <table id="question-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th style="width:120px;">Created At</th>
                                        <th style="width:120px;">Updated At</th>
                                        <th style="width:150px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

<!-- datatable js -->
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>

<script>
    $(document).ready(function() {

        const editUrl = "{{ route('questions.edit', ['question' => ':id']) }}",
            destroyUrl = "{{ route('questions.destroy', ['question' => ':id']) }}",
            csrfToken = $("meta[name='csrf-token']").attr('content');

        $("#question-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('questions.table') }}",
                type: "POST",
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    searchable: false,
                    sortable: false,
                },
                {
                    data: 'question',
                    name: 'question',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                },
                {
                    data: 'id',
                    name: 'id',
                    searchable: false,
                    sortable: false,
                    "render": function(id, type, row) {
                        return `<div class="action-buttons">
                                    <a class="blue" href="javascript:void(0);">
                                        <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                    </a>

                                    <a class="green" href="${editUrl.replace(':id', id)}">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>

                                    <a class="red destroy-question" href="${destroyUrl.replace(':id', id)}">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        <form action="${destroyUrl.replace(':id', id)}" method="POST" class="d-none">
                                            <input type="hidden" name="_token" value="${csrfToken}"/>
                                            <input type="hidden" name="_method" value="DELETE"/>
                                        </form>
                                    </a>
                                </div>`;
                    },
                },
            ],
            order: [
                [2, 'desc']
            ],
            searchDelay: 500,
        }).on('click', '.destroy-question', function(e) {

            e.preventDefault();

            const $form = $(this).find('form');

            swal({
                    title: 'Are you sure?',
                    text: 'Once deleted, you will not be albe to recover this question',
                    icon: 'warning',
                    buttons: true,
                })
                .then(willDelete => {
                    if (willDelete) {
                        $form.trigger('submit');
                    }
                });
        });
    });
</script>
@endpush