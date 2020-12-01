<?php
/**
 * Controll && handel Categories
 */
namespace Models;
use \Core\Database;
class categorie
{
    public $dbh;
    static $db;
    public $tabel;
    
    public function __construct()
    {
        $this->dbh = new Database();
        $this->tabel = 'categories';
    }

    /**
     *  Insert record into Category table
     *  @param string $data      :array of data to insert
     */
    public function insert( array $data )
    {

        // Prepare
        $this->dbh->prepare( "INSERT INTO 
                                $this->tabel ( 
                                    name, 
                                    description,
                                    visiblity,
                                    allow_comments,
                                    allow_ads
                                )
                                VALUES
                                ( 
                                    :name,
                                    :description,
                                    :visiblity,
                                    :allow_comments,
                                    :allow_ads
                                )
                            ");
        // Bind
        $this->dbh->bind( ':name', $data['name'] );
        $this->dbh->bind( ':description', $data['description'] );
        $this->dbh->bind( ':visiblity', $data['visbility'] );
        $this->dbh->bind( ':allow_comments', $data['allow_comments'] );
        $this->dbh->bind( ':allow_ads', $data['allow_ads'] );

        // Execute 
        return $this->dbh->execute();
    }
    

    /**
     *  Update exists Category
     */
    public function update( $data, $id )
    {

        // Prepare
        $this->dbh->prepare( "UPDATE 
                                $this->tabel 
                            SET 
                                name = :name,
                                description = :description,
                                visiblity = :visiblity,
                                allow_comments = :allow_comments,
                                allow_ads = :allow_ads
                            WHERE
                                id = :id
                            ");

        // Bind
        $this->dbh->bind( ':name' , $data['name'] );
        $this->dbh->bind( ':description' , $data['description'] );
        $this->dbh->bind( ':visiblity' , $data['visiblity'] );
        $this->dbh->bind( ':allow_comments' , $data['allow_comments'] );
        $this->dbh->bind( ':allow_ads' , $data['allow_ads'] );
        $this->dbh->bind( ':id' , $id );

        // Execute
        return $this->dbh->execute() > 0 ? true : false;
        
        // Returns TRUE on success or FALSE on failure.
        // return $this->dbh->RowCount() > 0 ? true : false;
    }

    /**
     *  Delete exists Category
     */
    public function delete($id){
        
        // PrePare
        $this->dbh->prepare( "DELETE FROM $this->tabel WHERE id = :id" );

        // Bind
        $this->dbh->bind( ':id', $id );
        
        // execute
        $this->dbh->execute();

        // Returns TRUE on success or FALSE on failure.
        return $this->dbh->RowCount() > 0 ? true : false;
    }

}