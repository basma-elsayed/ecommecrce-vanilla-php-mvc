<?php
/**
 * ForgetPasswordp
 */
// Get Header
get_auth_file( 'header' );
?>
<!-- Start Registration -->
<div class="login-register-area pt-115 pb-120">
    <div class="container">
        <div class="d-flex full-height p-v-15 flex-column justify-content-between">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-5 mx-auto">
                        <div class="card card-body">
                            <h2>Forget Password</h2>
                            <p class="m-b-30">will send rest password link to your email</p>
                            <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="email">Email <sup class="text-danger">*</sup></label>
                                    <div class="input-affix">
                                        <i class="prefix-icon anticon anticon-user"></i>
                                        <input 
                                            type="email" 
                                            class="form-control form-control-lg" 
                                            id="email" 
                                            placeholder="Email" />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="font-size-13 text-muted">
                                            Don't have an account?
                                            <a class="small" href="<?php echo URL; ?>/front/auth/register"> Signup</a>
                                        </span>
                                        <button class="btn btn-success">Send Link</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_auth_file("footer");