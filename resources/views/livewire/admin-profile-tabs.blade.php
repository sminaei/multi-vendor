<div>
    <div class="profile-tab height-100-p">
        <div class="tab height-100-p">
            <ul class="nav nav-tabs customtab" role="tablist">
                <li class="nav-item">
                    <a wire:click.prevent='selectTab("personal_details")'
                       class="nav-link {{ $tab == 'personal_details' ? 'active' : '' }}"
                       data-toggle="tab"
                       href="#timeline"
                       role="tab"
                    >Personal Details</a>
                </li>
                <li class="nav-item">
                    <a wire:click.prevent='selectTab("update_password")'
                       class="nav-link" {{ $tab == 'update_password' ? 'active' : '' }}"
                    data-toggle="tab"
                    href="#tasks"
                    role="tab"
                    >Update Password</a>
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
                    class="tab-pane fade {{ $tab == 'personal_details' ? 'active show' : '' }}"
                    id="personal_details"
                    role="tabpanel"
                >
                    <div class="pd-20">
                        <form wire:submit.prevent="updateAdminProfileDetails()">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" wire:model="name"
                                               placeholder="enter full name">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" wire:model="email"
                                               placeholder="enter full name">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">UserName</label>
                                        <input type="text" class="form-control" wire:model="username"
                                               placeholder="enter full name">
                                        @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
                <!-- Timeline Tab End -->
                <!-- Tasks Tab start -->
                <div class="tab-pane fade {{ $tab == 'update_password' ? 'active show' : '' }}" id="tasks"
                     role="tabpanel">
                    <div class="pd-20 profile-task-wrap">
                        <form wire:submit.prevent="updatePassword()" action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Current Password</label>
                                        <input type="password" placeholder="enter current password" wire:mode.defer="current_password" class="form-control">
                                        @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">New Password</label>
                                        <input type="password" placeholder="enter New password" wire:mode.defer="new_password" class="form-control">
                                        @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Confirm New Password</label>
                                        <input type="password" placeholder="Retype New password" wire:mode.defer="new_password_confirmation" class="form-control">
                                        @error('new_password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Tasks Tab End -->
                <!-- Setting Tab start -->
                <div
                    class="tab-pane fade height-100-p"
                    id="setting"
                    role="tabpanel"
                >
                    <div class="profile-setting">
                        <form>
                            <ul class="profile-edit-list row">
                                <li class="weight-500 col-md-6">
                                    <h4 class="text-blue h5 mb-20">
                                        Edit Your Personal Setting
                                    </h4>
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="email"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Date of birth</label>
                                        <input
                                            class="form-control form-control-lg date-picker"
                                            type="text"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <div class="d-flex">
                                            <div
                                                class="custom-control custom-radio mb-5 mr-20"
                                            >
                                                <input
                                                    type="radio"
                                                    id="customRadio4"
                                                    name="customRadio"
                                                    class="custom-control-input"
                                                />
                                                <label
                                                    class="custom-control-label weight-400"
                                                    for="customRadio4"
                                                >Male</label
                                                >
                                            </div>
                                            <div
                                                class="custom-control custom-radio mb-5"
                                            >
                                                <input
                                                    type="radio"
                                                    id="customRadio5"
                                                    name="customRadio"
                                                    class="custom-control-input"
                                                />
                                                <label
                                                    class="custom-control-label weight-400"
                                                    for="customRadio5"
                                                >Female</label
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select
                                            class="selectpicker form-control form-control-lg"
                                            data-style="btn-outline-secondary btn-lg"
                                            title="Not Chosen"
                                        >
                                            <option>United States</option>
                                            <option>India</option>
                                            <option>United Kingdom</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>State/Province/Region</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Visa Card Number</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Paypal ID</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <div
                                            class="custom-control custom-checkbox mb-5"
                                        >
                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="customCheck1-1"
                                            />
                                            <label
                                                class="custom-control-label weight-400"
                                                for="customCheck1-1"
                                            >I agree to receive notification
                                                emails</label
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input
                                            type="submit"
                                            class="btn btn-primary"
                                            value="Update Information"
                                        />
                                    </div>
                                </li>
                                <li class="weight-500 col-md-6">
                                    <h4 class="text-blue h5 mb-20">
                                        Edit Social Media links
                                    </h4>
                                    <div class="form-group">
                                        <label>Facebook URL:</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                            placeholder="Paste your link here"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Twitter URL:</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                            placeholder="Paste your link here"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Linkedin URL:</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                            placeholder="Paste your link here"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Instagram URL:</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                            placeholder="Paste your link here"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Dribbble URL:</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                            placeholder="Paste your link here"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Dropbox URL:</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                            placeholder="Paste your link here"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Google-plus URL:</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                            placeholder="Paste your link here"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Pinterest URL:</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                            placeholder="Paste your link here"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Skype URL:</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                            placeholder="Paste your link here"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>Vine URL:</label>
                                        <input
                                            class="form-control form-control-lg"
                                            type="text"
                                            placeholder="Paste your link here"
                                        />
                                    </div>
                                    <div class="form-group mb-0">
                                        <input
                                            type="submit"
                                            class="btn btn-primary"
                                            value="Save & Update"
                                        />
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
                <!-- Setting Tab End -->
            </div>
        </div>
    </div>
</div>
