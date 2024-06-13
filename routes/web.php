<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

if (auth()->check()){
    return redirect("/");
} else {
    // Auth Login
    Route::get("/login", function () {
        return view("auth.login");
    })->name("login");
    Route::post("/login", [\App\Http\Controllers\UserController::class, "login"])->name("post.login");

    // Auth Register
    Route::get("/register", function () {
        return view("auth.register");
    })->name("register");
    Route::post("/register", [\App\Http\Controllers\UserController::class, "register"])->name("post.register");
}

Route::group(["middleware" => "auth"], function () {
    # Auth Logout
    Route::get("/logout", [\App\Http\Controllers\UserController::class, "logout"])->name("logout");
    # Chat
    Route::get("/chat", [\App\Http\Controllers\ChatController::class, "index"])->name("chat");
    # User Profile
    Route::get("/profile", [\App\Http\Controllers\UserController::class, "profile"])->name("profile");
    Route::post("/profile", [\App\Http\Controllers\UserController::class, "updateProfile"])->name("update.profile");
    # Search Contact
    Route::get("/search-contact", [\App\Http\Controllers\UserController::class, "searchContact"])->name("search.contact");
    # Add Contact
    Route::post("/add-contact", [\App\Http\Controllers\UserController::class, "addContact"])->name("add.contact");
    # Delete Contact
    Route::post("/delete-contact", [\App\Http\Controllers\UserController::class, "deleteContact"])->name("delete.contact");
    # Get Contacts
    Route::get("/get-contacts", [\App\Http\Controllers\UserController::class, "getContacts"])->name("get.contacts");
    # Open Chat
    Route::get("/open-chat", [\App\Http\Controllers\ChatController::class, "openChat"])->name("open.chat");
    # Send Message
    Route::post("/send-message", [\App\Http\Controllers\MessageController::class, "store"])->name("send.message");
    # Pusher
    Route::post("/pusher/auth", [\App\Http\Controllers\PusherController::class, "auth"])->name("pusher.auth");
    Route::post("/pusher/message", [\App\Http\Controllers\PusherController::class, "message"])->name("pusher.message");
    Route::post("/pusher/receive", [\App\Http\Controllers\PusherController::class, "receive"])->name("pusher.receive");
});
