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

Route::redirect('/', '/new-ticket');
Route::get('/new-ticket', 'NewTicketController@index');
Route::post('/ticket-create', 'NewTicketController@form')->name('ticket.create');
Route::get('/ticket/{ticket}', 'TicketController@index')->name('ticket.index');

Route::middleware(['auth'])->group(function () {

    Route::post('/ticket/{ticket}', 'TicketController@comment')->name('ticket.comment');
    Route::post('/ticket/{ticket}/process', 'TicketController@process')->name('ticket.process');
    Route::get('/ticket/{ticket}/attachment', 'TicketController@attachment')->name('ticket.attachment');
    Route::get('/search/ticket', 'TicketController@search')->name('ticket.search');
    
    Route::resource('ticket-categories', 'TicketCategoriesController')->middleware('can:access-categories');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
