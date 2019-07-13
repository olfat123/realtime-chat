<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        auth()->user()->messages()->create([
            'message' => $request->message
        ]);

        return ['status' => 'success'];
    }
}
