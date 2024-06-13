<!-- Contact staticBackdrop Modal example -->

<div class="modal fade" id="addContactModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="addContactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addContactModalLabel">Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <input type="text" name="keyword" id="search-contact" class="form-control"
                            placeholder="Search contact...">
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-primary" onclick="searchContact()">Search</button>
                    </div>
                </div>
                <hr>
                <div id="contact-list">
                    <div class="pb-3 h-100 overflow-auto">
                        <div class="chat-message-list" data-simplebar style="height: 100vh !important">
                            <div class="p-0 border-top">
                                <div>
                                    <ul class="list-unstyled chat-list">
                                        @php
                                            $users = \App\Models\User::where('id', '!=', Auth::user()->id)->get();
                                        @endphp
                                        @foreach ($users as $user)
                                            <li>
                                                <a href="#" onclick="addContact({{ $user->id }})">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0 me-3 align-self-center">
                                                            <div class="user-img online">
                                                                <div class="avatar-xs align-self-center">
                                                                    <span
                                                                        class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                                        {{ $user->name[0] }}
                                                                    </span>
                                                                </div>
                                                                <span class="user-status"></span>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="text-truncate font-size-14 mb-1">
                                                                {{ $user->name }}
                                                            </h5>
                                                            <p class="text-truncate text-body mb-0">
                                                                {{ $user->email }} | {{ $user->phone }}
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
            </div>
        </div>
    </div>
</div>

<script>
    function searchContact() {
        let keyword = $('#search-contact').val();
        $.ajax({
            url: "{{ route('search.contact') }}",
            type: "GET",
            data: {
                keyword: keyword
            },
            success: function(response) {
                console.log(response);
                // $('#contact-list').html(response);
            }
        });
    }

    function addContact(id) {
        $.ajax({
            url: "{{ route('add.contact') }}",
            type: "POST",
            data: {
                contact_id: id
            },
            success: function(response) {
                console.log(response);
                // $('#contact-list').html(response);
            }
        });
    }
</script>
