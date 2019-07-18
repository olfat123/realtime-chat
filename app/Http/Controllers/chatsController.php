<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\model\messaging;
use App\Events\MessageSent;

class chatsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('chats');
    }
    public function fetchMessages(){
        return messaging::with('user')->get();
    }
    public function sendMessage(Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();
        return ['status' => 'success'];
    }
}
