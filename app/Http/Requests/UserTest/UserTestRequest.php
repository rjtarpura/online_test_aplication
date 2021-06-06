<?php

namespace App\Http\Requests\UserTest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserTestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $userTestCount = Auth::user()->tests()->count();

        return Auth::user()->isNotAdmin() && $userTestCount == 0;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //..
        ];
    }
}
