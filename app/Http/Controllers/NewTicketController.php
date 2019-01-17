<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketCategory;
use App\Models\Ticket;

class NewTicketController extends Controller
{
    public function index(Request $request){
        \Log::debug($request->input());
        if($request->has('submit')){
            
            $request->validate([
                'full-name' => 'required',
                'email' => 'email',
                'phone' => 'required',
                'category' => 'required',
                'description' => 'required',
            ]);

            $ticket = new Ticket;
            $ticket->full_name = $request->get('full-name');
            $ticket->email = $request->get('email');
            $ticket->phone_num = $request->get('phone');
            $ticket->description = $request->get('description');
            $ticket->ticket_category = $request->get('category');
            $ticket->ticket_status = 1;    

            if($request->hasFile('attachment')){
                $file = $request->file('attachment');
                $file->store('attachments'); //  storage/app/attachments
                $file_name = $file->hashName();
                $ticket->file_path = $file_name;
            }

            $ticket->save();
            return view('ticket-created');
        }

        $data = [
            'categories' => TicketCategory::all(),
        ];

        return view('new-ticket',$data);

    }
}
