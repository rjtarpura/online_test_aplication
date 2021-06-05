<?php

namespace App\Http\Requests\UserTest;

use App\UserTest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserTestStartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $activeTest = Auth::user()->activeTest;

        return Auth::user()->isNotAdmin() && (!$activeTest instanceof UserTest);
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
