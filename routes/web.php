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
Route::get('/ticket/{hash}', 'TicketController@index')->name('ticket.index');

Route::middleware(['auth'])->group(function () {

    Route::post('/ticket/{hash}', 'TicketController@comment')->name('ticket.comment');
    Route::post('/ticket/{hash}/process', 'TicketController@process')->name('ticket.process');
    Route::get('/ticket/{hash}/attachment', 'TicketController@attachment')->name('ticket.attachment');

    Route::resource('ticketCategories', 'TicketCategoriesController')->middleware('can:access-categories');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search/ticket', 'TicketController@search')->name('ticket.search');