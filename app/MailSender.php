<?php
namespace App;

use App\Models\Ticket;
use Mail;
use Auth;

class MailSender
{

    public static function send($messageRaw, $mailTo,$hash)
    {
        $ticket = Ticket::where('hash', $hash)->first();
        $hashLink = "http://127.0.0.1:8000/ticket/$hash";
        $category = $ticket->category->name;
        $mailFrom="lifeintern@mail.ru";
        Mail::raw($messageRaw, function ($message) use ($mailFrom, $mailTo,$category) {
            $message->from($mailFrom);
            $message->to($mailTo)->subject("Ответ на ваш $category");
        });
    }


}