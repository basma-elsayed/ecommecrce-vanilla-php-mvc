<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Norda - Dashboard | Profile </title>

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="assets/images/logo/favicon.png"> -->

    <!-- Core css -->

        <!-- All CSS is here
	============================================ -->
    <link rel="stylesheet" href="<?php echo get_style( 'vendors/vendor.front.min.css') ?>">
    <link rel="stylesheet" href="<?php echo get_style( 'vendors/plugins.front.min.css') ?>">
    <link href="<?php echo get_style( 'dashboard.min.css' ) ?>" rel="stylesheet">
    <link href="<?php echo get_style( 'style.admin.css' ) ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_style( 'style.front.min.css') ?>">


</head>
<body>
    <div class="app">
        <div class="layout main-wrapper">

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
        <!-- Start breadcrumb -->
        <div class="breadcrumbs">
            <?php get_front_file("shop/breadcrumb") ?>
        </div>
        <!-- End breadcrumb -->