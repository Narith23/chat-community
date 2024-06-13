<div class="card h-100" style="overflow: hidden">
    <div class="p-3 px-lg-4 border-bottom">
        <div class="row">
            <div class="col-md-4 col-6">
                <h5 class="font-size-16 mb-1 text-truncate">
                    <a href="#" class="text-reset">
                        @php
                            $chatUsers = \App\Models\Chat::join(
                                'chat_users',
                                'chat_users.chat_id',
                                '=',
                                'chats.id',
                            )
                                ->where('chats.id', $chats->id)
                                ->select('chats.id', 'chats.name', 'chats.created_by', 'chat_users.user_id')
                                ->first();
                        @endphp
                        @if ($chatUsers->user_id == Auth::user()->id)
                            {{ \App\Models\User::find($chatUsers->created_by)->name }}
                        @else
                            {{ \App\Models\User::find($chatUsers->user_id)->name }}
                        @endif
                    </a>
                </h5>
                <p class="text-muted text-truncate mb-0">
                    Available
                </p>
            </div>
            <div class="col-md-8 col-6">
                <ul class="list-inline user-chat-nav text-end mb-0">
                    <li class="list-inline-item">
                        <div class="dropdown">
                            <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="uil uil-search"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                                <form class="p-2">
                                    <div>
                                        <input type="text" class="form-control rounded"
                                            placeholder="Search..." />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>

                    <li class="list-inline-item">
                        <div class="dropdown">
                            <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="uil uil-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Archive</a>
                                <a class="dropdown-item" href="#">Muted</a>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div>
        <div class="chat-conversation py-3">
            <ul class="list-unstyled mb-0 chat-conversation-message px-3" data-simplebar
                style="height: calc(135vh - 417px)">
                {{-- <li class="chat-day-title">
                    <div class="title">Today</div>
                </li> --}}
                @include('chat.message-body')
            </ul>
        </div>
    </div>

    <div class="p-3 chat-input-section" style="position: absolute; bottom: 0; width: 100%">
        <div class="row">
            <div class="col">
                <div class="position-relative">
                    <input id="chat-input" type="text" class="form-control chat-input rounded"
                        placeholder="Enter Message..." />
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light"
                    id="edit-event-btn" onclick="editEvent({{ $chats->id }})">
                    <span class="d-none d-sm-inline-block me-2">Send</span>
                    <i class="mdi mdi-send float-end"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function editEvent(chatID) {
        const message = $('#chat-input').val();
        if (message) {
            $.ajax({
                type: "POST",
                url: "/send-message",
                data: {
                    chat_id: chatID,
                    message: message
                },
                dataType: "json",
                success: function(response) {
                    $('#chat-input').val('');
                    $("#chat-content").html(response.result);
                }
            }).done(function(response) {
                console.log(response);
            });
        }
    }
</script>


