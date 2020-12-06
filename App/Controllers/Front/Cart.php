<?php
/**
 * Cart Controller
 */
namespace Controllers\Front;
class Cart extends \Core\Controller
{
    
    public function __construct()
    {

    }

    
    public function index()
    {
                // Date
        $data = [];
        // Load Category View
        $this->views( 'Front/cart.php', $data );
    }

}