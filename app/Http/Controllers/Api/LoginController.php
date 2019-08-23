<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Generate new token and sent it back to user if auth is successful
     *
     * @param Request $request
     *
     * @return array|JsonResponse
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            if ($request->user()->type == "storekeeper") {
                if (! $request->user()->hasValidMembership()) {
                    return response()->json(['error' => "membership.invalid"], 401);
                }
            }

            $token = $request->user()->renewToken();

            return ['token' => $token];
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
