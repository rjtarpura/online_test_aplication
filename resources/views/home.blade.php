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
<div class="alert alert-info">
    <strong>Heads up!</strong>

    You can start a new test !!
    <br>
    <br>
    <p>
        <a href="{{ route('user-tests.index') }}" class="btn btn-sm btn-info">Start Test</a>
    </p>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="accordion-style1 panel-group">
            @forelse($userTests as $userTest)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapse-{{ $loop->iteration }}" aria-expanded="false">
                            <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            &nbsp;Test #{{ $loop->remaining + 1 }}
                            @if($userTest->end_at)
                            : ({{ $userTest->end_at->format('Y-m-d') }})

                            @if($userTest->isPassd())
                            <span class="label label-sm label-success pull-right">Passed</span>
                            @else
                            <span class="label label-sm label-warning pull-right">Failer</span>
                            @endif
                            @else
                            <span class="label label-sm label-inverse arrowed-in pull-right">Ongoing {{$userTest->userTestSheets->count()}} / {{$totalQuestions}}</span>
                            @endif
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

                        <p class="options text-muted">Option A: {{ $testSheet->question->option_a }}</p>
                        <p class="options text-muted">Option B: {{ $testSheet->question->option_b }}</p>
                        <p class="options text-muted">Option C: {{ $testSheet->question->option_c }}</p>
                        <p class="options text-muted">Option D: {{ $testSheet->question->option_d }}</p>

                        <p class="text-right">
                            <span class="label label-sm label-inverse arrowed-in">Correct Choice: {{$testSheet->question->correct_answer}}</span>
                            <span class="label label-sm @if($testSheet->is_correct) label-success @else label-warning @endif">Your Choice: @if($testSheet->answer_option) {{$testSheet->answer_option}} @else Auto Submit @endif</span>
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