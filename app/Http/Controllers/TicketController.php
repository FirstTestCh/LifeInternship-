<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index(Request $request, $hash)
    {
        $ticket = Ticket::where('hash', $hash)->first();
        return view('ticket', ['ticket' => $ticket]);
    }

}
