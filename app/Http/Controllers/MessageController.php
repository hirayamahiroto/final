<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Offer;
use App\Models\Application;

use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // 求職者のチャット表示
    public function index(Request $request, int $applicationId)
    {
        $applications = Application::find($applicationId);
        $messages = Message::where("application_id", $applicationId)->get();

        return view("user.message", [
            "messages" => $messages,
            "application" => $applications,
        ]);
    }

    // 求職者のメッセー送信機能
    public function sendMessage(Request $request, int $applied_id)
    {
        $strMessage = $request->input("input_message");

        $offer = Offer::find($applied_id);

        $application = Application::find($applied_id);
        $message = new Message();
        $message->application_id = $applied_id;
        $message->content = $strMessage;
        $message->user_id = Auth::user();
        $message->sender = "user";

        $userId = $application->user_id;
        $applicationId = $applied_id;
        $sender = "user";

        $event = new MessageSent($message, $applicationId, $userId, $sender);
        event($event);

        // メッセージ送信後にリダイレクトする
        return redirect()->route("user.message", [
            "applied_id" => $applied_id,
        ]);
    }
    //企業側のチャット表示
    public function show(int $applied_id)
    {
        $applications = Application::find($applied_id);
        $messages = Message::where("application_id", $applied_id)->get();

        return view("company.message", [
            "messages" => $messages,
            "application" => $applications,
        ]);
    }
    //企業のメッセージ送信機能
    public function companySendMessage(Request $request, int $applied_id)
    {
        $strMessage = $request->input("input_message");

        $offer = Offer::find($applied_id);

        $application = Application::find($applied_id);
        $message = new Message();

        $message->sender = "company";
        $message->application_id = $applied_id;
        $message->content = $strMessage;
        $message->user_id = $application->user_id;
        $sender = "company";

        $applicationId = $applied_id;
        $userId = $application->user_id;
        $event = new MessageSent($message, $applicationId, $userId, $sender);
        event($event);

        // メッセージ送信後にリダイレクトする
        return redirect()->route("company.show", [
            "applied_id" => $applied_id,
        ]);
    }
}