<?php ob_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Norda - Minimal eCommerce HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png"> -->

    <!-- All CSS is here
	============================================ -->
    <link rel="stylesheet" href="<?php echo get_style( 'vendors/vendor.front.min.css') ?>">
    <link rel="stylesheet" href="<?php echo get_style( 'vendors/plugins.front.min.css') ?>">
    <link rel="stylesheet" href="<?php echo get_style( 'style.front.min.css') ?>">

</head>
<body>
    <div class="main-wrapper">
        
        <header class="header-area">

            <!-- Start header-large-device -->
            <div class="header-large-device">
                <?php get_front_file( "header/header-top" ); ?>
                <?php get_front_file( "header/header-middle" ); ?>
                <?php get_front_file( "header/header-bottom" ); ?>
            </div>
            <!-- End header-large-device -->

            <!-- Start header-small-device -->
            <div class="header-small-device small-device-ptb-1">
                <?php get_front_file( "header/header-small-device" ); ?>
            </div>
            <!-- End header-small-device -->
        </header>