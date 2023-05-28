<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    //Admin
    public function index(): View
    {
        $companies = Company::all();

        return view("admin.companies", ["companies" => $companies]);
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "human_name" => "required",
        ]);

        Company::create([
            "name" => $validatedData["name"],
            "email" => $validatedData["email"],
            "password" => $validatedData["password"],
            "human_name" => $validatedData["human_name"],
        ]);

        return view("admin.companies_register");
    }
    public function edit(Company $company): View
    {
        return view("admin.edit", ["company" => $company]);
    }

    public function update(Request $request, Company $company)
    {
        $company->update([
            "name" => $request->name,
            "email" => $request->email,
            "human_name" => $request->human_name,
            "password" => $request->password,
        ]);

        return redirect("/admin/companies");
    }

    public function delete(Request $request, Company $company)
    {
        $company->delete();

        return redirect("/admin/companies");
    }
}
