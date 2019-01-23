<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketStatus;
use App\Models\Comment;
use Mail;
use Auth;
use App\MailSender;

class TicketController extends Controller
{

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
        $ticketCategories = TicketCategory::all();
        $ticketStatuses = TicketStatus::all();

        return view('home', [
            'tickets' => $tickets,
            'categories' => $ticketCategories,
            'statuses' => $ticketStatuses
        ]);
    }

    public function search(Request $request)
    {
        $ticketCategories = TicketCategory::all();
        $ticketStatuses = TicketStatus::all();

        $tickets = Ticket::query();

        if ($request->filled('category')) {
            $tickets->where('ticket_category', $request->get('category'));
        }

        if ($request->filled('status')) {
            $tickets->where('ticket_status', $request->get('status'));
        }

        if ($request->filled('query')) {
            $tickets->where(function($query) use($request) {
                $query->where('full_name', 'like', '%'.$request->get('query').'%')
                ->orWhere('email', 'like', '%'.$request->get('query').'%')
                ->orWhere('phone_num', 'like', '%'.$request->get('query').'%')
                ->orWhere('description', 'like', '%'.$request->get('query').'%');
            });
        }

        $tickets = $tickets->orderBy('created_at','desc')->orderBy('ticket_status')->get();

        $request->flash();

        return view('home', [
            'tickets' => $tickets,
            'categories' => $ticketCategories,
            'statuses' => $ticketStatuses
        ]);
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
        return back();
    }

    public function Answered($hash)
    {
        $ticket = Ticket::where('hash', $hash)->first();
        $ticket->ticket_status = 4;
    }

    public function attachment($hash){
        $ticket = Ticket::where('hash', $hash)->first();
        $file_path = storage_path().'/app/attachments/'.$ticket->file_path;
        if( !file_exists($file_path) ){
            abort(404); // не должен случиться, но кто знает...
        }
        return response()->file($file_path);
    }
}
