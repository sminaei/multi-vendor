<div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <a
                        href="modal"
                        data-toggle="modal"
                        data-target="#modal"
                        class="edit-avatar"
                    ><i class="fa fa-pencil"></i
                        ></a>
                    <img
                        src="vendors/images/photo1.jpg"
                        alt=""
                        class="avatar-photo"
                    />
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
                                            src="vendors/images/photo2.jpg"
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
                <h5 class="text-center h5 mb-0">Ross C. Lopez</h5>
                <p class="text-center text-muted font-14">
                    Lorem ipsum dolor sit amet
                </p>



            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    data-toggle="tab"
                                    href="#timeline"
                                    role="tab"
                                >Timeline</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#tasks"
                                    role="tab"
                                >Tasks</a
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
                                class="tab-pane fade show active"
                                id="personal_details"
                                role="tabpanel">
                                <div class="pd-20">
                                    ------profile details----------
                                </div>
                            </div>
                            <!-- Timeline Tab End -->
                            <!-- Tasks Tab start -->
                            <div class="tab-pane fade" id="update_password" role="tabpanel">
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
