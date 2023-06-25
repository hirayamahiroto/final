<?php
use App\Http\Controllers\ProfileController;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Admin\ProfileController as ProfileOfAdminController;
use App\Http\Controllers\CompaniesController as CompaniesController;
use App\Http\Controllers\IndustryController as IndustryController;
use App\Http\Controllers\OfferController as offerController;
use App\Http\Controllers\FeatureController as FeatureController;
use App\Http\Controllers\ApplicationController as ApplicationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CompanyUserLoginController;
use App\Http\Controllers\MessageController as MessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your applicatio1n. These
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

Route::put("/company/offer/{offer_id}/update", [
    offerController::class,
    "offer_detail_update",
])
    ->name("company.offer_update")
    ->middleware("auth:company");
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

Route::prefix("user")
    ->name("user.")
    ->group(function () {
        Route::get("/dashboard", function () {
            return view("user.dashboard");
        })
            ->middleware(["auth:user", "verified"])
            ->name("dashboard");

        Route::middleware("auth:user")->group(function () {
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
        require __DIR__ . "/user.php";
    });

Route::get("/admin/companies", [CompaniesController::class, "index"])->name(
    "admin.companies"
);

//======================================================================
// 　　　　　　　　　　　　　　　　ADMIN
//======================================================================

//--------------- アカウント登録 -----------------
Route::post("/admin/companies", [CompaniesController::class, "create"]);
//--------------- アカウント情報更新 --------------
Route::group(["prefix" => "/admin/companies/{company}"], function () {
    Route::put("", [CompaniesController::class, "update"])->name(
        "companies.update"
    );
    Route::get("/edit", [CompaniesController::class, "edit"])->name(
        "companies.edit"
    );
});

//--------------- アカウント登録 -----------------
Route::post("/admin/companies", [CompaniesController::class, "create"]);

//--------------- アカウント情報更新 --------------
Route::group(["prefix" => "/admin/companies/{company}"], function () {
    Route::put("", [CompaniesController::class, "update"])->name(
        "companies.update"
    );
    Route::get("/edit", [CompaniesController::class, "edit"])->name(
        "companies.edit"
    );
    Route::delete("", [CompaniesController::class, "delete"])->name(
        "companies.delete"
    );
});

//--------------- 産業一覧表示 -----------------
Route::get("/admin/industry", [IndustryController::class, "index"])->name(
    "admin.industry"
);

//--------------- 産業分類追加 -----------------
Route::post("/admin/industry/create", [
    IndustryController::class,
    "create",
])->name("admin.industry.create");

//--------------- 産業分類削除 -----------------
Route::delete("/admin/industry/{industry}", [
    IndustryController::class,
    "destroy",
])->name("industry.destroy");

//--------------- 求人一覧表示 -----------------
Route::get("/admin/offer", [OfferController::class, "index"])->name(
    "admin.offer"
);

//--------------- 求人登録 -----------------
Route::group(["prefix" => "/admin/offer"], function () {
    Route::get("/register", [OfferController::class, "showRegisterForm"])->name(
        "admin.offer.register"
    );
    Route::get("/create", [OfferController::class, "create"])->name(
        "admin.offer.create"
    );
    Route::delete("/{offer}", [OfferController::class, "destroy"])->name(
        "admin.offer.destroy"
    );
});

//--------------- 特徴 -----------------
Route::group(["prefix" => "/admin/feature"], function () {
    Route::get("", [FeatureController::class, "index"])->name("admin.feature");
    Route::post("", [FeatureController::class, "create"])->name(
        "admin.feature.create"
    );
    Route::delete("/{id}", [FeatureController::class, "destroy"])->name(
        "admin.feature.destroy"
    );
});

//======================================================================
// 　　　　　　　　　　　　　　　　COMPANY
//======================================================================

Route::group(
    ["prefix" => "/company", "middleware" => "auth:company"],
    function () {
        Route::get("/offer", [OfferController::class, "offer_index"])->name(
            "company.offer"
        );
        Route::post("/offer", [OfferController::class, "offer_create"])->name(
            "company.offer.offer_create"
        );
        Route::get("/offer/{offer_id}", [
            OfferController::class,
            "show_offer_detail",
        ])->name("company.offer_detail");
        Route::delete("/offer/{offer}", [
            OfferController::class,
            "offer_destroy",
        ])->name("company.offer.offer_destroy");
        Route::get("/application", [
            ApplicationController::class,
            "index",
        ])->name("company.application");
        Route::delete("/application/{application}", [
            ApplicationController::class,
            "destroy",
        ])->name("company.application.destroy");
    }
);

Route::group(["middleware" => "auth:web"], function () {
    Route::get("/offer", [
        OfferController::class,
        "user_offerList_index",
    ])->name("user.offer");
    Route::post("/offer/{offer}/apply", [
        OfferController::class,
        "apply",
    ])->name("offer.apply");
});

Route::group(
    ["prefix" => "/company", "middleware" => "auth:company"],
    function () {
        Route::get("/message/{applied_id}", [
            MessageController::class,
            "show",
        ])->name("company.show");
        Route::post("/message/{applied_id}", [
            MessageController::class,
            "companySendMessage",
        ])->name("company.sendMessage");
        Route::get("/account_register", [
            CompaniesController::class,
            "account_register_View",
        ])->name("company_accountRegisterView");
        Route::post("/account_register", [
            CompaniesController::class,
            "account_register",
        ])->name("company_accountRegister");
    }
);

Route::group(["prefix" => "/company"], function () {
    Route::get("/user_login", [
        AuthenticatedSessionController::class,
        "user_create",
    ])->name("company.user_login");
    Route::post("/user_login", [
        AuthenticatedSessionController::class,
        "user_store",
    ])->name("company.user_login");
});

//======================================================================
// 　　　　　　　　　　　　　　　　　USER
//======================================================================

Route::group(["prefix" => "/message"], function () {
    Route::get("/{applied_id}", [MessageController::class, "index"])->name(
        "user.message"
    );
    Route::post("/{applied_id}", [
        MessageController::class,
        "sendMessage",
    ])->name("user.sendMessage");
});