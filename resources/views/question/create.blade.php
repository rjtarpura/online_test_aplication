@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{ route('home') }}">Home</a>
        </li>

        <li>
            <a href="{{ route('questions.index') }}">Questions</a>
        </li>
        <li class="active">Add Question</li>
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
                            {{ Form::open(['route' => 'questions.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'id' => 'question-form', 'autocomplete' => 'off']) }}
                            <div class="widget-main">
                                @include('question.form')
                            </div>
                            <div class="widget-toolbox padding-8 clearfix">
                                <div class="pull-right">
                                    <button class="btn btn-xs btn-success" type="submit">
                                        <span class="bigger-110">Save</span>
                                    </button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $("#question-form").validate();
    });
</script>
@endpush