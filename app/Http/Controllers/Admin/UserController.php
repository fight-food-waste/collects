<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\User;
use App\NeedyPerson;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display view with all the Categories
     *
     * @return Factory|View
     */
    public function index()
    {
        $users = User::all();

        $unapprovedNeedyPeople = NeedyPerson::where('status', 0)->get();

        return view('admin.users.index', compact('users', 'unapprovedNeedyPeople'));
    }
}
