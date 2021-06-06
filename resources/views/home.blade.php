@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
<style>
    p.options {
        margin-left: 10px;
    }
</style>
@endpush

@section('content')
@if(Auth::user()->isAdmin())
<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div class="alert alert-info">
            Total Users : {{$totalUsers}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="alert alert-warning">
            Total Questions : {{$totalQuestions}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="alert alert-success">
            Total Tests Conducted : {{$totalTestsConducted}}
        </div>
    </div>
</div>
@else

@if($userTests->count() == 0)
<div class="alert alert-info">
    <strong>Heads up!</strong>

    You can start a new test !!
    <br>
    <br>
    <p>
        <a href="{{ route('user-tests.index') }}" class="btn btn-sm btn-info">Start Test</a>
    </p>
</div>
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="accordion-style1 panel-group">
            @forelse($userTests as $userTest)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapse-{{ $loop->iteration }}" aria-expanded="false">
                            <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            &nbsp;Test #{{ $loop->remaining + 1 }} : ({{ $userTest->start_at->format('Y-m-d') }})

                            <p class="pull-right">
                                @if($userTest->isPassed())
                                <span class="label label-sm arrowed-in label-success">Passed</span>
                                <span class="label label-sm arrowed-in-right label-info"><i class="ace-icon fa fa-clock-o"></i> {{ gmdate("i:s", $userTest->userTestSheets->sum('time_taken')) }}</span>
                                @elseif($userTest->isFailed())
                                <span class="label label-sm arrowed-in label-danger">Failed</span>
                                <span class="label label-sm arrowed-in-right label-info"><i class="ace-icon fa fa-clock-o"></i> {{ gmdate("i:s", $userTest->userTestSheets->sum('time_taken')) }}</span>
                                @elseif(!$userTest->end_at)
                                <span class="label label-sm label-inverse arrowed-in">Ongoing {{$userTest->userTestSheets->count()}} / {{$totalQuestions}}</span>
                                @endif
                            </p>
                        </a>
                    </h4>
                </div>

                <div class="panel-collapse collapse" id="collapse-{{ $loop->iteration }}" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                        @php
                        $questionsAttempeted = $userTest->userTestSheets->count();
                        $percentCompleted = ($questionsAttempeted/$totalQuestions)*100;

                        @endphp

                        @if(!$userTest->end_at)
                        <div class="progress progress-mini progress-striped">
                            <div class="progress-bar progress-bar-inverse" style="width: {{$percentCompleted}}%;"></div>
                        </div>
                        @endif

                        @foreach($userTest->userTestSheets as $index =>$testSheet)

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
                        @endforeach
                    </div>
                </div>
            </div>

            @empty
            <div class="alert alert-warning">
                You have not attempted any test yet!!
            </div>
            @endforelse
        </div>
    </div>
</div>
@endif
@endsection