<?php

namespace App\Http\Requests\UserTest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserTestAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isNotAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question_id'   =>  ["required", "integer", "exists:questions,id"],
            'answer_option' =>  ["required", "string", "in:option_a,option_b,option_c,option_d"],
        ];
    }
}
