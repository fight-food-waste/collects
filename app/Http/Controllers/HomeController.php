<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return View
     */

    public function show()
    {
        $currentUserId = \Auth::user()->id;
        $currentUser = User::findOrFail($currentUserId);

        return view('home', ['user' => $currentUser]);
    }
}
