<div id="jointHoldersDiv">
    <hr />
    @php
        $count = 0;
    @endphp
    <div class="col-md-12">
        @foreach ($account->jointHolders()->get() as $jointHolder)
            @php

                $count = $count + 1;
            @endphp

            <div class="row gutters-sm">
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-title">
                            <h4>Joint Holder {{ $count }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center ">
                                <img src="{{ asset('storage/uploads/' . $jointHolder->pro_pic) }}" alt="profile-picture"
                                    class="img-fluid" style="max-width: 50px">
                                <div class="mt-3">
                                    <h6>{{ $jointHolder->title }}
                                        {{ $jointHolder->name_by_initials }} </h6>
                                    <p class="mb-1">{{ $jointHolder->name }} <br>
                                        {{ $jointHolder->address_line_1 }},
                                        {{ $jointHolder->address_line_2 }} <br>
                                        {{ $jointHolder->address_line_3 }}</p>
                                        <input type="hidden" class="joint_name" value="{{$jointHolder->name}}">   
                                    <input type="hidden" class="joint_id" value="{{$jointHolder->id}}">   
                                    <button  class="btn btn-danger btnJointRemove" type="submit">Remove</button>
                                    <button class="btn btn-outline-danger btnJointEdit" id="btnJointEdit-{{$jointHolder->id}}"   >Edit</button>
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
                                    <img id="joint_passport_view"
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
                                    <img id="joint_passport_view"
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
                                        <img id="joint_passport_view"
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
                                    <img id="joint_passport_view"
                                        src="{{ asset('storage/uploads/' . $jointHolder->signature) }}"
                                        class="img_preview" />
                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>
                </div>

            </div>
            <!-- Modal New User as Joint Holder -->

            {{-- <section class="vh-100" style="background-color: #f4f5f7;">
                <div class="container py-5 h-100">
                  <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-12 mb-4 mb-lg-0">
                      <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                          <div class="col-md-4 gradient-custom text-center text-white"
                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <img src="{{ asset('storage/uploads/' . $jointHolder->pro_pic) }}"
                              alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                            <h5>{{$jointHolder->name}}</h5>
                            <p>{{$jointHolder->name_by_initials}}</p>
                            <i class="far fa-edit mb-5"></i>
                          </div>
                          <div class="col-md-8">
                            <div class="card-body p-4">
                              <h6>Information</h6>
                              <hr class="mt-0 mb-4">
                              <div class="row pt-1">
                                <div class="col-6 mb-3">
                                  <h6>Email</h6>
                                  <p class="text-muted">{{$jointHolder->user->email}}</p>
                                </div>
                                <div class="col-6 mb-3">
                                  <h6>Phone</h6>
                                  <p class="text-muted">{{$jointHolder->mobile}}</p>
                                </div>
                              </div>
                              <h6>Projects</h6>
                              <hr class="mt-0 mb-4">
                              <div class="row pt-1">
                                <div class="col-6 mb-3">
                                  <h6>Recent</h6>
                                  <p class="text-muted">Lorem ipsum</p>
                                </div>
                                <div class="col-6 mb-3">
                                  <h6>Most Viewed</h6>
                                  <p class="text-muted">Dolor sit amet</p>
                                </div>
                              </div>
                              <div class="d-flex justify-content-start">
                                <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section> --}}

            <hr>
        @endforeach
    </div>
</div>
