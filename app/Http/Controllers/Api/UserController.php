<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Return the user's information to itself
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function self(Request $request)
    {
        return $request->user();
    }
}
