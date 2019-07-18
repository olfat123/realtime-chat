<?php
use App\Events;
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

Route::get('/', function () {
  //  broadcast(new messagingWebsocketEvent('some data'));
    return view('welcome');
});

Route::get('/chats', 'chatsController@index');
Route::get('messages', 'chatsController@fetchMessages');
Route::post('messages', 'chatsController@sendMessage');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
