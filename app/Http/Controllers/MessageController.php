<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatEvent;
use App\Message;

class MessageController extends Controller
{
    public function postCreateMessage(Request $request)
    {
        $message = Message::create($request->all());
        $response = Message::with('user')->findOrFail($message->id);

        broadcast(new ChatEvent($response))->toOthers();

        return $response;
    }

    public function getUserCreatedMessage($id) 
    {
    	return Message::findOrFail($id)->user;
    }
}
