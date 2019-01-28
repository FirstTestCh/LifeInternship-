<?php

namespace App\Http\Controllers;

use App\Models\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = TicketCategory::orderBy('id', 'desc')->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => 'required'
        ]);

        TicketCategory::create($attributes);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TicketCategory $ticketCategory)
    {
        return view('categories.show', compact('ticketCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TicketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketCategory $ticketCategory)
    {
        $attributes = request()->validate([
            'name' => 'required'
        ]);

        $ticketCategory->update($attributes);

        return redirect('/ticketCategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketCategory $ticketCategory)
    {
        $ticketCategory->delete();

        return redirect('/ticketCategories');
    }
}
