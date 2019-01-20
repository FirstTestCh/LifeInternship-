<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Mail;
use Auth;

class TicketController extends Controller
{
    protected $ticket;
    protected $mailFrom;
    protected $mailTo;
    protected $category;

    public function index(Request $request, $hash)
    {
        $this->ticket = Ticket::where('hash', $hash)->first();
        if ($this->ticket->ticket_status == 1) {
            $this->ticket->ticket_status = 2;
            $this->ticket->save();
        }
        return view('ticket', ['ticket' => $this->ticket]);
    }
    public function process(Request $request, $hash)
    {
        $this->ticket->ticket_status = 3;
        $this->ticket->save();
        return back();
    }
    public function Answered()
    {
        $this->category = $this->ticket->category->name;
        $hashLink = "http://127.0.0.1:8000/ticket/{$this->ticket->hash}";
        $message_Raw = "Мы ответили на ваш вопрос, можете посмотреть ответ на него здесь - $hashLink";
        $this->mailTo = $this->ticket->email;
        $this->mailFrom = Auth::user()->email;
        Mail::raw($message_Raw, function ($message) {
            $message->from($this->mailFrom);
            $message->to($this->mailTo)->subject("Ответ на ваш $this->category");
        });
    }
}
