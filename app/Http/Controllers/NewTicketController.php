<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketCategory;
use App\Models\Ticket;
use Auth;
use Validator;
use Hash;
use App\MailSender;

class NewTicketController extends Controller
{
    public function index(Request $request)
    {
        $categories = TicketCategory::orderBy('id', 'desc')->get();
        return view('new-ticket', compact('categories'));
    }

    public function form(Request $request)
    {
        \Log::debug($request->input());

        $validator = Validator::make($request->all(), [
            'full-name' => 'required',
            'email' => 'email',
            'phone' => 'required',
            'category' => 'required',
            'description' => 'required',
            'attachment' => 'file|max:10240' // 10 mb
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $ticket = new Ticket;
        $ticket->full_name = $request->get('full-name');
        $ticket->email = $request->get('email');
        $ticket->phone_num = $request->get('phone');
        $ticket->description = $request->get('description');
        $ticket->ticket_category = $request->get('category');
        $ticket->ticket_status = 1;
        $mytime = date('Y-m-d H:i:s');
        $ticket->hash = md5($ticket->id . $mytime . $ticket->full_name . $ticket->email);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $file->store('attachments'); //  storage/app/attachments
            $file_name = $file->hashName();
            $ticket->file_path = $file_name;
        }
        $hash = $ticket->hash;
        $messageRaw = "Спасибо за обращение в службу технической поддержки ChocoLife. Можете отслеживать ваш запрос здесь:";

        $ticket->save();
        MailSender::send($messageRaw, $hash);
        return redirect()->route('ticket.index', ['hash' => $hash]);
    }
}
