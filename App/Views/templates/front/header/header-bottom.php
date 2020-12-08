<?php ob_start(); ?>
<!-- Start header-bottom -->
<div class="header-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-5">
                <div class="logo">
                    <a href="index.html"><img src="<?php echo get_img('logo.png'); ?>" alt="logo" /></a>
                </div>
            </div>

            <!-- Start Navigation -->
            <div class="col-lg-7">
                <div class="navbar-right main-menu main-menu-padding-1 main-menu-font-size-14 main-menu-lh-2">
                    <nav class="float-right">
                        <ul>
                            <li>
                                <a href="index.html">HOME </a>
                            </li>
                            <li>
                                <a href="shop.html">SHOP </a>
                            </li>
                            <li>
                                <a href="blog.html">BLOG </a>
                            </li>
                            <li><a href="contact.html">CONTACT </a></li>
                            <?php if( isset( $_SESSION['id'] ) ): ?>
                            <li><a href="<?php echo URL .'front/auth/logout' ?>">Logout</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo URL .'front/auth/login' ?>">Login</a></li>
                            <li><a href="<?php echo URL .'front/auth/register' ?>">singup</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- End Navigation -->
        </div>
    </div>
</div>
<!-- End header-bottom -->