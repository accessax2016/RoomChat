<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Pusher;

class UserController extends Controller
{
    public function getCurrentUser() {
    	return Auth::user();
    }

    public function getUsersInChannel($room_id) {
    	$channel_name = 'presence-room.'.$room_id;
    	$url = '/channels/'.$channel_name;
    	$response = Pusher::get($url, array('info' => 'user_count'));
    	if( $response['status'] == 200 ) {
  			// convert to associative array for easier consumption
    		$result = json_decode( $response['body'], true );
    		return $result;
    	}
    }
}
