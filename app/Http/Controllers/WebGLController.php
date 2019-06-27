<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebGLController extends Controller
{
    public function demo()
    {
        return view('3d_demo');
    }
}
