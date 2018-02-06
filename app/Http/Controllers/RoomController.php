<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomController extends Controller
{
    public function getListRoom()
    {
        return Room::all();
     //    $rooms = Room::with('messages.user', 'user')->findOrFail(1);
     //    // $rooms = $rooms->with('messages');
    	// return $rooms;
    }

    public function getRoom($id)
    {
    	return Room::with('messages.user', 'user')->findOrFail($id);
    }

    public function getUserCreatedRoom($id) 
    {
    	return Room::findOrFail($id)->user;
    }

    public function getMessagesOfRoom($id) 
    {
    	return Room::findOrFail($id)->messages;
    }
}
