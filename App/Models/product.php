<?php
/**
 * 
 * products model
 * [ CRUD Operations ] with database
 */
namespace Models;
use \Core\Database;
class product
{

    public $tabel;
    public $dbh;

    public function __construct()
    {
        $this->dbh = new Database();
        $this->tabel = 'products';
    }

    // Insert new product
    public function insert($data , $id)
    {   
        // Prepare
        $this->dbh->prepare( "INSERT INTO 
                                $this->tabel (
                                    name,
                                    description,
                                    price,
                                    image,
                                    gallery,
                                    sale,
                                    status,
                                    cat_id,
                                    user_id,
                                    size,
                                    brand
                                )
                                
                                VALUES
                                (
                                    :name,
                                    :description,
                                    :price,
                                    :image,
                                    :gallery,
                                    :sale,
                                    :status,
                                    :cat_id,
                                    :user_id,
                                    :size,
                                    :brand
                                )
                            " );
        // Bind
        $this->dbh->bind( ':name', $data['name'] );
        $this->dbh->bind( ':description', $data['description'] );
        $this->dbh->bind( ':price', $data['price'] );
        $this->dbh->bind( ':sale', $data['sale_price'] );
        $this->dbh->bind( ':image', $data['img'] );
        $this->dbh->bind( ':gallery', !empty( $data['gallery'] ) ? serialize($data['gallery']) : '' );
        $this->dbh->bind( ':status', $data['status'] );
        $this->dbh->bind( ':cat_id', $data['category'] );
        $this->dbh->bind( ':user_id', $id );
        $this->dbh->bind( ':size', $data['size'] );
        $this->dbh->bind( ':brand', $data['brand'] );
        
        /**
         * Return Single Data on success
         * Return TRUE on success FALSE on Faliure
         */
        $this->dbh->execute();
        return $this->dbh->RowCount() > 0 ? true : false ;
    }

    /**
     * Get all products
     * Left join with product`s author and category
     */
    function get($type ='OBJ')
    {
        // prepare
        $this->dbh->prepare("SELECT
                            products.*,
                            categories.name AS cat_name,
                            users.name AS author_name
                            FROM
                                $this->tabel
                            LEFT JOIN
                                categories
                            ON
                                categories.id = products.cat_id
                            LEFT JOIN
                                users
                            ON
                                users.id = products.user_id
                            ORDER BY `date` DESC
                        ");
        
        // Fetch all
        return $type === 'OBJ' ? $this->dbh->FetchAll() : $this->dbh->FetchAssoc();
    }

    /**
     *  Update exists Product
     */
    public function update( $data, $id )
    {

        // Prepare
        $this->dbh->prepare( "UPDATE 
                                $this->tabel 
                            SET 
                                name = :name,
                                description = :description,
                                price = :price,
                                sale = :sale,
                                cat_id = :cat_id,
                                status = :status,
                                size = :size,
                                brand = :brand
                            WHERE
                                id = :id
                            ");
                                

        // Bind
        $this->dbh->bind( ':name' , $data['name'] );
        $this->dbh->bind( ':description' , $data['description'] );
        $this->dbh->bind( ':price' , $data['price'] );
        $this->dbh->bind( ':sale' , $data['sale'] );
        $this->dbh->bind( ':cat_id' , intval($data['cat_id']) );
        $this->dbh->bind( ':status' , $data['status'] );
        $this->dbh->bind( ':size' , serialize($data['size']) );
        $this->dbh->bind( ':brand' , $data['brand'] );
        $this->dbh->bind( ':id' , $id );
    
        // Execute
        return $this->dbh->execute() > 0 ? true : false;

    }
}