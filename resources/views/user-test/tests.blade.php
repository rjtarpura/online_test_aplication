@extends('layouts.app')

@section('title', 'Tests')

@section('breadcrumb')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="active">Tests</li>
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
                            <table id="test-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Candidate Name</th>
                                        <th style="width:100px;">Attempted</th>
                                        <th style="width:100px;">Correct</th>
                                        <th style="width:100px;">InCorrect</th>
                                        <th style="width:100px;">Status</th>
                                        <th style="width:150px;">Start At</th>
                                        <th style="width:100px;">End At</th>
                                        <th style="width:100px;">Time</th> 
                                        <th style="width:100px;">Canceled?</th>
                                        <th style="width:50px;"></th>
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

        const viewUrl = "{{ route('user-tests.show', ['userTest' => ':id']) }}";

        $("#test-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('user-tests.table') }}",
                type: "POST",
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    searchable: false,
                    sortable: false,
                },
                {
                    data: 'candidate_name',
                    name: 'candidate_name',
                },
                {
                    data: 'questions_attempted',
                    name: 'questions_attempted',
                },
                {
                    data: 'correct_answers',
                    name: 'correct_answers',
                },
                {
                    data: 'incorrect_answers',
                    name: 'incorrect_answers',
                }, {
                    data: 'is_passed',
                    name: 'is_passed',
                    searchable: false,
                },
                {
                    data: 'start_at',
                    name: 'start_at',
                },
                {
                    data: 'end_at',
                    name: 'end_at',
                    searchable: false,
                    sortable: false,
                },
                {
                    data: 'time_taken',
                    name: 'time_taken',
                    searchable: false,
                    sortable: false,
                }, {
                    data: 'is_auto_stop',
                    name: 'is_auto_stop',
                    searchable: false,
                },
                {
                    data: 'id',
                    name: 'id',
                    searchable: false,
                    sortable: false,
                    "render": function(id, type, row) {
                        return `<div class="action-buttons">
                                    <a class="blue" href="${viewUrl.replace(':id', id)}">
                                        <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                    </a>
                                </div>`;
                    },
                },
            ],
            order: [
                [0, 'asc']
            ],
            searchDelay: 500,
        });
    });
</script>
@endpush