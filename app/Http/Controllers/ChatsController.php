<?php

namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat.index');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
//        $message = auth()->user()->messages()->create([
//            'message' => $request->message
//        ]);
        $message = new Message;
        $message->message = $request->message;
        $message->user_id = auth()->user()->id;
        $message->save();

        broadcast(new MessageSentEvent($message->load('user')))->toOthers();
        return ['status'=>'success'];
    }

}
