<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketCategory;

class NewTicketController extends Controller
{
    public function index(Request $request){
        $categories = TicketCategory::all();
        // if($request->has('submit')){
            
        //     $request
        // }

        return view('new-ticket')->with('categories',$categories); 
    }
}
