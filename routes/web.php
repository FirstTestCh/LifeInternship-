<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/',function(Request $request){
        return redirect('/new-ticket');
    });
    Route::any('/new-ticket', 'NewTicketController@index');
    Route::post('/ticket-create', 'NewTicketController@form')->name('ticket.create');
    Route::get('/ticket/{hash}', 'TicketController@index')->name('ticket.index');
    Route::post('/ticket/{hash}/process', 'TicketController@process')->name('ticket.process');
    Route::resource('ticketCategories', 'TicketCategoriesController');    
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
