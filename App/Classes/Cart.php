<?php
/**
 * Control User Cart
 * Display Cart total + Products count
 * Display Cart Products
 * Doing [ CRUD ] for the Cart
 */
namespace Classes;
use \Models\cart as userCart;
class Cart
{
    public $cart_dbh;
    public $user_id;
    public function __construct()
    {
        $this->user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
        $this->cart_dbh = new userCart($this->user_id);
    }
    /**
     * Display Cart total
     * Check if user is sign in
     * then display cart total
     */
    public function GetCartTotal()
    {
        // Return Cart total for current user
        return $this->cart_dbh->CartTotal();
    }

    /**
     * Display Cart Product count
     * Check if user is sign in
     * then display cart product count
     */
    public function GetCartCount()
    {
        // Return Cart Products Count for current user
        return $this->cart_dbh->CartCount();
    }

    /**
     * Display All User Cart Products
     * Check if user is sign in
     * then display All User Cart Products
     */
    public function GetCartProducts()
    {
        // Return Cart Products for current user
        return $this->cart_dbh->CartProducts();
    }
    
}