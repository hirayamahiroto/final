<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndustryController extends Controller
{
    public function index(Request $request): View
    {
        $industries = Industry::all();
        return view("admin.industry", ["industries" => $industries]);
    }

    public function create(Request $request)
    {
        $name = $request->input("name");

        Industry::create([
            "name" => $name,
        ]);

        return redirect()
            ->route("admin.industry")
            ->with("success", "業界を登録しました");
    }
    public function destroy(Industry $industry)
    {
        $industry->delete();

        return redirect()
            ->route("admin.industry")
            ->with("success", "業界を削除しました");
    }
}
