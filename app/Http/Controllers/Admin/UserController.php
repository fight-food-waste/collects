<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\User;
use App\NeedyPerson;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    /**
     * Approve a User
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function approve(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));
        $user->status = 1;
        $user->save();

        return redirect()->back()
            ->with('success', 'User ' . $request->input('user_id') . ' has been approved.');
    }

    /**
     * Reject a User
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function reject(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));
        $user->status = -1;
        $user->save();

        return redirect()->back()
            ->with('success', 'User ' . $request->input('user_id') . ' has been rejected.');
    }

    /**
     * Download an application PDF
     *
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function downloadApplication(Request $request)
    {
        $filename = $request->route('id') . '.pdf';
        $filepath = storage_path('app' . DIRECTORY_SEPARATOR . 'application_files' . DIRECTORY_SEPARATOR . $filename);

        return response()->file($filepath);
    }
}
