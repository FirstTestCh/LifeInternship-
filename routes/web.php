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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::match(['get','post'], '/', 'NewTicketController@index');

Route::get('/file',function(Request $request){
    // return response()->download("index.php");
    // return Hash::make("asdf");
    return md5("md;alwkjef;lkawjef;lk5".time());
    // return response()->download(storage_path("app\\public\\file.txt"));

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
