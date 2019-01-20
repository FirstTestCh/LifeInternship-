<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $tickets = Ticket::all();
        $tickets = Ticket::with('status')->with('category')->orderBy('created_at','desc')->orderBy('ticket_status')->get();
        return view('home')->with('tickets',$tickets);
    }
}
