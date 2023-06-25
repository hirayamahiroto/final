<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\MessageSent;
use App\Models\Message;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if (request()->is("admin/*")) {
            config(["session.cookie" => config("session.cookie_admin")]);
        }

        if (request()->is("user/*")) {
            config(["session.cookie" => config("session.cookie_user")]);
        }

        if (request()->is("company/*")) {
            config(["session.cookie" => config("session.cookie_company")]);
        }

        Event::listen(MessageSent::class, function (MessageSent $event) {
            $message = new Message();
            $message->content = $event->message->content; // メッセージのコンテンツを代入
            $message->application_id = $event->applicationId;
            $message->user_id = $event->userId; // 追加: ユーザーIDを代入
            $message->sender = $event->sender; // 追加: ユーザーIDを代入
            $message->save();
        });
    }
}
