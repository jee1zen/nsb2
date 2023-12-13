<div id="jointHoldersDiv">
    <hr />
    @php
        $count = 0;
    @endphp
    <div id="dynamic_container">
        @foreach ($account->jointHolders()->get() as $jointHolder)
            @php

                $count = $count + 1;
            @endphp

            <div class="row gutters-sm">
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-title">
                            <h2>Joint Holder {{ $count }}</h2>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center ">
                                <img src="{{ asset('storage/uploads/' . $jointHolder->pro_pic) }}" alt="profile-picture"
                                    class="img-fluid" width="100">
                                <div class="mt-3">
                                    <h4>{{ $jointHolder->title }}
                                        {{ $jointHolder->name_by_initials }} </h4>
                                    <p class="mb-1">{{ $jointHolder->name }} <br>
                                        {{ $jointHolder->address_line_1 }} <br>
                                        {{ $jointHolder->address_line_2 }} <br>
                                        {{ $jointHolder->address_line_3 }}</p>

                                    <button class="btn btn-danger">Remove</button>
                                    <button class="btn btn-outline-danger">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="mb-0">NIC / Passport</h6>
                                </div>
                                <div class="col-sm-7">
                                    {{ $jointHolder->nic }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="mb-0">Date of Birth</h6>
                                </div>
                                <div class="col-sm-7">
                                    {{ $jointHolder->dob }}
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="mb-0">Nationality</h6>
                                </div>
                                <div class="col-sm-7">
                                    {{ $jointHolder->nationality }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-7">
                                    {{ $jointHolder->user->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-7">
                                    {{ $jointHolder->mobile }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="mb-0">Land Phone</h6>
                                </div>
                                <div class="col-sm-7">
                                    {{ $jointHolder->telephone }}
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-7">
                                    {{ $jointHolder->mobile }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="mb-0">Land Phone</h6>
                                </div>
                                <div class="col-sm-7">
                                    {{ $jointHolder->telephone }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="mb-0">Nic Front</h6>
                                </div>
                                <div class="col-sm-7">
                                    <img id="joint_passport_preview"
                                        src="{{ asset('storage/uploads/' . $jointHolder->nic_front) }}"
                                        class="img_preview" />
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="mb-0">Nic Back</h6>
                                </div>
                                <div class="col-sm-7">
                                    <img id="joint_passport_preview"
                                        src="{{ asset('storage/uploads/' . $jointHolder->nic_back) }}"
                                        class="img_preview" />
                                </div>
                            </div>
                            <hr>
                            @if (isset($jointHolder->passport))
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h6 class="mb-0">Passport</h6>
                                    </div>
                                    <div class="col-sm-7">
                                        <img id="joint_passport_preview"
                                            src="{{ asset('storage/uploads/' . $jointHolder->passport) }}"
                                            class="img_preview" />
                                    </div>
                                </div>
                                <hr>
                            @endif
                            <div class="row">
                                <div class="col-sm-5">
                                    <h6 class="mb-0">Signature</h6>
                                </div>
                                <div class="col-sm-7">
                                    <img id="joint_passport_preview"
                                        src="{{ asset('storage/uploads/' . $jointHolder->signature) }}"
                                        class="img_preview" />
                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
