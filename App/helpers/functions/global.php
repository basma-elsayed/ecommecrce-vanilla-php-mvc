<?php
/**
 * 
 * Global Functions
 * 
 */
/**
 * 
 * Check if input empty
 * @return ## empty     is-invalid
 * @return ## !empty    is-valid
 */
// Check if input is empty or not
// function ValidateInputClass( $var )
// {
//     if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
//         return isset( $var ) ? 'is-invalid' : 'is-valid' ;
//     }
// }

// function ValidateInput( string $input, string $success_msg, string $err_msg )
// {
//     if( empty( $data[$input] ) ){
//         return $data[$input .'_err'] = $err_msg;
//     }else{
//         // return $data[$input.'_success'] = $success_msg;
//         return $$input = true;
//     }
// }

function validateUser() 
{
    if( ! isset( $_SESSION['id'] ) ) redirect('front/auth/logout');
}

function GetInputValue( $data, $input ){
    return isset( $data[$input] ) ? $data[$input] : '' ;
}


/**
 * form submitted && $data array has $error_handel =>
 * Return Validate class [ is-invalid => wrong post value, is-valid => right post value ]
 * @param array $data conatins all inputs values && error && success msg
 * @param string $error_handel the name of array item which has the err msg
 * @example $data['name_err']
 */
function error_class( array $data , string $error_handel ) 
{
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        return isset( $data[$error_handel] ) ? 'is-invalid' : 'is-valid' ;
    }

    return '';
}

/**
 * Inputs Error msg
 * Return error msg if input is empty or post wrong value
 * @param array $data conatins all inputs values && error && success msg
 * @param string $error_handel the name of array item which has the err msg
 * @example $data['name_err']
 */
function error_msg( array $data , string $error_handel )
{
    if( isset( $data[$error_handel] ) ) return $data[$error_handel];
}

/**
 * Inputs Success msg
 * Return Success msg if input is post value as wanted
 * @param array $data conatins all inputs values && errors && successes msgs
 * @param string $success_handel the name of array item which has the success msg
 * @example $data['name_success']
 */
function success_msg( array $data , string $success_handel, $msg = 'looks good' )
{
    // return isset( $data[$success_handel] ) ? $data[$success_handel] : $msg;
    return isset( $data[$success_handel] ) ? $data[$success_handel] : $msg;
    // if (isset( $data[$success_handel] ) ) return $data[$success_handel];
}

/**
 * Content excerpt
 * @param string
 * @param characters count
 */
function excerpt( string $content, int $position = 30 )
{
    
    if( strlen($content) < $position ) return $content . '...';

    // Position to break down the words
    $breakPos = strpos( $content, ' ', $position );

    // the content excerpt
    $excerpt = substr( $content, 0, $breakPos );

    return $excerpt . '...';
}


/**
 * 
 * Return user not exists error
 * 
 */
function UserNotExist( array $data )
{
    if( isset( $data['user_not_exist'] ) ) {
        echo '<div class="alert alert-danger">';
        echo $data['user_not_exist'];
        echo '<a href="?v=forget_pass.php" class="alert-link">, Register now!</a>';
        echo '</div>';
    }
}

// Create Flash msg
function flash( $flash_name = '' , $msg = '' , $class = '' ){

    if( ! empty($flash_name) && ! empty($msg) && ! empty($class) ) {
        // Create Flash msg
        $_SESSION[$flash_name] = $msg;
        $_SESSION[$flash_name . '_class'] = $class;
        
    }
    elseif( isset($_SESSION[$flash_name]) && empty($msg) ){
        // Print the flash msg
        echo '<div class="text-center my-2 alert alert-'.$_SESSION[$flash_name . '_class'].'">'.$_SESSION[$flash_name].'</div>';
        // Delete the session msg
        unset($_SESSION[$flash_name]);
        unset($_SESSION[$flash_name . '_class']);
    }

}
