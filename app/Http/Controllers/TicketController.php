<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Mail;
use Auth;

class TicketController extends Controller
{
    protected $mailFrom;
    protected $mailTo;
    protected $category;

    public function index(Request $request, $hash)
    {
        $ticket = Ticket::where('hash', $hash)->first();
        if ($ticket->ticket_status == 1) {
            $ticket->ticket_status = 2;
            $ticket->save();
        }
        return view('ticket', ['ticket' => $ticket]);
    }
    public function process(Request $request, $hash)
    {
        $ticket = Ticket::where('hash', $hash)->first();
        $ticket->ticket_status = 3;
        $ticket->save();
        $this->Answered($hash);
        return back();
    }
    public function Answered($hash)
    {
        $ticket= Ticket::where('hash', $hash)->first();
        $this->category = $ticket->category->name;
        $hashLink = "http://127.0.0.1:8000/ticket/$hash";
        $message_Raw = "Мы ответили на ваш вопрос, можете посмотреть ответ на него здесь - $hashLink";
        $this->mailTo = $ticket->email;
        $this->mailFrom = "lifeinternchoco@gmail.com";
        Mail::raw($message_Raw, function ($message) {
            $message->from($this->mailFrom);
            $message->to($this->mailTo)->subject("Ответ на ваш $this->category");
        });
    }
}
