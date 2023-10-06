<div>
<div class="profile-tab height-100-p">
									<div class="tab height-100-p">
										<ul class="nav nav-tabs customtab" role="tablist">
											<li class="nav-item">
												<a wire:click.prevent='selectTab("personal_details")' class="nav-link {{ $tab == 
                                                'personal_details' ? 'active' : '' }}" data-toggle="tab" href="#timeline" role="tab" aria-selected="true"
                                                >Personal details</details></a>
											</li>
											<li class="nav-item">
												<a wire:click.prevent='selectTab("update_password")' class="nav-link {{ $tab == 
                                                'update_password' ? 'active' : '' }}" data-toggle="tab" href="#update_password" role="tab" aria-selected="false">Update password</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#setting" role="tab" aria-selected="false">Settings</a>
											</li>
										</ul>
										<div class="tab-content">
											<!-- Timeline Tab start -->
											<div class="tab-pane fade {{ $tab == 'personal_details' ? 'active show' : '' }}"
                                             id="personal_details" role="tabpanel">
												<div class="pd-20">
													<form wire:submit.prevent='updateAdminPersonalDetails()'>
                                                        <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="">Name</label>
                                                                <input type="text" class="form-control" wire:model='name' placeholder="Enter Full Name">
                                                                @error('name')
                                                                    <span class="text-danger">{{ message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="">Email</label>
                                                                <input type="text" class="form-control" wire:model='email' placeholder="Enter email">
                                                                @error('email')
                                                                    <span class="text-danger">{{ message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="">Username</label>
                                                                <input type="text" class="form-control" wire:model='username' placeholder="Enter Username">
                                                                @error('username')
                                                                    <span class="text-danger">{{ message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>                   
                                                    </form>
												</div>
											</div>
											<!-- Timeline Tab End -->
											<!-- Tasks Tab start -->
											<div class="tab-pane fade {{ $tab == 'update_password' ? 'active show' : '' }}" id="update_password" role="tabpanel">
												<div class="pd-20 profile-task-wrap">
                                                <form  wire:submit.prevent='updatePassword()'>
                                                        <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="">Corrent password</label>
                                                                <input type="password" class="form-control"  placeholder="Enter Current password"
                                                                wire:model.defer='current_password'>
                                                                @error('current_password')
                                                                    <span class="text-danger">{{ message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="">New password</label>
                                                                <input type="password" class="form-control"  placeholder="Enter New password"
                                                                wire:model.defer='new_passwordn'>
                                                                @error('new_password')
                                                                    <span class="text-danger">{{ message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="">Confirm new password</label>
                                                                <input type="password" class="form-control"  placeholder="Retype New password"
                                                                wire:model.defer='new_password_confirmation'>
                                                                @error('new_password_confirmation')
                                                                    <span class="text-danger">{{ message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">update_password</button>                   
                                                    </form>
												</div>
											</div>
											<!-- Tasks Tab End -->
											
										</div>
									</div>
								</div>
</div>
