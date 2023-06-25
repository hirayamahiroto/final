<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view("company_user.auth.login");
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::COMPANY_USER_HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard("company_users")->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/company_user/login");
    }

    // ============================================
    // company user

    public function user_create(): View
    {
        return view("company_user.auth.user_login");
    }

    public function user_store(Request $request)
    {
        $credentials = $request->only("company_id", "email", "password");
        // dd($credentials);
        if (Auth::guard("company_users")->attempt($credentials)) {
            dd(Auth::guard("company_users"));
            // 認証成功の処理
            return redirect()->intended("company/dashboard");
        } else {
            return back()->withErrors([
                "email" => "The provided credentials do not match our records.",
            ]);
        }
    }
}
