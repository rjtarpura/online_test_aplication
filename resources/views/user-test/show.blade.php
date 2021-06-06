@extends('layouts.app')

@section('title', 'Tests Details')

@section('breadcrumb')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li>
            <a href="{{ route('user-tests.manage') }}">Tests</a>
        </li>
        <li class="active">Test Details #{{ $userTest->id }}</li>
    </ul><!-- /.breadcrumb -->
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-pencil-square-o green"></i>
                            Test Sheet

                            <span style="font-size: 13px;margin-left: 10px;">
                                <i class="ace-icon fa fa-clock-o"></i>
                                {{ gmdate("i:s", $userTest->userTestSheets->sum('time_taken')) }}
                            </span>
                        </h3>

                        <div class="widget-toolbar no-border invoice-info">
                            <span class="invoice-info-label">Candidate:</span>
                            <span class="red">{{$userTest->user->name}}</span>

                            <br />
                            <span class="invoice-info-label">Date:</span>
                            <span class="blue">{{$userTest->start_at->format('Y-m-d')}}</span>
                        </div>

                        <div class="widget-toolbar hidden-480">
                            <span class="invoice-info-label">
                                @if($userTest->isPassed())
                                <span class="label label-sm arrowed-in label-success">Passed</span>
                                @elseif($userTest->isFailed())
                                <span class="label label-sm arrowed-in label-danger">Failed</span>
                                @elseif(!$userTest->end_at)
                                <span class="label label-sm label-inverse arrowed-in">Ongoing</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-24">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-12 label label-lg label-info arrowed-in arrowed-in-right" style="margin-bottom: 30px;">
                                            <b>Questions</b>
                                        </div>
                                        @foreach($userTest->userTestSheets as $index =>$testSheet)
                                        <div class="col-xs-12">
                                            <p class="text-primary">Question#{{ $index+1 }}: {{ $testSheet->question->question }}</p>

                                            <p class="options text-muted @if($testSheet->question->correct_answer == 'option_a') text-success @endif">Option A: {{ $testSheet->question->option_a }}</p>
                                            <p class="options text-muted @if($testSheet->question->correct_answer == 'option_b') text-success @endif">Option B: {{ $testSheet->question->option_b }}</p>
                                            <p class="options text-muted @if($testSheet->question->correct_answer == 'option_c') text-success @endif">Option C: {{ $testSheet->question->option_c }}</p>
                                            <p class="options text-muted @if($testSheet->question->correct_answer == 'option_d') text-success @endif">Option D: {{ $testSheet->question->option_d }}</p>

                                            <p class="text-right">
                                                <span class="label label-inverse arrowed-in">Correct Option: {{strtoupper(substr($testSheet->question->correct_answer,-1))}}</span>

                                                @if($testSheet->answer_option)
                                                @if($testSheet->is_correct)
                                                <span class="label label-success"><i class="ace-icon fa fa-check"></i> Your Answer: {{strtoupper(substr($testSheet->answer_option,-1))}}</span>
                                                @else
                                                <span class="label label-danger"><i class="ace-icon fa fa-times"></i> Your Answer: {{strtoupper(substr($testSheet->answer_option,-1))}}</span>
                                                @endif
                                                @else
                                                <span class="label label-default" title="Time Taken">Auto Submit</span>
                                                @endif

                                                <span class="label arrowed-in-right label-info" title="Time Taken"><i class="ace-icon fa fa-clock-o"></i> {{$testSheet->time_taken_formated}}</span>
                                            </p>
                                            <hr />
                                            <div class="space"></div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-sm-5 pull-right">
                                    <h4 class="pull-right">
                                        Test Status :
                                        @if($userTest->isPassed())
                                        <span class="green">Passed</span>
                                        @elseif($userTest->isFailed())
                                        <span class="red">Failed</span>
                                        @elseif(!$userTest->end_at)
                                        <span class="blue">Ongoing</span>
                                        @endif
                                    </h4>
                                </div>
                                <div class="col-sm-7 pull-left">
                                    Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-muted">{{$userTest->start_at->format('Y-m-d')}}</span>
                                    <br />
                                    Start At: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-muted">{{$userTest->start_at->format('H:i:s')}}</span>
                                    <br />
                                    End At: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-muted">@if($userTest->end_at) {{$userTest->end_at->format('H:i:s')}} @else Not Completed Yet @endif</span>
                                    <br />
                                    Time Taken: &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-muted">{{ gmdate("i:s", $userTest->userTestSheets->sum('time_taken')) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection