<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
     /**
     * Staff panel login page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::check()) {
            // return redirect()->route('staff.dashboard');
        }
        return view('admin.login');
    }


    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {

        $email = $request->get('email');
        $password = $request->get('password');

        if (Auth::attempt(['email' => $email, 'password' => $password ])) {
            // Authentication passed...
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->back()->with('errors', ['Authentication failed.']);
    }

    public function logout()
    {
        Auth::Logout();
        return redirect()->route('admin.login');
    }
}

