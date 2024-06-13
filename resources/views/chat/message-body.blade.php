@php
    $currentDate = '';
@endphp
@foreach ($messages as $key => $item)
    @php
        $messageDate = $item->created_at->format('Y-m-d');
        $showDateSeparator = $messageDate !== $currentDate;
        $currentDate = $messageDate;
    @endphp

    @if ($showDateSeparator)
        <li class="chat-day-title">
            <span class="title">{{ $item->created_at->format('l, F d, Y') }}</span>
        </li>
    @endif
    @if ($item->user_id != Auth::id())
        <li>
            <div class="conversation-list">
                <div class="ctext-wrap">
                    <div class="ctext-wrap-content">
                        <h5 class="font-size-14 conversation-name">
                            <a href="#" class="text-reset">{{ \App\Models\User::find($item->user_id)->name }}</a>
                            <span
                                class="d-inline-block font-size-12 text-muted ms-2">{{ $item->created_at->format('h:i A') }}</span>
                        </h5>
                        <p class="mb-0">{{ $item->content }}</p>
                    </div>
                    <div class="dropdown align-self-start">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="uil uil-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Copy</a>
                            <a class="dropdown-item" href="#">Save</a>
                            <a class="dropdown-item" href="#">Forward</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @else
        <li class="right">
            <div class="conversation-list">
                <div class="ctext-wrap">
                    <div class="ctext-wrap-content">
                        <h5 class="font-size-14 conversation-name">
                            <a href="#" class="text-reset">You</a>
                            <span
                                class="d-inline-block font-size-12 text-muted ms-2">{{ $item->created_at->format('h:i A') }}</span>
                        </h5>
                        <p class="mb-0">{{ $item->content }}</p>
                    </div>
                    <div class="dropdown align-self-start">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="uil uil-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Copy</a>
                            <a class="dropdown-item" href="#">Save</a>
                            <a class="dropdown-item" href="#">Forward</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endif
@endforeach
