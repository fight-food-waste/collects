<?php

namespace App\Http\Controllers;

use App\Bundle;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{

    public function getProfile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userType = $user->type;
            $bundles = Bundle::where('user_id', $user->id)->get();

            if ($userType == 'donor') {
                return view('user.profile', ['user' => $user, 'bundles' => $bundles]);
            } else if ($userType == 'storekeeper') {
                return view('user.profile', ['user' => $user, 'bundles' => $bundles]);
            } else if ($userType == 'need_people') {
                return view('user.profile', compact('user'));
            } else if ($userType == 'employee') {
                return view('user.profile', compact('user'));
            } else {
                exit();
            }
        }
    }
}
