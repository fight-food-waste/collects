<?php

namespace App\Http\Controllers;

use App\Bundle;
use App\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the User's account page containing his information
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('account.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Show User account edit page
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function edit(Request $request)
    {
        return view('account.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Delete User with all its Bundles and Products associated
     *
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));

        foreach ($user->bundles as $bundle) {
            $bundle->products->each->delete();
        }

        $user->bundles->each->delete();

        try {
            $user->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', __('flash.account_controller.destroy_error'));
        }

        auth()->logout();

        return redirect('login')->with('success', __('flash.account_controller.destroy_success'));
    }
}
