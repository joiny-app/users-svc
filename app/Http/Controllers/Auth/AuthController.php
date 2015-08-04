<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Exception\HttpResponseException;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;

class AuthController extends Controller
{

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email|max:255', 'password' => 'required',
            ]);
        } catch (HttpResponseException $e) {
            return response()->json(
            [
                'error' => [
                    'message'     => 'Invalid auth',
                    'status_code' => IlluminateResponse::HTTP_BAD_REQUEST
                ]
            ],
                IlluminateResponse::HTTP_BAD_REQUEST,
                $headers = []
            );
        }

        $user = User::where('email', $request['email'])->first();
        // $customFields = ['role' => $user->role]; // $token = JWTAuth::fromUser($user, $customFields)

        try {
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not creade token'], 500);
        }
        return response()->json(compact('token'));
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only('email', 'password');
    }
}
