<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class QuestionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "question"  =>  ["required", "string", "max:190"],
            "option_a"  =>  ["required", "string", "max:190"],
            "option_b"  =>  ["required", "string", "max:190"],
            "option_c"  =>  ["required", "string", "max:190"],
            "option_d"  =>  ["required", "string", "max:190"],
            "correct_answer"  =>  ["required", "string", "in:option_a,option_b,option_c,option_d"],
        ];
    }
}
