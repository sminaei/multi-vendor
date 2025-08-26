<div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <a
                        href="javascript:;" onclick="event.preventDefault();document.getElementById(sellerProfilePictureFile)"
                        class="edit-avatar" id="sellerProfilePicture"
                    ><i class="fa fa-pencil"></i
                        ></a>
                    <img
                        src="{{ $seller->picture }}"
                        alt=""
                        class="avatar-photo"/>
                    <input type="file" name="sellerProfilePictureFile" id="sellerProfilePictureFile"
                    class="d-none">
                    <div
                        class="modal fade"
                        id="modal"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="modalLabel"
                        aria-hidden="true"
                    >
                        <div
                            class="modal-dialog modal-dialog-centered"
                            role="document"
                        >
                            <div class="modal-content">
                                <div class="modal-body pd-5">
                                    <div class="img-container">
                                        <img
                                            id="image"
                                            src="{{  $seller->picture }}"
                                            alt="Picture"
                                        />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input
                                        type="submit"
                                        value="Update"
                                        class="btn btn-primary"
                                    />
                                    <button
                                        type="button"
                                        class="btn btn-default"
                                        data-dismiss="modal"
                                    >
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="text-center h5 mb-0">{{ $seller->name }}</h5>
                <p class="text-center text-muted font-14">
                   {{ $seller->email }}}
                </p>

            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a wire:click.prevent = 'selectTab("personal_details")'
                                    class="nav-link {{ $tab == 'personal_details' ? 'active' : ''}}"
                                    data-toggle="tab"
                                    href="#timeline"
                                    role="tab">Personal details</a>
                            </li>
                            <li class="nav-item">
                                <a wire:click.prevent = 'selectTab("update_password")'
                                    class="nav-link {{ $tab == 'update_password' ? 'active' : ''}}"
                                    data-toggle="tab"
                                    href="#tasks"
                                    role="tab"
                                >update password</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#setting"
                                    role="tab"
                                >Settings</a
                                >
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Timeline Tab start -->
                            <div
                                class="tab-pane fade {{ $tab == 'personal_details' ? 'active' : '' }}"
                                id="personal_details"
                                role="tabpanel">
                                <div class="pd-20">
                                    <form wire:submit.prevent = 'updateSellerPersonalDetails()'>
                                       <div class="row">
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label>Full Name</label>
                                                   <input type="text" class="form-control" wire:model.live = 'name'>
                                                   @error('name')
                                                   <span class="text-danger">{{ $message }}</span>
                                                   @enderror
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label>Email</label>
                                                   <input type="text" class="form-control" wire:model.live = 'email' disabled>
                                                   @error('email')
                                                   <span class="text-danger">{{ $message }}</span>
                                                   @enderror
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label>Username</label>
                                                   <input type="text" class="form-control" wire:model.live = 'username' disabled>
                                                   @error('username')
                                                   <span class="text-danger">{{ $message }}</span>
                                                   @enderror
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label>Phone</label>
                                                   <input type="text" class="form-control" wire:model.live = 'phone' disabled>
                                                   @error('phone')
                                                   <span class="text-danger">{{ $message }}</span>
                                                   @enderror
                                               </div>
                                           </div>
                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label>Address</label>
                                                   <input type="text" class="form-control" wire:model.live = 'address' disabled>
                                                   @error('address')
                                                   <span class="text-danger">{{ $message }}</span>
                                                   @enderror
                                               </div>
                                           </div>

                                           </div>
                                  <button type="submit" class="btn btn-primary">Save</button>
                                    </form>

                            </div>
                            <!-- Timeline Tab End -->
                            <!-- Tasks Tab start -->
                            <div class="tab-pane fade {{ $tab == 'update_password' ? 'active show' : '' }}" id="update_password" role="tabpanel">
                                <div class="pd-20 profile-task-wrap">
                                    --------update password-------
                                </div>
                            </div>
                            <!-- Tasks Tab End -->
                            <!-- Setting Tab start -->

                            <!-- Setting Tab End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
