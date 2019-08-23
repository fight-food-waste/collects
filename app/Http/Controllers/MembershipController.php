<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class MembershipController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->type != "storekeeper") {
            abort(403);
        }

        return view('membership.index', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function renew(Request $request)
    {
        $user = $request->user();

        if ($user->type != "storekeeper") {
            abort(403);
        }

        if ($user->hasValidMembership()) {
            return redirect()->back()->with('success', __('flash.membership_controller.renew_success_1'));
        } else {
            $user->membership_end_date = date('Y-m-d', strtotime('+1 years'));
            $user->save();

            return redirect()->back()->with('success', __('flash.membership_controller.renew_success_2'));
        }
    }
}
