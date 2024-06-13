<!-- Profile staticBackdrop Modal example -->
<div class="modal fade" id="profileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-xl-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="dropdown float-end">
                                        <a class="text-body dropdown-toggle font-size-18" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                            <i class="uil uil-ellipsis-v"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#"
                                                onclick="editProfile({{ auth()->user()->id }})">Edit</a>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Remove</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div>
                                        <img src="{{ URL::asset('/assets/images/users/avatar-10.png') }}"
                                            alt="" class="avatar-lg rounded-circle img-thumbnail">
                                    </div>
                                    <h5 class="mt-3 mb-1">{{ Auth::user()->name }}</h5>
                                    <p class="text-muted">UI/UX Designer</p>

                                    <div class="mt-4">
                                        <button type="button" class="btn btn-light btn-sm"><i
                                                class="uil uil-envelope-alt me-2"></i>
                                            Message</button>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="text-muted">
                                    <div class="table-responsive mt-4">
                                        <div>
                                            <p class="mb-1">Name :</p>
                                            <h5 class="font-size-16">{{ Auth::user()->name }}</h5>
                                        </div>
                                        <div class="mt-4">
                                            <p class="mb-1">Mobile :</p>
                                            <h5 class="font-size-16">{{ Auth::user()->phone ?? 'N/A' }}</h5>
                                        </div>
                                        <div class="mt-4">
                                            <p class="mb-1">E-mail :</p>
                                            <h5 class="font-size-16">{{ Auth::user()->email ?? 'N/A' }}</h5>
                                        </div>
                                        <div class="mt-4">
                                            <p class="mb-1">Location :</p>
                                            <h5 class="font-size-16">California, United States</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8" id="profile-options">
                        <div class="card mb-0">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#about" role="tab">
                                        <i class="uil uil-user-circle font-size-20"></i>
                                        <span class="d-none d-sm-block">About</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tasks" role="tab">
                                        <i class="uil uil-clipboard-notes font-size-20"></i>
                                        <span class="d-none d-sm-block">Tasks</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                                        <i class="uil uil-envelope-alt font-size-20"></i>
                                        <span class="d-none d-sm-block">Messages</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab content -->
                            <div class="tab-content p-4">
                                <div class="tab-pane active" id="about" role="tabpanel">
                                    <div>
                                        <h5 class="font-size-16 mb-3">About</h5>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tasks" role="tabpanel">
                                    <div>
                                        <h5 class="font-size-16 mb-3">Tasks</h5>
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages" role="tabpanel">
                                    <div>
                                        <h5 class="font-size-16 mb-3">Messages</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8 d-none" id="profile-details">
                        <div class="card mb-0">
                            <div class="card-body">
                                <form action="{{ route('update.profile') }}" method="POST">
                                    @csrf
                                    {{-- Name --}}
                                    <div class="mb-3 row">
                                        <label for="name" class="col-md-2 col-form-label">Name <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" value=""
                                                id="name" placeholder="Enter name" required name="name">
                                        </div>
                                    </div>
                                    {{-- Email --}}
                                    <div class="mb-3 row">
                                        <label for="email" class="col-md-2 col-form-label">Email <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="email" value=""
                                                id="email" placeholder="Enter email" required name="email">
                                        </div>
                                    </div>
                                    {{-- Phone --}}
                                    <div class="mb-3 row">
                                        <label for="phone" class="col-md-2 col-form-label">Phone <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" value=""
                                                id="phone" placeholder="Enter phone" required name="phone">
                                        </div>
                                    </div>
                                    {{-- Submit --}}
                                    <div class="d-flex flex-wrap gap-3 justify-content-end">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Submit</button>
                                        <button type="reset" class="btn btn-outline-danger waves-effect waves-light w-md">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function editProfile(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('profile') }}",
            data: "",
            dataType: "json",
            success: function (response) {
                console.log(response.user);
                $('#name').val(response.user.name);
                $('#email').val(response.user.email);
                $('#phone').val(response.user.phone);
            }
        });
        $('#profile-options').addClass('d-none');
        $('#profile-details').removeClass('d-none');
        // $("#profile-footer").removeClass('d-none');
    }

    function closeModal() {
        $('#profile-options').removeClass('d-none');
        $('#profile-details').addClass('d-none');
        // $("#profile-footer").addClass('d-none');
    }
</script>
