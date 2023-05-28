<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeatureController extends Controller
{
    public function index(Request $request): View
    {
        $features = Feature::all();
        $companies = Company::all();
        return view(
            "admin.feature",
            ["features" => $features],
            compact("companies")
        );
    }

    public function create(Request $request)
    {
        $name = $request->input("name");
        $offer_id = $request->input("offer_id");

        if (!empty($name) && !empty($offer_id)) {
            Feature::create([
                "name" => $name,
                "offer_id" => $offer_id,
            ]);

            return redirect()
                ->route("admin.feature")
                ->with("success", "業界を登録しました");
        } else {
            return redirect()
                ->back()
                ->with("error", "業界名を入力してください");
        }
    }
    public function destroy($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->delete();

        return redirect()
            ->route("admin.feature")
            ->with("success", "特徴を削除しました");
    }
}