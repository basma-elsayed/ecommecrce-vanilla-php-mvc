<?php
/**
 * 
 * User Profile
 * [ CRUD Operations ]
 */
namespace Controllers\Admin;
use \Models\user;
class Profile extends \Core\Controller
{
    public $user_db;

    public function __construct()
    {
        validateUser();
        $this->user_db = new user();
    }

    public function edit(){

        // init array data
        $data = [];

        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
            
            // Sanitize data
            $_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );
            
            // Collect all data into one array
            $data = [
                'name' => trim( $_POST['name'] ),
                'full_name' => trim($_POST['full_name']),
                'email' => trim($_POST['email']),
                'bio' => trim($_POST['bio']),
            ];

            /**
             * Validate only the field that has changed
             * 1- Compare POST values to $_SESSION values
             * 2- Store chaged keys and values into $diff array
             * 3- Validate the field(s) which user has changed and update it 
             * 4- Valiadate Image
             */
            
            // [ 1 , 2 ] Compare && Store
            $diff = array_diff( $data, $_SESSION );
            
            // 3- validate the field(s) which user has changed
            $errors = 0;

            // Validate user profile img
            $uplaod_profile_img = $_FILES['uplaod_profile_img'];

            $exts = [ 'jpeg', 'jpg', 'png' ];
            $img_ext;
            $user_profile_img_name;
            if( $uplaod_profile_img['error'] === 0 ){

                // image exists
                $image_path = PUBLIC_PATH . '/assets/images/profile/'. $_SESSION['profile_img'];
                // Delete img if exists
                if( file_exists($image_path) && $_SESSION['profile_img'] !== 'user_profile_blank.jpg' ){
                    unlink($image_path);
                }

                // validate exts
                $img_name = explode( ".", strtolower( $uplaod_profile_img['name'] ));
                $img_ext = end($img_name);

                if( ! in_array( $img_ext ,  $exts ) ){
                    $data['image_err'] = 'Not allowed image extention, Please upload extions like [ jpeg, jpg, png ]';
                    $errors++;
                }

                // validate size
                if( $uplaod_profile_img['size'] > ( 1024*1024*4 ) ){
                    $data['image_err'] = 'Image size too big, Plaes upload image under 4MB';
                    $errors++;
                }

                $user_profile_img_name = $_SESSION['id'] .'_'. $_SESSION['name'] . '.' . $img_ext;
                $diff['profile_img'] = $user_profile_img_name;
                $data['profile_img'] = $user_profile_img_name;
                
                
            }
            // Optional Fields
            $optional = [ 'profile_img' ];            

            $updated = ( count($diff) > 0 ) ? true : false;
            // Output msg [ Profile has nothing changed ]
            if( ! $updated ) flash( 'profile_actions' , 'Profile has nothing changed' , 'warning text-center' );

            // Profile already Update
            if( $updated ):
                foreach( $diff as $input => $value  ):
                    // if empty
                    if( empty( $data[$input] ) && ! in_array( $input, $optional ) ):
                        $data[$input . '_err'] = str_replace( '_',' ', $input ) . ' Can`t be empty ';
                        $errors++;
                    else:
                        
                        switch( $input ):

                            // Name already token
                            case 'name':
                                if( $this->user_db->NameExists( $data['name'] ) ){
                                    $data[$input.'_err'] = 'Name already token';
                                    $errors++;
                                }else{
                                    $data[$input.'_success'] = 'Looks Good';
                                }
                            break;

                            // Email already token
                            case 'email':
                                if( $this->user_db->EmailExists( $data['email'] ) ){
                                    $data[$input.'_err'] = 'Email already token';
                                    $errors++;
                                }else{
                                    $data[$input.'_success'] = 'Looks Good';
                                }
                            break;

                        endswitch;
                    endif;

                endforeach;

            endif;

            if( $updated && $errors === 0 ):
                
                // move user profile image to profile folder
                if( $uplaod_profile_img['error'] === 0 ):
                    move_uploaded_file($uplaod_profile_img['tmp_name'], PUBLIC_PATH . '/assets/images/profile/'. $user_profile_img_name);
                    else:
                        $data['profile_img'] = 'user_profile_blank.jpg';
                endif;
                // update the field(s) which user has changed
                $UpdateUserProfile = $this->user_db->UpdateUserData($data);

                if($UpdateUserProfile){
                    foreach ($data as $key => $val) {
                        // renew $_SESSION keys values
                        $_SESSION[$key] = $val;
                    }
                    // flash success msg
                    flash( 'profile_actions' , 'Profile update sucessfully!' , 'success text-center' );
                }
                    
            endif;


        }
        // Load edit view
        $this->views( 'Admin/profile/edit.php', $data );
    }

}