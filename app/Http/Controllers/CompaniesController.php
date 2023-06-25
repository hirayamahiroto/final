<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;

use App\Models\Feature;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Hash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

    public function offer_index(Request $request): View
    {
        $userId = Auth::id();
        $companies = Company::with("appliedOffers")->get();
        $features = Feature::all(); // 特徴のデータを取得

        return view("company.offer", compact("companies", "features"));
    }

    public function appliedOffers()
    {
        return $this->hasManyThrough(
            Offer::class,
            User::class,
            "company_id",
            "id",
            "id",
            "id"
        )->withTimestamps();
    }

    public function account_register_View(Request $request)
    {
        // ログインしている企業のIDを取得
        $companyId = Auth::id();
        // Companiesテーブルから企業情報を取得
        $company = Company::find($companyId);

        // ログインしている企業に紐づくcompany_userを取得
        $companyUsers = CompanyUser::where("company_id", $companyId)->get();

        return view(
            "company.account_register",
            compact("company", "companyUsers")
        );
    }

    public function account_register(Request $request)
    {
        // ログインしている企業のIDを取得
        $companyId = Auth::id();
        // Companiesテーブルから企業情報を取得
        $company = Company::find($companyId);

        // ログインしている企業に紐づくcompany_userを取得
        $companyUsers = CompanyUser::where("company_id", $companyId)->get();

        $validatedData = $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
        ]);

        // 重複チェック
        $existingUser = CompanyUser::where(
            "email",
            $validatedData["email"]
        )->first();
        if ($existingUser) {
            // 重複するメールアドレスが存在する場合の処理
            $errorMessage =
                "入力されたメールアドレスは既に使用されています。別のメールアドレスを入力してください。";
            Session::flash("warning", $errorMessage);
            return redirect()
                ->back()
                ->withInput();
        }

        $companyUser = new CompanyUser();
        $companyUser->name = $validatedData["name"];
        $companyUser->password = Hash::make($validatedData["password"]); // パスワードをハッシュ化
        $companyUser->email = $validatedData["email"];
        $companyUser->company_id = Auth::id(); // ログインしている企業のIDを使用
        $companyUser->save();

        return view(
            "company.account_register",
            compact("company", "companyUsers", "companyUser")
        );
    }
}
