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
        return view("company.auth.login");
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->only("email", "password");

        if (Auth::guard("company")->attempt($credentials)) {
            return redirect()->intended("company/dashboard");
        } else {
            return back()->withErrors([
                "email" => "The provided credentials do not match our records.",
            ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard("company")->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/company/login");
    }

    // ============================================
    // company user

    public function user_create(): View
    {
        return view("company.auth.user_login");
    }

    public function user_store(Request $request)
    {
        $credentials = $request->only("company_id", "email", "password");

        if (Auth::guard("company_users")->attempt($credentials)) {
            return redirect()->intended("company/dashboard");
        } else {
            return back()->withErrors([
                "email" => "The provided credentials do not match our records.",
            ]);
        }
    }
}
