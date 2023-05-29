<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "offer_id" => "nullable|integer",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $name = $request->input("name");
        $offerId = $request->input("offer_id");

        $featureData = [
            "name" => $name,
        ];

        if (!empty($offerId)) {
            $featureData["offer_id"] = $offerId;
        }

        Feature::create($featureData);

        return redirect()
            ->route("admin.feature")
            ->with("success", "特徴を登録しました");
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
