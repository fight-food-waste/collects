<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @param Request $request
     * @return View.
     */

    public function show(Request $request)
    {
        if ($request->user()) {
            return view('home', ['user' => $request->user()]);
        } else {
            return view('welcome');
        }
    }
}
