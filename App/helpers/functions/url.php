<?php
/**
 * 
 *  Url helper functions
 * 
 */
// Return page
function get_page( $file_path ){

    if( ! file_exists( PAGES . $file_path  ) ) {
       return;
    }
    require PAGES . $file_path;
}

// Return ouath page
function get_outh_page( $file_name, $outh = null ){

    if( ! file_exists( OUTH . $file_name  ) ) {
       return;
    }
    require OUTH . $file_name;
}

// Add active class
function is_page( string $page = null ){
    $url = parse_url( $_SERVER['PHP_SELF'] );
    $path = explode( '/' , $url['path'] );
    $current = end($path);
    $current = explode( '.' , $current );
    return $page === $current[0] ? true : false;
}

// Return home link
function homePage(){
    return URL;
}

// Redirect to someWhere
function redirect( $page = null ) {
    header( 'Location: '. URL . $page );
    exit();
}

// Return css file
function get_style( $file_path ) {
    if( ! file_exists( CSS . $file_path  ) ) {
       return;
    }
    return CSSURI . $file_path;
}

// Return js file
function get_script( $file_path ) {
    if( ! file_exists( JS . $file_path  ) ) {
       return;
    }
    return JSURI . $file_path;
}

// Return header template
function get_header($header){

    $header === 'front' ? 'front' : 'admin' ;
    if( ! file_exists( TEMPLS . $header .'/header.php' ) ) {
       return;
    }
    require TEMPLS . $header .'/header.php';
}


// Return header template
function get_footer($footer){
    
    $footer === 'front' ? 'front' : 'admin' ;
    if( ! file_exists( TEMPLS . $footer. '/footer.php' ) ) {
        return;
    }
    require TEMPLS . $footer. '/footer.php';
}

function get_auth_file($file_path){

    if( ! file_exists( TEMPLS . 'auth/' . $file_path. '.php' ) ) {
        return;
    }
    require TEMPLS . 'auth/' . $file_path. '.php';
}


// Return nav template
function get_nav(){
    if( ! file_exists( TEMPLS . 'nav.php' ) ) {
       return;
    }
    require TEMPLS . 'nav.php';
}

function get_img( $img ){

    if( ! file_exists( IMGS . $img ) ) {
       return;
    }
    return IMGSURI . $img;

}