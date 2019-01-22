<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Comment;
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
        if (Auth::user()->isAdmin() && $ticket->ticket_status == 1) {
            $ticket->ticket_status = 2;
            $ticket->save();
        }
        return view('ticket', ['ticket' => $ticket]);
    }

    public function my(Request $request)
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->get();
        return view('home', ['tickets' => $tickets]);
    }

    public function comment(Request $request, $hash)
    {
        $ticket = Ticket::where('hash', $hash)->first();

        $comment = new Comment;

        $comment->content = request('content');
        $comment->ticket_id = $ticket->id;
        $comment->user_id = Auth::check() ? Auth::user()->id : NULL;
        $comment->admin_only = request('admin_only') ? TRUE : FALSE;

        $comment->save();

        if ($comment->admin_only == FALSE) {
            $ticket->ticket_status = 4;
            $ticket->save();

            $this->Answered($hash);
        }

        return redirect('/ticket/'.$hash);
    }

    public function process(Request $request, $hash)
    {
        $ticket = Ticket::where('hash', $hash)->first();
        $ticket->ticket_status = 3;
        $ticket->admin_id = Auth::user()->id;
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
