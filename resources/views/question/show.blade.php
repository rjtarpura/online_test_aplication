@extends('layouts.app')

@section('title', 'Question Details')

@push('style')
<style>
    p.ml {
        margin-left: 20px;
    }
</style>
@endpush

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
        <li class="active">Question Details #{{ $question->id }}</li>
    </ul><!-- /.breadcrumb -->
</div>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="widget-box transparent">
                    <div class="widget-body">
                        <div class="widget-main padding-24">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p class="text-primary">
                                                <b>Question:</b>
                                                <br />
                                            <p class="ml" style="font-size:15px;">{{ $question->question }}</p>
                                            </p>

                                            <p class="text-primary">
                                                <b>Options:</b>
                                            </p>

                                            <p class="ml text-muted @if($question->correct_answer == 'option_a') text-success @endif">A): {{ $question->option_a }}</p>
                                            <p class="ml text-muted @if($question->correct_answer == 'option_b') text-success @endif">B): {{ $question->option_b }}</p>
                                            <p class="ml text-muted @if($question->correct_answer == 'option_c') text-success @endif">C): {{ $question->option_c }}</p>
                                            <p class="ml text-muted @if($question->correct_answer == 'option_d') text-success @endif">D): {{ $question->option_d }}</p>

                                            <p class="text-right">
                                                <span class="label label-success arrowed-in">Correct Option: {{strtoupper(substr($question->correct_answer,-1))}}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection