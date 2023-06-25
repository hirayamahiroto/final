<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;
use app\Models\Company;
use App\Models\Offer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(): View
    {
        $applications = Application::with("user", "offer")->get();
        $companies = Company::all();
        $offers = Offer::all();

        return view("company.application", [
            "applications" => $applications,
            "companies" => $companies,
            "offers" => $offers,
        ]);
    }

    public function delete(Request $request, Application $application)
    {
        $application->delete();
        return redirect("/company/application");
    }
}