<?php
/**
 * 
 * Config file
 * 
 */

// App Path
define( 'PATH', dirname( __DIR__) );

define( 'PUBLIC_PATH', dirname( __DIR__ , 2) . '/public' );

define( 'URL', 'http://localhost/ecomm-mvc/' );

define( 'FUNC', PATH . '/functions' . '/' );

define( 'TEMPLS', PATH . '/Views/templates/' );

define( 'PAGES', PATH . '/views' . '/' );

define( 'ADMIN', PAGES . 'admin/' );

define( 'OUTH', PAGES . 'outh/' );


// Assets
define( 'ASSEST', PUBLIC_PATH . '/' . 'assets/' );

define( 'CSS', ASSEST . 'css/' );

define( 'CSS_VENDORS', ASSEST . 'css/vendors/' );

define( 'JS', ASSEST . 'js/' );

define( 'JS_VENDORS', ASSEST . 'js/vendors/' );

define( 'IMGS', ASSEST . 'images/' );

// Assets URI
define( 'CSSURI', URL . 'public/assets/css/' );

define( 'CSS_VENDORS_URI', URL . 'public/assets/css/vendors' );

define( 'JSURI', URL . 'public/assets/js/' );

define( 'JS_VENDORS_URI', URL . 'public/assets/js/vendors/' );

define( 'IMGSURI', URL . 'public/assets/images/' );

define( 'FONTSURI', URL . 'public/fonts/' );


// Admin area
define( 'ADMIN_INC', ADMIN . 'inc/' );

define( 'ADMIN_SUBPAGES', ADMIN . 'subpages/' );

define( 'ADMIN_PRODUCTS', ADMIN . 'subpages/products/' );

// Views Dir
define( 'VIEWS', PATH . '/Views' );

// Templates Dir
define( 'TEMPLATES', PATH . '/Views/templates/' );

// Admin templates Dir
define( 'ADMIN_TEMPLATES', PATH . '/Views/templates/admin/' );

// Front templates Dir
define( 'FRONT_TEMPLATES', PATH . '/Views/templates/front/' );