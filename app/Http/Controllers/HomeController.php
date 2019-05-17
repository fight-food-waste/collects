<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\View\View.
     */

    public function show()
    {
        if (Auth::check()) {
            $currentUserId = Auth::user()->id;
            $currentUser = User::findOrFail($currentUserId);

            return view('home', ['user' => $currentUser]);
        } else {
            return view('home');
        }
    }
}
