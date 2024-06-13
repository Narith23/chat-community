@extends('layouts.master-without-nav')
@section('title')
    Chat App
@endsection

@section('content')
    <div class="d-lg-flex mb-4" style="height: 100vh; overflow: hidden">
        <div class="chat-leftsidebar card" style="height: 100vh !important">
            <div class="p-3 px-4">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3 align-self-center">
                        <img src="{{ URL::asset('../assets/images/users/avatar-9.png') }}" class="avatar-xs rounded-circle"
                            alt="" />
                    </div>

                    <div class="flex-grow-1">
                        <h5 class="font-size-16 mb-1">
                            <a href="#" class="text-reset">{{ Auth::user()->name }}
                                <i class="mdi mdi-circle text-success align-middle font-size-10 ms-1"></i></a>
                        </h5>
                        <p class="text-muted mb-0">Available</p>
                    </div>

                    <div class="flex-shrink-0">
                        <div class="dropdown chat-noti-dropdown">
                            <button class="btn dropdown-toggle py-0" type="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="uil uil-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#profileModal">Profile</a>
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Add Contact</a>
                                <a class="dropdown-item" href="#">Setting</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="search-box chat-search-box">
                    <div class="position-relative">
                        <input type="text" class="form-control bg-light border-light rounded" placeholder="Search..." />
                        <i class="uil uil-search search-icon"></i>
                    </div>
                </div>
            </div>

            <div class="pb-3 h-100 overflow-auto">
                <div class="chat-message-list" data-simplebar style="height: 100vh !important">
                    <div class="p-4 border-top">
                        <div>
                            <div class="float-end">
                                <a href="javascript:void(0);" class="text-primary"><i class="mdi mdi-plus"></i> New
                                    Group</a>
                            </div>
                            <h5 class="font-size-16 mb-3">
                                <i class="uil uil-users-alt me-1"></i> Groups
                            </h5>

                            <ul class="list-unstyled chat-list group-list">
                                {{-- <li>
                                    <a href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                        G
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14 mb-0">General</h5>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                        <i class="uil uil-edit-alt"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14 mb-0">Designers</h5>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                        <i class="uil uil-users-alt"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14 mb-0">Meeting</h5>
                                            </div>
                                        </div>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>

                    <div class="p-4 border-top">
                        <div>
                            <div class="float-end">
                                <a href="" class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#addContactModal"><i class="mdi mdi-plus"></i> New
                                    Contact</a>
                            </div>
                            <h5 class="font-size-16 mb-3">
                                <i class="uil uil-user me-1"></i> Contacts
                            </h5>

                            <ul class="list-unstyled chat-list">
                                @php
                                    $chatUsers = \App\Models\Chat::join(
                                        'chat_users',
                                        'chat_users.chat_id',
                                        '=',
                                        'chats.id',
                                    )
                                        ->where('chat_users.user_id', Auth::user()->id)
                                        ->orWhere('chats.created_by', Auth::user()->id)
                                        ->select('chats.id', 'chats.name', 'chats.created_by', 'chat_users.user_id')
                                        ->get();
                                @endphp
                                @foreach ($chatUsers as $item)
                                    <li>
                                        <a onclick="openChat({{ $item->id }})" style="cursor: pointer">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-shrink-0 me-3 align-self-center">
                                                    <div class="user-img online">
                                                        <div class="avatar-xs align-self-center">
                                                            <span
                                                                class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                                @if ($item->user_id == Auth::user()->id)
                                                                    {{ \App\Models\User::find($item->created_by)->name[0] }}
                                                                @else
                                                                    {{ \App\Models\User::find($item->user_id)->name[0] }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <span class="user-status"></span>
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">
                                                        @if ($item->created_by == Auth::user()->id)
                                                            {{ \App\Models\User::find($item->user_id)->name }}
                                                        @else
                                                            {{ \App\Models\User::find($item->created_by)->name }}
                                                        @endif
                                                    </h5>
                                                    <p class="text-truncate mb-0">
                                                        @php
                                                            $messages = \App\Models\Message::where('chat_id', $item->id)
                                                                ->orderBy('id', 'desc')
                                                                ->take(1)
                                                                ->first();
                                                        @endphp
                                                        @if ($messages != null && $messages->user_id == Auth::user()->id)
                                                            You: {{ $messages->content }}
                                                        @elseif ($messages != null && $messages->user_id != Auth::user()->id)
                                                            {{ \App\Models\User::find($messages->user_id)->name }}:
                                                            {{ $messages->content }}
                                                        @endif
                                                    </p>
                                                </div>

                                                <div class="flex-shrink-0">
                                                    <div class="font-size-11">02 min</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end chat-leftsidebar -->

        <div class="w-100 user-chat mt-4 mt-sm-0 ms-lg-1" id="chat-content">

        </div>
    </div>
    @include('auth.profile')
    @include('chat.contact')
@endsection

@section('script-bottom')
    <script>
        $(document).ready(function() {
            var hash = window.location.hash;
            if (hash) {
                hash = hash.replace('#', '');
                if (hash) {
                    console.log(hash);
                }
            }
        })

        function openChat(chat_id) {
            $.ajax({
                type: "GET",
                url: "/open-chat",
                data: {
                    chat_id: chat_id
                },
                dataType: "json",
                success: function(response) {
                    $("#chat-content").html(response.result);
                }
            });
        }
    </script>
@endsection
