<?php

namespace App\Http\Controllers\Dashboard\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Auth\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index(): RedirectResponse | View
    {
        if (auth('admin')->check()) {

            return redirect()->route('dashboard.admin.index');

        } else {

            return view('dashboard.admin.auth.login');
        }

    }//end of index

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth('admin')->attempt($credentials, request()->has('remember'))) {

            session()->flash('success', __('admin.messages.login_successfully'));

            return redirect()->route('dashboard.admin.index');

        } else {

            return redirect()->back()->with(['password' => __('admin.auth.password_invalid')])->withInput();

        }//end of if

    }//end of index

    public function logout()
    {
        auth('admin')->logout();

        return redirect()->route('dashboard.admin.auth.login.index');

    }//end of fun

}//end of controller
