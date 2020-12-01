<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enlink - Dashboard | Profile </title>

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="assets/images/logo/favicon.png"> -->

    <!-- vendors css -->
    <link href="<?php echo get_style( 'vendors/select2.css' ) ?>" rel="stylesheet">
    <link href="<?php echo get_style( 'vendors/dataTables.bootstrap.min.css' ) ?>" rel="stylesheet">
    
    <!-- Core css -->
    <link href="<?php echo get_style( 'dashboard.min.css' ) ?>" rel="stylesheet">
    <link href="<?php echo get_style( 'style.admin.css' ) ?>" rel="stylesheet">

</head>
<body>
    <div class="app">
        <div class="layout">
        
        <?php
            get_admin_file( 'nav' );
            get_admin_file( 'side_nav' );
            get_admin_file( 'starter' );
        ?>