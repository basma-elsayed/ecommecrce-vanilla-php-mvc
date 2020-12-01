<?php
/**
 * 
 * Register new user
 */
// Get Header
get_auth_file( 'header' );
?>
<!-- Start Registration -->
<div class="login-register-area pt-115 pb-120">
    <div class="container">
        <div class="d-flex full-height p-v-15 flex-column justify-content-between">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class=""><?php flash( 'registerd_falid' ); ?></div>
                        <div class="card">
                            <div class="card-body">
                                <h2 class="m-t-20">Sign In</h2>
                                <p class="m-b-30">Enter your credential to get access</p>
                                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="name">Name:</label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            value="<?php echo GetInputValue( $data, 'name' ) ; ?>" 
                                            class="form-control <?php echo error_class( $data , 'name_err' ); ?>" 
                                            id="name" placeholder="Username">
                                            
                                        <div class="invalid-feedback"><?php echo error_msg( $data , 'name_err' );?></div>
                                        <div class="valid-feedback"><?php echo error_msg( $data , 'name_success' );?></div>
                                    
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="email">Email:</label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            value="<?php echo GetInputValue( $data, 'email' ) ; ?>" 
                                            id="email" 
                                            class="form-control <?php echo error_class( $data , 'email_err' ); ?>" 
                                            placeholder="Email">
                                        <div class="invalid-feedback"><?php echo error_msg( $data , 'email_err' ); ?></div>
                                        <div class="valid-feedback"><?php echo error_msg( $data , 'email_success' );?></div>
                                    
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="password">Password:</label>
                                        <input 
                                            type="password" 
                                            name="password" 
                                            value="<?php echo GetInputValue( $data, 'password' ) ; ?>" 
                                            class="form-control <?php echo error_class( $data , 'password_err' ); ?>" 
                                            id="password" 
                                            placeholder="Password">
                                        <div class="invalid-feedback"><?php echo error_msg( $data , 'password_err' ); ?></div>
                                        <div class="valid-feedback"><?php echo error_msg( $data , 'password_success' ); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="confirm_password">Confirm Password:</label>
                                        <input 
                                            type="password" 
                                            name="confirm_password" 
                                            value="<?php echo GetInputValue( $data, 'confirm_password' ) ; ?>" 
                                            class="form-control <?php echo error_class( $data , 'confirm_password_err' ); ?>" 
                                            id="confirm_password" 
                                            placeholder="Confirm Password">
                                        <div class="invalid-feedback"><?php echo error_msg( $data , 'confirm_password_err' ); ?></div>
                                        <div class="valid-feedback"><?php echo error_msg( $data , 'confirm_password_success' ); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between p-t-15">
                                            <span class="font-size-13 text-muted">
                                                Already have an account? 
                                                <a class="small" href="<?php echo URL; ?>front/auth/login"> Signup</a>
                                            </span>
                                            <button type="submit" class="btn btn-success">Sign In</button>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="offset-md-1 col-md-6 d-none d-md-block">
                        <img class="img-fluid" src='<?php echo get_img( 'login-2.png' ); ?>' alt="Company presneter" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Registration -->
<?php
// Get Footer
get_auth_file( 'footer' );