@extends('emails.layout')

@section('content')
<p>Your Result : </p>
<br/>
<table>
    <tbody>
        <tr>
            <td>Test Date:</td>
            <td>{{$userTest->start_at->format('Y-m-d')}}</td>
        </tr>
        <tr>
            <td>Test Time:</td>
            <td>{{$userTest->start_at->format('H:i:s')}} - {{$userTest->end_at->format('H:i:s')}}</td>
        </tr>
        <tr>
            <td>Questions Attempted:</td>
            <td>{{$userTest->questions_attempted}}</td>
        </tr>
        <tr>
            <td>Crorrect Answers:</td>
            <td>{{$userTest->correct_answers}}</td>
        </tr>
        <tr>
            <td>InCrorrect Answers:</td>
            <td>{{$userTest->incorrect_answers}}</td>
        </tr>
        <tr>
        <tr>
            <td>Time Taken:</td>
            <td>{{ gmdate("i:s", $userTest->userTestSheets->sum('time_taken')) }}</td>
        </tr>
        <tr>
            <td>Result:</td>
            <td>
                @if($userTest->isPassed())
                Passed
                @elseif($userTest->isFailed())
                Failed
                @elseif(!$userTest->end_at)
                -
                @endif
            </td>
        </tr>
    </tbody>
</table>
@endsection

@section('mailPreviewText')
{{ config('app.name', 'Laravel') }}
@endsection