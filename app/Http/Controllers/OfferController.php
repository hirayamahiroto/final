<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Offer;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfferController extends Controller
{
    public function index(Request $request): View
    {
        $offers = Offer::all();
        $companies = Company::all();

        return view("admin.offer", ["offers" => $offers], compact("companies"));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "salary" => "required",
            "company_id" => "required|integer",
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $name = $request->input("name");
        $salary = $request->input("salary");
        $company_id = $request->input("company_id");

        if (!empty($name) && !empty($salary) && !empty($company_id)) {
            Offer::create([
                "name" => $name,
                "salary" => $salary,
                "company_id" => $company_id,
            ]);

            return redirect()
                ->route("admin.offer")
                ->with("success", "業界を登録しました");
        } else {
            return redirect()
                ->back()
                ->with("error", "業界名を入力してください");
        }
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()
            ->route("admin.offer")
            ->with("success", "業界を削除しました");
    }

    // Company
    public function offer_index(Request $request): View
    {
        $userId = Auth::id();
        $offers = Offer::where("company_id", $userId)->get();
        $companies = Company::all();

        return view("company.offer", compact("offers", "companies"));
    }
    public function offer_create(Request $request)
    {
        $company_id = Auth::id();
        $name = $request->input("name");
        $salary = $request->input("salary");

        Offer::create([
            "name" => $name,
            "salary" => $salary,
            "company_id" => $company_id,
        ]);

        return redirect()
            ->route("company.offer")
            ->with("success", "業界を登録しました");
    }

    public function offer_destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()
            ->route("company.offer")
            ->with("success", "業界を削除しました");
    }
}
