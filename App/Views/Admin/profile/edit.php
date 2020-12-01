<?php
/**
 * 
 * Edit User Portfolio
 * 
 */
// echo '<pre>';
// print_r( $_SESSION );
// echo '</pre>';
// die();
get_admin_file( "header" );
?>
<div class="container">

    <div class="col-md-6 mx-auto">
        <?php 
            flash('profile_actions');
        ?>
    </div>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">

    <div class="container">
        <input class="btn btn-primary btn-lg float-right mt-5" type="submit" name="settings" value="Save">
    </div>
    
    <div class="page-header no-gutters has-tab">
        
        <h2 class="font-weight-normal">Settings</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tab-account">Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-network">Network</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-notification">Notification</a>
            </li>
        </ul>
    </div>
    

    <div class="container">
        <div class="tab-content m-t-15">
            <div class="tab-pane fade show active" id="tab-account">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic Infomation</h4>
                    </div>
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="avatar avatar-image m-h-10 m-r-15" style="height: 80px; width: 80px;">
                                <img src="<?php echo URL; ?>public/assets/images/profile/<?php echo $_SESSION['profile_img']; ?>" alt="" />
                            </div>
                            <div class="m-l-20 m-r-20">
                                <h5 class="m-b-5 font-size-18">Change Avatar</h5>
                                <p class="opacity-07 font-size-13 m-b-0">
                                    Recommended Dimensions: <br />
                                    120x120 Max fil size: 5MB
                                </p>
                            </div>
                            <div>
                                <div class="form-group">
                                    <input type="file" name="uplaod_profile_img" class="btn btn-tone btn-primary">
                                    <!-- <button class="btn btn-tone btn-primary">Upload</button> -->
                                </div>
                            </div>
                        </div>
                        <hr class="m-v-25" />
                        <div class="profile-details">

                            <div class="form-group col-md-8">
                                <label class="font-weight-semibold" for="userName">User Name:</label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control <?php echo error_class( $data , 'name_err' ); ?>"
                                    id="userName"
                                    placeholder="e.g ahmed" 
                                    value="<?php echo AdminInputValue($data, 'name'); ?>" />
                                <div class="invalid-feedback"><?php echo error_msg( $data , 'name_err' );?></div>
                                <div class="valid-feedback"><?php echo success_msg( $data , 'name_success' );?></div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="font-weight-semibold" for="fullName">Full Name:</label>
                                <input
                                    type="text"
                                    name="full_name"
                                    class="form-control <?php echo error_class( $data , 'full_name_err' ); ?>"
                                    id="fullName"
                                    placeholder="e.g ahmed mostafa"
                                    value="<?php echo AdminInputValue( $data, 'full_name' ) ; ?>" />
                                <div class="invalid-feedback"><?php echo error_msg( $data , 'full_name_err' );?></div>
                                <div class="valid-feedback"><?php echo success_msg( $data , 'full_name_success' );?></div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="font-weight-semibold" for="email">Email:</label>
                                <input
                                type="email"
                                name="email"
                                class="form-control <?php echo error_class( $data , 'email_err' ); ?>"
                                id="email"
                                placeholder="e.g ahmed@marshallnich.com" 
                                value="<?php echo AdminInputValue( $data, 'email' ) ; ?>" />
                                <div class="invalid-feedback"><?php echo error_msg( $data , 'email_err' );?></div>
                                <div class="valid-feedback"><?php echo success_msg( $data , 'email_success' );?></div>
                            </div>

                            <div class="form-group col-md-8">
                                <label class="font-weight-semibold" for="bio">Bio:</label>
                                <textarea
                                    rows="6"
                                    name="bio"
                                    class="form-control <?php echo error_class( $data , 'bio_err' ); ?>"
                                    id="bio"
                                    placeholder="bio"><?php echo AdminInputValue( $data, 'bio' ) ; ?></textarea>
                                <div class="invalid-feedback"><?php echo error_msg( $data , 'bio_err' );?></div>
                                <div class="valid-feedback"><?php echo success_msg( $data , 'bio_success' );?></div>
                            </div>

                            <hr class="m-v-25" />

                            <div class="form-group col-md-8" id="dy_wrapper">
                                <label class="font-weight-semibold" for="email">Social Media:</label>
                                <input
                                    type="text"
                                    id="social_media"
                                    class="form-control"
                                    placeholder="e.g https://twitter.com"
                                    value="" />
                                <span class="err-msg"></span>
                                <button id="add_more" type="button" class="btn btn-tone btn-primary float-right mt-5">Add More!</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-network">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Network Integration</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush" id="network_wrapper">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-notification">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Notification Config</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-h-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-icon avatar-blue">
                                                    <i class="anticon anticon-user"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h5 class="font-weight-semibold m-b-0">Everyone can look me up</h5>
                                                    <p class="m-b-0 font-weight-normal">Allow people found on your public.</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="switch m-t-5 m-l-10">
                                                    <input type="checkbox" id="switch-config-1" checked />
                                                    <label for="switch-config-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-h-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-icon avatar-cyan">
                                                    <i class="anticon anticon-mobile"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h5 class="font-weight-semibold m-b-0">Everyone can contact me</h5>
                                                    <p class="m-b-0 font-weight-normal">Allow any peole to contact.</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="switch m-t-5 m-l-10">
                                                    <input type="checkbox" id="switch-config-2" checked />
                                                    <label for="switch-config-2"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-h-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-icon avatar-gold">
                                                    <i class="anticon anticon-environment"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h5 class="font-weight-semibold m-b-0">Show my location</h5>
                                                    <p class="m-b-0 font-weight-normal">Turning on Location lets you explore what's around you.</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="switch m-t-5 m-l-10">
                                                    <input type="checkbox" id="switch-config-3" />
                                                    <label for="switch-config-3"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-h-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-icon avatar-purple">
                                                    <i class="anticon anticon-mail"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h5 class="font-weight-semibold m-b-0">Email Notifications</h5>
                                                    <p class="m-b-0 font-weight-normal">Receive daily email notifications.</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="switch m-t-5 m-l-10">
                                                    <input type="checkbox" id="switch-config-4" checked />
                                                    <label for="switch-config-4"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-h-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-icon avatar-red">
                                                    <i class="anticon anticon-question"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h5 class="font-weight-semibold m-b-0">Unknow Source</h5>
                                                    <p class="m-b-0 font-weight-normal">Allow all downloads from unknow source.</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="switch m-t-5 m-l-10">
                                                    <input type="checkbox" id="switch-config-5" />
                                                    <label for="switch-config-5"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-h-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-icon avatar-green">
                                                    <i class="anticon anticon-swap"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h5 class="font-weight-semibold m-b-0">Data Synchronization</h5>
                                                    <p class="m-b-0 font-weight-normal">Allow data synchronize with cloud server.</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="switch m-t-5 m-l-10">
                                                    <input type="checkbox" id="switch-config-6" checked />
                                                    <label for="switch-config-6"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-h-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-icon avatar-orange">
                                                    <i class="anticon anticon-usergroup-add"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <h5 class="font-weight-semibold m-b-0">Groups Invitation</h5>
                                                    <p class="m-b-0 font-weight-normal">Allow any groups invitation</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="switch m-t-5 m-l-10">
                                                    <input type="checkbox" id="switch-config-7" checked />
                                                    <label for="switch-config-7"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
get_admin_file( "footer" );
