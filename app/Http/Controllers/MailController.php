<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Offer;

class MailController extends Controller
{
    public function sendMail($offerId)
    {
        $offer = Offer::find($offerId);

        // dd($offer);
        $company = $offer->company;

        // 応募したユーザー
        $user = Auth::user();
        $userEmail = $user->email;

        // メール送信先の企業
        $companyEmail = $company->email;

        // メール送信
        Mail::send(
            "user.mail",
            [
                "name" => $user->name,
                "offer_name" => $offer->name,
                "offer_salary" => $offer->salary,
            ],
            function ($message) use ($userEmail, $companyEmail) {
                $message->to($companyEmail)->subject("受付完了：ご応募ありがとうございます。");
                $message->cc($userEmail);
            }
        );
        return redirect()->route("user.offer");
    }
}