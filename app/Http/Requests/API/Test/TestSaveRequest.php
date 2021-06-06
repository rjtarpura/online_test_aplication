<?php

namespace App\Http\Requests\API\Test;

use Illuminate\Foundation\Http\FormRequest;

class TestSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "start_at"          =>  ["required", "date", "date_format:Y-m-d H:i:s"],
            "end_at"            =>  ["required", "date", "date_format:Y-m-d H:i:s"],
            "question_id"       =>  ["required", "array"],
            "question_id.*"     =>  ["required", "integer", "max:190", "exists:questions,id"],
            "answer_option"     =>  ["required", "array"],
            "answer_option.*"   =>  ["required", "string", "in:option_a,option_b,option_c,option_d"],
            "time_taken"        =>  ["required", "array"],
            "time_taken.*"      =>  ["required", "integer"],
        ];
    }

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $parentValidator = parent::getValidatorInstance();

        $parentValidator->after(function ($validator) {

            // Get validated data
            $validData = $validator->getData();

            $questionCount = count($validData['question_id']);
            $answerCount = count($validData['answer_option']);
            $timeCount = count($validData['time_taken']);

            $doesKeyCountMatch = ($questionCount == $answerCount) && ($answerCount == $timeCount);

            if (!$doesKeyCountMatch) {

                $validator->errors()->add("question_id", "question_id, answer_options and time_taken count must match.");
            }
        });

        return $parentValidator;
    }
}
