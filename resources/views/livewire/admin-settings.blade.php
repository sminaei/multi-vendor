<div>
    <div class="tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a wire:click.prevent='selectTab("general_settings")'
                   class="nav-link {{ $tab == 'general_settings' ? 'active' : '' }} "
                    data-toggle="tab"
                    href="#general_settings"
                    role="tab"
                    aria-selected="true"
                >General Settings</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("logo_favicon")'
                   class="nav-link {{ $tab == 'logo_favicon' ? 'active' : '' }} "

                    data-toggle="tab"
                    href="#logo_favicon"
                    role="tab"
                    aria-selected="false"
                >Logo & FavIcon</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("social_networks")'
                   class="nav-link {{ $tab == 'social_networks' ? 'active' : '' }} "
                    data-toggle="tab"
                    href="#social_networks"
                    role="tab"
                    aria-selected="false"
                >Social networks</a>
            </li>
            <li class="nav-item">
                <a wire:click.prevent='selectTab("payment_methods")'
                   class="nav-link {{ $tab == 'payment_methods' ? 'active' : '' }} "

                    data-toggle="tab"
                    href="#payment_methods"
                    role="tab"
                    aria-selected="false"
                >Payment Method</a>
            </li>
        </ul>
        <div class="tab-content">
            <div
                class="tab-pane fade {{ $tab == 'general_settings' ? 'active show' : '' }}"
                id="general_settings"
                role="tabpanel"
            >
                <div class="pd-20">
                    <form wire:submit.prevent='updateGeneralSetting()'>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><b>Site name</b></label>
                            <input type="text" class="form-control" placeholder="enter site name"
                            wire:model.defer = "site_name">
                            @error('site_name')<span class="text-danger"> {{ $message }}</span> @enderror
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><b>Site email</b></label>
                            <input type="text" class="form-control" placeholder="enter site email"
                                   wire:model.defer = "site_email">
                            @error('site_name')<span class="text-danger"> {{ $message }}</span> @enderror
                        </div>
                    </div>

                </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site phone</b></label>
                                    <input type="text" class="form-control" placeholder="enter site phone"
                                           wire:model.defer = "site_phone">
                                    @error('site_phone')<span class="text-danger"> {{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b>Site meta keywords</b></label>
                                    <input type="text" class="form-control" placeholder="enter site meta keywords"
                                           wire:model.defer = "site_meta_keywords">
                                    @error('site_meta_keywords')<span class="text-danger"> {{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Site Address</label>
                            <input type="text" class="form-control" placeholder="enter your site address" wire:model.defer="site_address">
                            @error('site_address')<span class="text-danger"> {{ $message }}</span> @enderror

                        </div>
                        <div class="form-group">
                            <label for="">site meta description</label>
                            <textarea cols="4" rows="4" placeholder="site meta desc" class="form-control" wire:model.defer="site_meta_description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">save</button>
                    </form>
                    ------------general settings
                </div>
            </div>
            <div class="tab-pane fade {{ $tab == 'logo_favicon' ? 'active show' : '' }}" id="logo_favicon" role="tabpanel">
                <div class="pd-20">
                  <div class="row">
                      <div class="col-md-6">

                      </div>
                      <div class="col-md-6">
                        <h5>Site Logo</h5>
                          <div class="mb-2 mt-1" style="max-width: 200px">
                              <img wire:ignore src="" class="img-thumbnail" data-ijabo-default-img="/images/site/{{ $site_logo }}">
                          </div>
                          <form action="{{ route('admin.change-logo') }}" method="post" enctype="multipart/form-data" id="change_site_logo_form">
                              @csrf
                              <div class="mb-2">
                                  <input type="file" name="site_logo" class="form-control">
                                  <span class="text-danger error-text site_logo_error" id="site_logo_image_preview"></span>
                              </div>
                              <button type="submit" class="btn btn-primary">Change logo</button>
                          </form>
                      </div>
                      <h5>Site Favicon</h5>
                      <div class="mb-2 mt-1" style="max-width: 200px">
                          <img wire:ignore src="" id="site_favicon_image_preview" data-ijabo-default-img="/images/site/{{ $site_favicon }}">
                      </div>
                      <form action="{{ route('admin.change-favicon') }}" method="post" enctype="multipart/form-data" id="change_site_favicon_form">
                          @csrf
                          <div class="mb-2">
                              <input type="file" name="site_favicon" id="site_favicon" class="form-control">
                              <span class="text-danger error-text site_logo_error" id="site_favicon_error"></span>
                          </div>
                          <button type="submit" class="btn btn-primary">change favicon</button>
                      </form>
                  </div>
                </div>
            </div>
            <div class="tab-pane fade {{ $tab == 'social_networks' ? 'active show' : '' }}" id="social_networks" role="tabpanel">
                <div class="pd-20">
                   <form wire:submit.prevent="updateSocialNetworks">
                       <div class="row">
                           <div class="col-md-8">
                           <div class="form-group">
                               <label for=""><b>facebook url</b></label>
                               <input type="text" name="site_favicon" id="site_favicon" class="form-control" wire:model.defer="facebook_url">
                                @error('facebook_url') {{ $message }}  @enderror
                           </div>
                           </div>
                           <div class="col-md-8">
                               <div class="form-group">
                                   <label for=""><b>twitter url</b></label>
                                   <input type="text" name="site_favicon" id="site_favicon" class="form-control" wire:model.defer="twitter_url">
                                   @error('twitter_url') {{ $message }}  @enderror
                               </div>
                           </div>
                           <div class="col-md-8">
                               <div class="form-group">
                                   <label for=""><b>Instagram url</b></label>
                                   <input type="text" name="site_favicon" id="site_favicon" class="form-control" wire:model.defer="instagram_url">
                                   @error('instagram_url') {{ $message }}  @enderror
                               </div>
                           </div>
                           <div class="col-md-8">
                               <div class="form-group">
                                   <label for=""><b>youtube url</b></label>
                                   <input type="text" name="site_favicon" id="site_favicon" class="form-control" wire:model.defer="youtube_url">
                                   @error('youtube_url') {{ $message }}  @enderror
                               </div>
                           </div>
                           <div class="col-md-8">
                               <div class="form-group">
                                   <label for=""><b>github url</b></label>
                                   <input type="text" name="site_favicon" id="site_favicon" class="form-control" wire:model.defer="github_url">
                                   @error('github_url') {{ $message }}  @enderror
                               </div>
                           </div>
                           <div class="col-md-8">
                               <div class="form-group">
                                   <label for=""><b>linkedin url</b></label>
                                   <input type="text" name="site_favicon" id="site_favicon" class="form-control" wire:model.defer="linkedin_url">
                                   @error('linkedin_url') {{ $message }}  @enderror
                               </div>
                           </div>
                           <div class="form-group">
                               <button type="submit" class="btn btn-primary">save changes</button>
                           </div>
                       </div>
                   </form>
                </div>
            </div>
            <div class="tab-pane fade {{ $tab == 'payment_methods' ? 'active show' : '' }}" id="payment_methods" role="tabpanel">
                <div class="pd-20">
                    payment method
                </div>
            </div>
        </div>
    </div>
</div>
