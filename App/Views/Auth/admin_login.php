<?php
/**
 * Login admin page
 */
// Get Header
get_auth_file( "header" );
?>
<div class="login-register-area pt-115 pb-120">
    <div class="container">
        <div class="d-flex full-height p-v-15 flex-column justify-content-between">
            <!-- Start Login -->
            <div class="container">
                <div class="row">
                    <div class="col-10 col-lg-6 mx-auto my-auto">
                        <div class="card mt-5">
                            <div class="card-body">
                                <h3 class="mb-4 font-weight-normal">Login as Author!</h3>
                            <?php UserNotExist( $data ); ?>
                            <?php flash( 'registerd_success' ); ?>
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
                                            auto-complete="user-email"
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
                                            auto-complete="user-password"
                                            class="form-control <?php echo error_class( $data , 'password_err' ); ?>" 
                                            id="password" 
                                            placeholder="Password">
                                        <div class="invalid-feedback"><?php echo error_msg( $data , 'password_err' ); ?></div>
                                        <div class="valid-feedback"><?php echo error_msg( $data , 'password_success' ); ?></div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between p-t-15">
                                            <span class="font-size-13 text-muted">
                                                <span>Don't have an account?</span>
                                                <a class="small" href="<?php echo URL; ?>front/auth/admin_register"> Signup</a>
                                            </span>
                                            <button type="submit" class="btn btn-success">Login</button>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a href="<?php echo URL .'front/auth/login'; ?>" class="btn btn-link">Login as a user</a>
                    </div>
                </div>
            </div>
            <!-- End Login -->
        </div>
    </div>
</div>
<?php
// Get Footer
get_auth_file( "footer" );