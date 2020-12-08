<?php
/**
 * Cart Controller
 */
namespace Controllers\Front;
use \Models\cart as userCart;
class Cart extends \Core\Controller
{
    
    public $user_cart;

    public function __construct()
    {
        $this->user_cart = new userCart($_SESSION['id']);
    }

    /**
     * Method to Control the Cart Page 
     * Update [ + / - ] products
     */
    public function index()
    {
        // init Data array
        $data = [];

        // Cart products key
        $data['cart_products'] = GetCartProducts();

        if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

            // Collect post into data array
            $data['post'] = $_POST;
            // Errors Counter
            $errors = 0;

            // Loop index
            $i = 0;
            // loop through $data array
            foreach( $data['post'] as $order ):
                // Check if order exist && status = 0 Or someone try to hack
                $order_exists = $this->user_cart->OrderExist($order['order_id'], $order['product_id']);
                if( $order_exists !== false ){
                    
                    // Calc the total
                    $order['amount'] = $data['cart_products'][$i]['sale'] != 0 ? ($data['cart_products'][$i]['sale'] * $order['quantity'] ) : ($data['cart_products'][$i]['price'] * $order['quantity'] );
                    
                    // update each order in orders table
                    $UpdateOrder = $this->user_cart->UpdateExistOrder($order);
                    $UpdateOrder ? flash( 'cart_actions', 'Cart Updated Successfully', 'success' ) : $errors++;
                }
            $i++;
            endforeach;

            // Everything goes well, NO Errors!
            if( $errors === 0 ):
                // redirect to cart again [ just work around to refresh the page ]
                redirect('front/cart');
            // Somthing wrong happened    
            else:
                // Flash errro msg
                flash( 'cart_actions', 'Faild to update the Cart, try later', 'danger' );
                // redirect to cart again [ just work around to refresh the page ]
                redirect('front/cart');
            endif;
        }
        // Load Category View
        $this->views( 'Front/cart.php', $data );
    }
}