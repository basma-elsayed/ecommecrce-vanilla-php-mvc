<?php
/**
 * Functions commenly used in front end
 */
use \Models\general;
$general_db = new general();


 /**
  * Require Front end file.
  */
 function get_front_file( $file_path , $data = null ) 
{
    if( ! file_exists( FRONT_TEMPLATES . $file_path . '.php'  ) ) {
       return;
    }
    require FRONT_TEMPLATES . $file_path . '.php';
}

 /**
  * Get Category count by ID.
  */
function getCount( $col, $table, $condition ){
    return \Models\general::getCount( $col, $table, $condition );
}

 /**
  * Get Sizes count.
  */
function GetSizes()
{
    $sizes = \Models\general::size();
    $total = [];
    foreach( $sizes as $size => $value ):
        $size_arr = unserialize( $value['size'] );
        $sizes_arr[] = $size_arr;
        foreach( $size_arr as $key => $value ):
            isset( $total[$value] ) ? $total[$value] += 1 : $total[$value] = 1;
        endforeach;
    endforeach;
    return $total;
}

/**
 * Get category name by ID
 * @param int Category ID
 */
function GetCatName( int $cat_id )
{
    global $general_db;
    $cat = $general_db->get( 'name', 'categories', 'WHERE id = '.$cat_id.' ', 'ASSOC', true );
    return $cat['name'];
}

