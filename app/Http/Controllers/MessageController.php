<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        broadcast(new \App\Events\PusherBroadcast($request->message))->toOthers();
        Message::create([
            "user_id" => auth()->user()->id,
            "content" => $request->message,
            "chat_id" => $request->chat_id
        ]);
        $chats = Chat::where('id', $request->chat_id)->first();
        $messages = Message::where("chat_id", $request->chat_id)->paginate(10);
        if ($request->ajax()) {
            return response()->json([
                'messages' => "success",
                'result' => view("chat.messages", compact("messages", "chats"))->render()
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
