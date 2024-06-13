<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Please enter your Email or Phone',
            'password.required' => 'Please enter your password',
        ]);

        if (auth()->attempt(['email' => $request->username, 'password' => $request->password]) || auth()->attempt(['phone' => $request->username, 'password' => $request->password])) {
            return redirect('/');
        } else {
            return redirect('/login')->with('error', 'Username or password is incorrect!');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
        ], [
            'name' => 'Please enter your name',
            'username.required' => 'Please enter your Email or Phone',
            'password.required' => 'Please enter your password',
            'password.confirmed' => 'Password does not match',
        ]);

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $request->merge(['email' => $request->username]);
            $request->validate([
                'email' => 'unique:users',
            ], [
                'email.unique' => 'Email already exists',
            ]);
        } else if (filter_var($request->username, FILTER_VALIDATE_INT)) {
            $request->merge(['phone' => $request->username]);
            $request->validate([
                'phone' => 'unique:users,phone',
            ], [
                'phone.unique' => 'Phone already exists'
            ]);
        } else {
            return redirect('/register')->with('error', 'Please enter a valid Email or Phone');
        }
        $user = User::create($request->all());
        auth()->login($user);
        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }

    public function profile(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(['user' => auth()->user()]);
        }
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Please enter your Name',
            'username.required' => 'Please enter your Email',
            'phone.required' => 'Please enter your Phone',
        ]);
        User::find(auth()->user()->id)->update($request->all());
        return redirect('/profile')->with('success', 'Profile updated successfully');
    }

    public function searchContact(Request $request)
    {
        $users = User::where('name', 'like', '%' . $request->search . '%')->orWhere('email', 'like', '%' . $request->search . '%')->orWhere('phone', 'like', '%' . $request->search . '%')->get();
        if ($request->ajax()) {
            return response()->json(['users' => $users], 200);
        }
    }

    public function addContact(Request $request)
    {
        $request->validate([
            'contact_id' => 'required',
        ], [
            'contact_id.required' => 'Please select a contact',
        ]);
        $validate_user = User::find($request->contact_id);
        if ($request->ajax()) {
            if ($validate_user) {
                $chat = Chat::join("chat_users", "chat_users.chat_id", "=", "chats.id")->where("chats.created_by", auth()->user()->id)->where("chat_users.user_id", $request->contact_id)->first();
                if ($chat) {
                    return response()->json(['message' => 'Contact already exists'], 409);
                }
                $chat = Chat::create([
                    'created_by' => auth()->user()->id,
                ]);
                ChatUser::create([
                    'chat_id' => $chat->id,
                    'user_id' => $validate_user->id,
                    'created_by' => auth()->user()->id,
                ]);
                return response()->json(['message' => 'Contact added successfully'], 200);
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }
        }
    }
}
