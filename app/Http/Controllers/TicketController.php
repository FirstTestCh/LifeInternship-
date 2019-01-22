<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Mail;
use Auth;
use App\MailSender;

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
        return back();
    }
    public function answered($hash)
    {
        $ticket = Ticket::where('hash', $hash)->first();
        $ticket->ticket_status = 4;
    }
}
