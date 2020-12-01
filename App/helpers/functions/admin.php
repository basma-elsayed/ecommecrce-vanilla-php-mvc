<?php
/**
 * 
 * Functions used mostly in admin area
 * 
 */
use Core\Config;
/**
 * 
 * Store scripts src to add into footer
 * takes scripts src and store into $GLOBALS var
 * inject into the page after loading
 * @param array regular array 
 */
function store_footer_scripts( array $footer_scripts ){
    $GLOBALS['footerScripts'] = $footer_scripts;
}

/**
 * Loop through $GLOBALS['footerScripts']
 * inject script tag into the page after loading
 */
function add_to_admin_footer(){

    $scripts = $GLOBALS['footerScripts'];
    $body = '';
    foreach( $scripts as $src ){
        $body .= '<script src="'.get_script( "vendors/$src" ).'"></script>';
    }
    echo $body;
}

/**
 * 
 * Store Styles src to add into head
 * takes Styles src and store into $GLOBALS var
 * inject into the page after loading
 * @param array regular array 
 */
function store_head_styles( array $head_styles ){
    $GLOBALS['headStyles'] = $head_styles;
}

/**
 * Loop through $GLOBALS['footerScripts']
 * inject script tag into the page after loading
 */
function add_to_admin_head(){
    $styles = $GLOBALS['headStyles'];
    $body = '';
    foreach( $styles as $href ){
        $body .= '<link rel="stylesheet" href="'.get_style( "vendors/$href" ).'"></link>';
    }
    echo $body;
}


// Require admin file From Inc folder
function get_admin_file( $file_path ) 
{
    if( ! file_exists( ADMIN_TEMPLATES . $file_path . '.php'  ) ) {
       return;
    }
    require ADMIN_TEMPLATES . $file_path . '.php';
}

// Check if current folder is exist in admin
function is_dir_exist( $name )
{
    $dir = ADMIN_SUBPAGES . $name;
    if( ! is_dir( $dir ) ) {
        return false;
    }
    return true;
}

/**
 * Profile input value
 */
function AdminInputValue($data, $key)
{
    return $_SERVER['REQUEST_METHOD'] === 'POST' ? GetInputValue( $data, $key ) : $_SESSION[$key];
}
