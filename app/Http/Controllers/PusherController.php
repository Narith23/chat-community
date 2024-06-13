<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function auth(Request $request)
    {
        $socketId = $request->socket_id;
        $channelName = $request->channel_name;
        $userId = $request->user_id;

        $auth = new \Pusher\Pusher(
            config("broadcasting.connections.pusher.key"),
            config("broadcasting.connections.pusher.secret"),
            config("broadcasting.connections.pusher.app_id"),
            [
                'cluster' => config("broadcasting.connections.pusher.options.cluster"),
                'encrypted' => true
            ]
        );

        return $auth->socket_auth($channelName, $socketId, $userId);
    }

    public function message(Request $request)
    {
        broadcast(new \App\Events\PusherBroadcast($request->message))->toOthers();
        return response()->json($request->message);
    }

    public function receive(Request $request)
    {

    }
}
