<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketCategory;
use App\Models\Ticket;
use Validator;
use Hash;
class NewTicketController extends Controller
{
    public function index(Request $request){
        $data = [
            'categories' => TicketCategory::all(),
        ];
        return view('new-ticket',$data);
    }

    public function form(Request $request){
        \Log::debug($request->input());
        
        $validator = Validator::make($request->all(), [
            'full-name' => 'required',
            'email' => 'email',
            'phone' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/')
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
        $ticket->hash=md5($ticket->id.$ticket->full_name.$ticket->email);

        if($request->hasFile('attachment')){
            $file = $request->file('attachment');
            $file->store('attachments'); //  storage/app/attachments
            $file_name = $file->hashName();
            $ticket->file_path = $file_name;
        }

        $ticket->save();
        $hash=$ticket->description.$ticket->email;
        
        return view('ticket-created');
    }
}
