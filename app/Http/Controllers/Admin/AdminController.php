<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Show admin index view
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.index');
    }
}
