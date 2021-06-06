<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\API\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseApiController
{
    /**
     * Attempt to login the user.
     * 
     * @param  \App\Http\Requests\API\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        try {

            if (!Auth::attempt($credentials)) {

                return $this->setStatusCode(422)->respond([
                    'status_code'   =>  422,
                    'message'       =>  trans('api.messages.login.failed'),
                ]);
            }

            $user = $request->user();

            $passportToken = $user->createToken('API Access Token');

            // Save generated token
            $passportToken->token->save();

            $token = $passportToken->accessToken;
        } catch (\Exception $e) {

            return $this->setStatusCode(500)->respond([
                'status_code'   =>  500,
                'message'       =>  $e->getMessage(),
            ]);
        }

        return $this->respond([
            'status_code'   =>  200,
            'message'       =>  trans('api.messages.login.success'),
            'token'         =>  $token,
        ]);
    }

    /**
     * Attempt to logout the user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {

            $request->user()->token()->revoke();
        } catch (\Exception $e) {
            return $this->setStatusCode(500)->respond([
                'status_code'   =>  500,
                'message'       =>  $e->getMessage(),
                'data'          =>  null,
            ]);
        }

        return $this->respond([
            'status_code'   =>  200,
            'message'       =>  trans('api.messages.logout.success'),
            'data'          =>  null,
        ]);
    }
}
