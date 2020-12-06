<?php
/**
 * Mostly Used Queries through the App
 */
namespace Models;
use \Core\Database;
class general
{
    public $dbh;
    static $db;

    public function __construct()
    {
        $this->dbh = new Database();
    }

    /**
     *  record exists into specific table
     *  @param string $col      :column name
     *  @param string $table    :table name
     *  @param string $value    :value to search for
     */
    public function IsExists( string $col, string $table, $condition = '', $value, $type = 'OBJ' )
    {   
        
        if( empty($condition) ){
            $condition = $col;
        }
        // Prepare
        $this->dbh->prepare( "SELECT $col FROM $table WHERE $condition = :value" );
        // Bind
        $this->dbh->bind( ':value' , $value );

        // Execute
        // if ! exist return false
        return $type === 'OBJ' ? $this->dbh->single() : $this->dbh->single_assoc();
    }

    /**
     *  Get record from table
     *  @param string $col          :column name
     *  @param string $table        :table name
     *  @param string $condition    :condition
     */
    public function get( $col, $tabel, $condition = '', $type = 'OBJ', $single = false )
    {
        $query = "SELECT $col FROM $tabel ";

        if ( ! empty( $condition ) ) $query .= $condition;
            
        // Prepare
        $this->dbh->prepare( $query );

        // Fetch all
        return $type === 'OBJ' ? ($single === false ? $this->dbh->FetchAll() : $this->dbh->single()) : ($single === false ? $this->dbh->FetchAssoc() : $this->dbh->single_assoc());
    }

    /**
     *  Check availablity
     *  @param string $col          :column name
     *  @param string $table        :table name
     *  @param string $condition    :condition
     */
    public function exists( $col, $tabel, $condition = null )
    {
        $query = "SELECT $col FROM $tabel";

        if ( ! is_null( $condition ) ) $query .= $condition;

        // Prepare
        $this->dbh->prepare( $query );

        /**
         * Execute
         * TRUE on success FALSE on Faliure
         */
        $this->dbh->execute();

        return $this->dbh->RowCount();
    }
    

    /**
     *  Delete record
     *  @param string $col          :column name
     *  @param string $table        :table name
     *  @param string $condition    :condition
     */
    public function remove( $tabel, $condition = null )
    {
        // Prepare
        $this->dbh->prepare( "DELETE FROM $tabel $condition" );

        /**
         * Execute
         * TRUE on success FALSE on Faliure
         */
        $this->dbh->execute();

        return $this->dbh->RowCount();

    }
// INSERT INTO table_name (column1, column2, column3, ...)
// VALUES (value1, value2, value3, ...);
    /**
     *  Insert record into tabel
     *  @param string $table        :table name
     *  @param string $cols         :tabel cols
     *  @param string $values       :values to insert
     */ 

    public function insert($tabel, $cols, $values)
    {
        $values = "";
        $i = 1;
        foreach( $cols as $key => $value ){
            $delimater = count($data) > $i ? ',' : '';
            $values .= "$key = :$key$delimater ";
            $i++;
        }
    }

    /**
     *  get All Categories
     */
    public static function getCount( $col, $table, $conditon )
    {
        self::$db = new Database();
        // Prepare
        self::$db->prepare( "SELECT $col FROM $table WHERE $conditon" );

        // Execute
        self::$db->execute();
        
        // Count
        return self::$db->RowCount();
    }

    public function size()
    {
        self::$db = new Database();

        self::$db->prepare( "SELECT id,size FROM products" );

        return $sizes = self::$db->FetchAssoc();
    }


}