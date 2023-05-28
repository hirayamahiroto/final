<?php
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\ProfileController as ProfileOfAdminController;
use App\Http\Controllers\CompaniesController as CompaniesController;
use App\Http\Controllers\IndustryController as IndustryController;
use App\Http\Controllers\OfferController as offerController;
use App\Http\Controllers\FeatureController as FeatureController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", function () {
    return view("dashboard");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit"
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update"
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy"
    );
});

require __DIR__ . "/auth.php";
Route::prefix("admin")
    ->name("admin.")
    ->group(function () {
        Route::get("/dashboard", function () {
            return view("admin.dashboard");
        })
            ->middleware(["auth:admin", "verified"])
            ->name("dashboard");

        Route::middleware("auth:admin")->group(function () {
            Route::get("/profile", [
                ProfileOfAdminController::class,
                "edit",
            ])->name("profile.edit");
            Route::patch("/profile", [
                ProfileOfAdminController::class,
                "update",
            ])->name("profile.update");
            Route::delete("/profile", [
                ProfileOfAdminController::class,
                "destroy",
            ])->name("profile.destroy");
        });
        require __DIR__ . "/admin.php";
    });

Route::prefix("company")
    ->name("company.")
    ->group(function () {
        Route::get("/dashboard", function () {
            return view("company.dashboard");
        })
            ->middleware(["auth:company", "verified"])
            ->name("dashboard");

        Route::middleware("auth:company")->group(function () {
            Route::get("/profile", [ProfileController::class, "edit"])->name(
                "profile.edit"
            );
            Route::patch("/profile", [
                ProfileController::class,
                "update",
            ])->name("profile.update");
            Route::delete("/profile", [
                ProfileController::class,
                "destroy",
            ])->name("profile.destroy");
        });
        require __DIR__ . "/company.php";
    });

Route::get("/admin/companies", [CompaniesController::class, "index"])->name(
    "admin.companies"
);

// 新規追加
Route::post("/admin/companies", [CompaniesController::class, "create"]);

Route::put("/admin/companies/{company}", [
    CompaniesController::class,
    "update",
])->name("companies.update");

Route::get("/admin/companies/{company}/edit", [
    CompaniesController::class,
    "edit",
])->name("companies.edit");
// 削除
Route::delete("/admin/companies/{company}", [
    CompaniesController::class,
    "delete",
]);

Route::get("/admin/industry", [IndustryController::class, "index"])->name(
    "admin.industry"
);

// 新規追加
Route::post("/admin/industry/create", [
    IndustryController::class,
    "create",
])->name("admin.industry.create");
Route::delete("/admin/industry/{industry}", [
    IndustryController::class,
    "destroy",
])->name("industry.destroy");

Route::get("/admin/offer", [IndustryController::class, "index"])->name(
    "admin.offer"
);

// Offer
Route::get("/admin/offer", [offerController::class, "index"])->name(
    "admin.offer"
);

Route::get("/admin/offer/register", [
    OfferController::class,
    "showRegisterForm",
])->name("admin.offer.register");

Route::get("/admin/offer/create", [OfferController::class, "create"])->name(
    "admin.offer.create"
);
Route::delete("/admin/offer/{offer}", [
    offerController::class,
    "destroy",
])->name("admin.offer.destroy");

Route::get("/admin/offer", [offerController::class, "index"])->name(
    "admin.offer"
);

Route::get("/admin/feature", [FeatureController::class, "index"])->name(
    "admin.feature"
);

Route::post("/admin/feature", [FeatureController::class, "create"])->name(
    "admin.feature.create"
);

Route::delete("/admin/feature/{id}", [
    FeatureController::class,
    "destroy",
])->name("admin.feature.destroy");

Route::get("/company/offer", [offerController::class, "offer_index"])
    ->name("company.offer")
    ->middleware("auth:company");

Route::post("/company/offer", [offerController::class, "offer_create"])
    ->name("company.offer.offer_create")
    ->middleware("auth:company");

Route::delete("/company/offer/{offer}", [
    offerController::class,
    "offer_destroy",
])->name("company.offer.offer_destroy");
