<?php
/**
 * Outh Systme
 * [ Register | Login | Logout | Forget Password ]
 */
namespace Controllers\Front;
use \Models\user;
class Auth extends \Core\Controller
{
    public $user_db;

    public function __construct()
    {
        $this->user_db = new user();
    }


    /**
     * Register new user
     */
    public function register()
    {
        // Init data array
        $data = [];

        // Form has been submitted
        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
            
            // Sanitize POST values
            $_POST = filter_input_array( INPUT_POST,  FILTER_SANITIZE_STRING );
        
            // Collect input values into array
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
            ];

            /**
             * Validate new user data
             * Name && email must be unique
             * password length [ 6 - 12 ] Charcters
             */
            $errors = 0;
            foreach( $data as $input => $value ):
                // inputs ! empty
                if( empty( $data[$input] ) ):
                    $data[$input.'_err'] = str_replace( '_',' ', $input ) .' Can`t be empty';
                    $errors++;
                else:
                    switch( $input ):
                        // name ! token
                        case 'name':
                            if ( $this->user_db->NameExists($data['name']) ) {
                                $data['name_err'] = 'Sorry, name already token';
                                $errors++;
                            }else{
                                $data['name_success'] = 'looks Good';
                            }
                        break;
                        
                        // email ! token
                        case 'email':
                            if ( $this->user_db->EmailExists($data['email']) ) {
                                $data['email_err'] = 'Sorry, email already token';
                                $errors++;
                            }else{
                                $data['email_success'] = 'looks Good';
                            }
                        break;

                        // Validate password
                        case 'password':
                            if( strlen( $data['password'] )  < 6 || strlen( $data['password'] ) > 12 ) {
                                $data['password_err'] = 'Password must be between 6 to 12 characters';
                                $errors++;
                            }else{
                                $data['password_success'] = 'looks Good';
                            }
                        break;
                        
                        // Confirm password
                        case 'confirm_password':
                            if ( $data['password'] !== $data['confirm_password'] ) {
                                $data['confirm_password_err'] = 'Must match the password field';
                                $errors++;
                            }else{
                                $data['confirm_password_success'] = 'looks Good';
                            }
                        break;

                    endswitch;

                endif;

            endforeach;

            /**
             * Insert new user into Database
             */
            if( $errors === 0 ):

                // hashing password 
                $data['password'] = password_hash( $data['password'], PASSWORD_DEFAULT );
                // Insert into the Database
                if( $this->user_db->InsertNewUSer( $data ) ){
                    print_r($insert);
                    // flash registraion success msg
                    flash( 'registerd_success', 'Account registerd successfully, <strong>login!</strong>', 'success' );
                    // redirect to login page
                    redirect( 'front/auth/login' );
                } else{
                    flash( 'registerd_falid', 'Please, try again!', 'alert' );
                }
            endif;

        }

        // Load register View
        $this->views( 'Auth/register.php', $data );
    }

    /**
     * login user
     */
    public function login()
    {       
        // init data array
        $data = [];

        // POST request from the server [ login form has been submitted ]
        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

            // Sainitize user data
            $_POST = filter_input_array( INPUT_POST,  FILTER_SANITIZE_STRING );

            // Collect inside array
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
            ];

            // Validate inputs
            
            // Select user data by name and email
            $user = $this->user_db->ValidateUser( $data );

            /**
             * Validate user data
             * Name && email exist
             * password related to user name && email
             */
            $errors = 0;
            foreach( $data as $input => $value ):
                // inputs ! empty
                if( empty( $data[$input] ) ):
                    $data[$input.'_err'] = str_replace( '_',' ', $input ) .' Can`t be empty';
                    $errors++;
                else:
                    switch( $input ):

                        // Name exists
                        case 'name':
                            if( ! $user ){
                                $data[$input.'_err'] = $input .' is not exist';
                                $errors++;
                            }else{
                                $data[$input.'_success'] = 'looks Good';
                            }
                        break;

                        // Email exists
                        case 'email':
                            if( ! $user ){
                                $data[$input.'_err'] = $input .' is not exist';
                                $errors++;
                            }else{
                                $data[$input.'_success'] = 'looks Good';
                            }
                        break;

                        // Validate password
                        case 'password':
                            if( ! $user || ! password_verify( $data['password'], $user->password  ) ){
                                $data[$input.'_err'] = 'Wrong Password';
                                $errors++;
                            }else{
                                $data[$input.'_success'] = 'looks Good';
                            }
                        break;

                    endswitch;

                endif;
            endforeach;

            /**
             * Insert new user into Database
             */
            if( $errors === 0 ):

                // register session
                $this->user_db->CreateUserSession( $user );

                // Flash msg
                flash( 'welcome_user' , 'Welcome '.$_SESSION['full_name'].'' , 'success text-center' );

                // if admin redirect to dashboard
                if( (int) $user->group_id === 1 ) {
                    redirect( 'admin/profile/edit');
                } 
                // if regular user redirect to index
                if( (int) $user->group_id !== 1 ) {
                    redirect( 'front/home/display');
                }
            endif;

        }
        // Load login View
        $this->views( 'Auth/login.php', $data );
    }

    /**
     * User Forget Password
     */
    public function ForgetPassword()
    {
        validateUser();
        // init array data
        $data = [];
        
        // Load Forget Password view
        $this->views( 'Auth/forget_pass.php', $data );
    }

    public function logout()
    {
        $_SESSION = [];
        
        session_unset();

        session_destroy();

        redirect( 'front/auth/login' );
    }

}