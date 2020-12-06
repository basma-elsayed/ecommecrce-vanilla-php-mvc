<?php
/**
 * 
 * user model
 * [ CRUD Operations ] with database
 */

namespace Models;
use \Core\Database;

class user
{

    public function __construct()
    {
        $this->db = new Database();
    }

    // Check is user name exists
    public function NameExists( string $name, string $table = 'users' )
    {
        // Prepare
        $this->db->prepare( "SELECT name FROM $table WHERE name = :name" );
        // Bind
        $this->db->bind( ':name' , $name );

        /**
         * Execute
         * Return Single Data on success
         * Return FALSE on Faliure
         */ 
        return $this->db->single();
    }

    // Check is user email exists
    public function EmailExists( string $email, string $table = 'users' )
    {
        // Prepare
        $this->db->prepare( "SELECT email FROM $table WHERE email = :email" );
        
        // Bind
        $this->db->bind( ':email' , $email );

        /**
         * Execute
         * Return Single Data on success
         * Return FALSE on Faliure
         */
        return $this->db->single();
    }

    // Check is user password Match
    public function PasswordMatches(array $data )
    {
        // Prepare
        $this->db->prepare('SELECT 
                                password 
                            FROM 
                                users 
                            WHERE 
                                name = :name 
                            AND
                                email = :email' );
        // Bind
        $this->db->bind( ':name' , $data['name'] );
        $this->db->bind( ':email' , $data['email'] );

        /**
         * Execute
         * Return Single Data on success
         * Return FALSE on Faliure
         */
        $row = $this->db->single();

        if( $row ):
            return ( password_verify( $data['password'], $row->password ) ) ? true : false;
        else:
            return false;
        endif;
    }

    // Check is user data [ name , email, password ]
    public function ValidateUser( array $data, string $table = 'users' )
    {
        // Prepare
        $this->db->prepare( "SELECT * 
                            FROM 
                                $table 
                            WHERE 
                                name = :name 
                            AND 
                                email = :email 
                            " );
        // Bind
        $this->db->bind( ':name' , $data['name'] );
        $this->db->bind( ':email' , $data['email'] );

        /**
         * Execute
         * Return Single Data on success
         * Return FALSE on Faliure
         */
        return $this->db->single();
    }

    // Get user data by ID
    public function GetUserByID( int $id ){

        // Prepare
        $this->db->prepare( 'SELECT 
                                *
                            FROM
                                users u
                            WHERE
                                u.id = :id
                            ' );
        // Bind
        $this->db->bind( ':id', $id );

        /**
         * Excute
         * Return Single Data on success
         * Return FALSE on Faliure
         */
        return $this->db->single();
    }

    // Edit user Data
    public function UpdateUserData(array $data )
    {

        // Prepare
        $this->db->prepare( 'UPDATE 
                                users
                            SET
                                name        = :name,
                                full_name   = :full_name,
                                email       = :email,
                                img         = :img,
                                bio         = :bio
                            WHERE
                                id = :id
                            ' );
        // network     = :network
        // Bind 
        $this->db->bind( ':name', $data['name'] );
        $this->db->bind( ':full_name', $data['full_name'] );
        $this->db->bind( ':email', $data['email'] );
        $this->db->bind( ':img', $data['profile_img'] );
        $this->db->bind( ':bio', $data['bio'] );
        // $this->db->bind( ':network', $data['network'] );
        $this->db->bind( ':id', $_SESSION['id'] );

        /**
         * Excute
         * Return Single Data on success
         * Return FALSE on Faliure
         */
        return $this->db->execute();

    }


    // Insert new user
    public function InsertNewUser( $data, string $table = 'users' ){

        // Prepare
        $this->db->prepare( "INSERT INTO 
                                $table  (
                                    name,
                                    password,
                                    email
                                )
                                
                                VALUES
                                (
                                    :name,
                                    :password,
                                    :email
                                )
                            " );
        // Bind
        $this->db->bind( ':name', $data['name'] );
        $this->db->bind( ':password', $data['password'] );
        $this->db->bind( ':email', $data['email'] );
        
        /**
         * Return TRUE on success FALSE on Faliure
         */
        $row = $this->db->execute();
        return $row;
    }

    public function UpdateUserProfile($data)
    {
        $values = "";
        $i = 1;
        foreach( $data as $key => $value ){
            $delimater = count($data) > $i ? ',' : '';
            $values .= "$key = :$key$delimater ";
            $i++;
        }

        // prepare
        $this->db->prepare( "UPDATE 
                    users
                SET
                    $values
                WHERE
                    id = :id
                " );

        // Bind
        foreach( $data as $key => $value ){
            $this->db->bind( ":$key", $value );
        }
        $this->db->bind( ":id", $_SESSION['id'] );

        // Execute
        return $this->db->execute();
        
    }

    // register Author [ admin ] session
    public function CreateUserSession($user)
    {
        $_SESSION['id']                = $user->id;
        $_SESSION['name']              = $user->name;
        $_SESSION['full_name']         = $user->full_name;
        $_SESSION['password']          = $user->password;
        $_SESSION['email']             = $user->email;
        $_SESSION['profile_img']       = $user->img;
        $_SESSION['bio']               = $user->bio;
        $_SESSION['network']           = $user->network;
        $_SESSION['group_id']          = $user->group_id;
        $_SESSION['trust_status']      = $user->trust_status;
        $_SESSION['reg_status']        = $user->reg_status;
    }
    
    // register Customer session
    public function CreateCustomerSession($user)
    {
        $_SESSION['id']                = $user->id;
        $_SESSION['name']              = $user->name;
        $_SESSION['password']          = $user->password;
        $_SESSION['email']             = $user->email;
    }

}