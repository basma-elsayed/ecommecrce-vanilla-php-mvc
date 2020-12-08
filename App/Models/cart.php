<?php
/**
 * cart class
 * Control & Handle the cart table
 * Cart [ CRUD ] Operations
 */

namespace Models;
use \Core\Database;
class cart
{   
    public $dbh;
    public $o_table;
    public $user_id;
    public function __construct($user_id)
    {
        $this->dbh = new Database();
        $this->o_table = 'orders';
        $this->user_id = $user_id;
    }

    /**
     * Get user the cart total
     */
    public function CartTotal()
    {
        // Prepare
        $this->dbh->prepare( "SELECT SUM(amount) as total FROM $this->o_table WHERE c_id = $this->user_id AND status = 0" );
        
        // Execute
        $exc = $this->dbh->execute();

        // Return the cart total on success FALSE on failure
        return $exc ? ( is_null( $total = $this->dbh->single_assoc()['total']) ? '0' : $total ) : false;
    }

    /**
     * Get user the cart total
     * 
     */
    public function CartCount()
    {
        // Prepare
        $this->dbh->prepare( "SELECT sum(quantity) as quantity FROM $this->o_table WHERE c_id = $this->user_id AND status = 0" );
        
        // Execute
        $exc = $this->dbh->execute();

        // Return the cart total on success FALSE on failure
        return $exc ? ( is_null( $count = $this->dbh->single_assoc()['quantity'] ) ? '0': $count ) : false;
    }

    /**
     * Check Product exists in cart using user id & product_id
     * @param int c_id = customer id
     * @param int product_id = product id
     */
    public function ProductInCart( $c_id, $product_id, $status = 0 )
    {
        // Prepare
        $this->dbh->prepare( "SELECT 
                                order_id,
                                amount,
                                quantity
                            FROM
                                $this->o_table
                            WHERE
                                c_id = $c_id
                            AND
                                product_id = $product_id
                            AND
                                status = $status
                            " );
        // Execute
        $exc = $this->dbh->execute();

        // Return row
        return $this->dbh->single_assoc();
    }

    /**
     * insert user orders
     */
    public function AddCustomerOrder($data)
    {
        // Check if product already exsit in cart
        $p = $this->ProductInCart( $data['c_id'], $data['product_id'] );
        return empty($p) ? $this->InsertNewOrder($data) : $this->UpdateExistOrder($data , $p);
    }

    /**
     * insert new Product
     * @param array data hold all needed infos
     */
    public function InsertNewOrder(array $data)
    {
        // Prepare
        $this->dbh->prepare( "INSERT INTO $this->o_table
                            (
                                c_id,
                                product_id,
                                author,
                                amount,
                                quantity
                            )
                            VALUES
                            (
                                :c_id,
                                :product_id,
                                :author,
                                :amount,
                                :quantity
                            )" );
        // Bind
        $this->dbh->bind( 'c_id', $data['c_id'] );
        $this->dbh->bind( 'product_id', $data['product_id'] );
        $this->dbh->bind( 'author', $data['author'] );
        $this->dbh->bind( 'amount', $data['amount'] );
        $this->dbh->bind( 'quantity', isset($data['quantity']) ? $data['quantity'] : '1' );
        
        // Execute
        $exec = $this->dbh->execute();
        return $exec ? true : false;
    }

    /**
     * function to upadate order
     * increase / decrease single product count 
     * add / delete more than 1 of a single product
     */
    public function UpdateExistOrder(array $data , array $old_order = [] )
    {
        // Prepare
        $this->dbh->prepare( "UPDATE
                                $this->o_table
                            SET
                                amount = :amount ,
                                quantity = :quantity
                            WHERE
                                order_id = :order_id
                            " );
        
        // amount var
        $amount = empty( $old_order ) ? $data['amount'] : $old_order['amount'] + $data['amount']; 
        // quantity var
        $quantity = empty( $old_order ) ? $data['quantity'] : $old_order['quantity'] + (isset($data['quantity']) ? $data['quantity'] : '1');
        // quantity var
        $order_id = empty( $old_order ) ? $data['order_id'] : $old_order["order_id"];
        
        // Bind
        $this->dbh->bind( 'amount', $amount );
        $this->dbh->bind( 'quantity', $quantity );
        $this->dbh->bind( 'order_id', $order_id );
        
        // Execute
        $exec = $this->dbh->execute();
        return $exec ? true : false;
        
    }

    /**
     * Select all prodcuts in cart  
     * 
     */
    public function CartProducts()
    {
        // Prepare
        $this->dbh->prepare("SELECT 
                                orders.order_id,
                                orders.amount,
                                orders.date,
                                orders.quantity,
                                products.id,
                                products.name,
                                products.price,
                                products.sale,
                                products.image
                            FROM
                                orders
                            LEFT JOIN 
                                products 
                            ON
                                orders.product_id = products.id
                            WHERE 
                                orders.c_id = $this->user_id
                            ORDER BY 
                                orders.date
                            ASC
                            ");
        // execute 
        $this->dbh->execute();

        // Return Result as array / on False failure
        return $this->dbh->RowCount() > 0 ? $this->dbh->FetchAssoc() : false;
    }

    /**
     * Order exist in orders table
     */
    public function OrderExist( $order_id, $product_id )
    {
        // Prepare
        $this->dbh->prepare( "SELECT 
                                order_id,
                                status,
                                product_id
                            FROM
                                $this->o_table
                            WHERE                            
                                order_id = :order_id
                            AND
                                product_id = :product_id
                            AND
                                c_id = :c_id
                            " );
                               
        // Bind
        $this->dbh->bind( 'c_id', $this->user_id );
        $this->dbh->bind( 'order_id', $order_id );
        $this->dbh->bind( 'product_id', $product_id );
        
        // Execute
        $this->dbh->execute();

        // Reuturn TRUE on success / FALSE failure
        return $this->dbh->RowCount() === 1 ? $this->dbh->single_assoc() : false;
    }
}
