<?php

namespace App\Http\Controllers\Dashboard\Organization\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Organization\Auth\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index(): RedirectResponse | View
    {
        if (auth('organization')->check()) {

            return redirect()->route('dashboard.organization.index');

        } else {

            return view('dashboard.organization.auth.login');
        }

    }//end of index

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth('organization')->attempt($credentials, request()->has('remember'))) {

            session()->flash('success', __('admin.messages.login_successfully'));

            return redirect()->route('dashboard.organization.index');

        } else {

            return redirect()->back()->with(['password' => __('admin.auth.password_invalid')])->withInput();

        }//end of if

    }//end of index

    public function logout()
    {
        auth('organization')->logout();

        return redirect()->route('dashboard.organization.auth.login.index');

    }//end of fun

}//end of controller
