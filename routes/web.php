<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // dd(database_path());
    return view('welcome');
});


Route::prefix("c")->name("c.")->group(function(){ 
    Route::post('send_message','ChatController@send_message')->name('send_message');
    Route::get('event_stream','ChatController@event_stream')->name('event_stream');
    Route::get('test','ChatController@test')->name('test');
    Route::post('get_history','ChatController@get_history')->name('get_history');
    Route::delete('deleteChatHistory','ChatController@deleteChatHistory')->name('deleteChatHistory');
    
});

Route::prefix("v")->name("v.")->group(function(){  
    Route::get('bot','ViewController@bot')->name('bot');
});
