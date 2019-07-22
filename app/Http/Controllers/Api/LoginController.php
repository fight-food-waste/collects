<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Str;

class LoginController extends Controller
{
    /**
     * Generate new token and sent it back to user if auth is successful
     *
     * @param Request $request
     * @return array|JsonResponse
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $token = Str::random(60);

            $request->user()->forceFill([
                'api_token' => hash('sha256', $token),
            ])->save();

            return ['token' => $token];
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
