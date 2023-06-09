<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    "defaults" => [
        "guard" => "web",
        "passwords" => "users",
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session"
    |
    */

    // 認証機能の提供
    "guards" => [
        // ユーザー側
        "web" => [
            "driver" => "session",
            "provider" => "users",
        ],

        // 管理者側
        "admin" => [
            // セッション情報を管理(クッキーなど)
            "driver" => "session",
            "provider" => "admins",
        ],
        // 企業側
        "company" => [
            // セッション情報を管理(クッキーなど)
            "driver" => "session",
            "provider" => "companies",
        ],

        "company_users" => [
            "driver" => "session",
            "provider" => "company_users",
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    // 認証の対象を指定
    "providers" => [
        "users" => [
            "driver" => "eloquent",
            "model" => App\Models\User::class,
        ],

        "admins" => [
            "driver" => "eloquent",
            "model" => App\Models\Admin::class,
        ],

        "companies" => [
            "driver" => "eloquent",
            "model" => App\Models\Company::class,
        ],

        "company_users" => [
            "driver" => "eloquent",
            "model" => App\Models\CompanyUser::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    "passwords" => [
        "users" => [
            "provider" => "users",
            "table" => "password_reset_tokens",
            "expire" => 60,
            "throttle" => 60,
        ],
        "admins" => [
            // 追加
            "provider" => "admins", // 追加
            "table" => "password_resets", // 追加
            "expire" => 60, // 追加
            "throttle" => 60, // 追加
        ],

        "companies" => [
            // 追加
            "provider" => "companies", // 追加
            "table" => "password_resets", // 追加
            "expire" => 60, // 追加
            "throttle" => 60, // 追加
        ],
        "company_users" => [
            // 追加
            "provider" => "company_users", // 追加
            "table" => "password_resets", // 追加
            "expire" => 60, // 追加
            "throttle" => 60, // 追加
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    "password_timeout" => 10800,
];
