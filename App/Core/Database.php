<?php
/**
 * Database class
 * Connect to database
 * Databse queries
 */
namespace Core;
use Core\Config;
use PDO;
class Database
{
    private $dbh;
    private $stmt;
    private $error;
    
    /**
     * Connect to Database
     */
    public function __construct()
    {

        $dsn = 'mysql:host='. Config::DB_HOST .';dbname='. Config::DB_NAME .'';
        
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ];

        try {
            $this->dbh = new PDO( $dsn, Config::DB_USER, Config::DB_PASS, $options );
        } catch (PDOException $e) {
            echo $this->error = 'Connection Failed ' . $e->getMessage();
        }
    }

    // Prepare stmt
    public function prepare($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // bind value
    public function bind( $param, $value, $type = null )
    {
        
        if( is_null($type) ){

            switch( true ){

                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;

                case(is_bool($value)):
                    $type = PDO::PARAM_BOOL;
                break;

                case(is_null($value)):
                    $type = PDO::PARAM_NULL;
                break;

                case(is_string($value)):
                    $type = PDO::PARAM_STR;
                break;

                default:
                    $type = PDO::PARAM_STR;

            }

        }

        $this->stmt->bindValue( $param, $value, $type );
    }

    // Execute
    public function execute()
    {
        return $this->stmt->execute();
    }

    // return single value
    public function single()
    {
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // return single value
    public function single_assoc()
    {
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    // return object value
    public function FetchAll()
    {
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // return assoc array value
    public function FetchAssoc()
    {
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // return result count
    public function RowCount()
    {
        return $this->stmt->rowCount();
    }

}