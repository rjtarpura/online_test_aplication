@push('style')
<style>
    hr {
        margin-top: 15px;
        margin-bottom: 15px;
    }
</style>
@endpush

@php
$options = [
'' => 'Choose Correct Option',
'option_a' => 'Option#A',
'option_b' => 'Option#B',
'option_c' => 'Option#C',
'option_d' => 'Option#D',
];
@endphp

<div class="row">
    <div class="col-sm-6">
        <div>
            <label for="form-field-8">Question</label>
            {{ Form::textarea('question', null, ['class' => 'form-control', 'placeholder' => 'Type Question...', 'rows' => 3, 'required' => 'required']) }}
            @error('question')
            <label id="question-error" class="error" for="question">{{$message}}</label>
            @enderror
        </div>
        <hr />

        <div>
            <label for="form-field-8">Correct Answer Option</label>
            {{ Form::select('correct_answer', $options, null, ['class' => 'form-control', 'data-placeholder' => 'Correct Answer Option...', 'required' => 'required']) }}
            @error('correct_answer')
            <label id="correct_answer-error" class="error" for="correct_answer">{{$message}}</label>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">

        <div>
            <label for="form-field-8">Option #A</label>
            {{ Form::textarea('option_a', null, ['class' => 'form-control', 'placeholder' => 'Option #A', 'rows' => 2, 'required' => 'required']) }}
            @error('option_a')
            <label id="option_a-error" class="error" for="option_a">{{$message}}</label>
            @enderror
        </div>
        <hr />

        <div>
            <label for="form-field-8">Option #B</label>
            {{ Form::textarea('option_b', null, ['class' => 'form-control', 'placeholder' => 'Option #B', 'rows' => 2, 'required' => 'required']) }}
            @error('option_b')
            <label id="option_b-error" class="error" for="option_b">{{$message}}</label>
            @enderror
        </div>
        <hr />

        <div>
            <label for="form-field-8">Option #D</label>
            {{ Form::textarea('option_c', null, ['class' => 'form-control', 'placeholder' => 'Option #C', 'rows' => 2, 'required' => 'required']) }}
            @error('option_c')
            <label id="option_c-error" class="error" for="option_c">{{$message}}</label>
            @enderror
        </div>
        <hr />

        <div>
            <label for="form-field-8">Option #D</label>
            {{ Form::textarea('option_d', null, ['class' => 'form-control', 'placeholder' => 'Option #D', 'rows' => 2, 'required' => 'required']) }}
            @error('option_d')
            <label id="option_d-error" class="error" for="option_d">{{$message}}</label>
            @enderror
        </div>
    </div>
</div>