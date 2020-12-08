<?php
/**
 
 * Home Controller
 */
namespace Controllers\Front;
use \Models\general as GDB;
use \Models\product as PDB;
use \Models\cart;

class Shop extends \Core\Controller
{
    
    public function __construct()
    {
        $this->general_db = new GDB();
        $this->PDB = new PDB();
        $this->user_id = isset( $_SESSION['id'] ) ? $_SESSION['id'] : '0';
        $this->cart = new cart($this->user_id);
    }

    /**
     * index
     * analiyze params and call the wanted method
     * @param array queries params
     */
    public function index($params)
    {
        isset($params['p_id']) ? $this->single($params) : $this->all($params);
    }

    /**
     * single Product
     * Display single Product && the related products
     */
    public function single($params)
    {
        

        // Get Product by id
        $product  = $this->general_db->get( '*', 'products' , 'WHERE id = '.$params['p_id'].' ', 'ASSOC', true );

        // Check Product exist
        if( empty($product) ) {
            // Redirect to shop
            redirect('front/shop');
        }

        // unserlize serlized item
        $serilized_arr = [ 'gallery' => '' , 'size' => '' ];
        foreach( $serilized_arr as $key => $val ):
            $product[$key] = unserialize( $product[$key] );
        endforeach;
        
        // Init data array
        $data = [];

        // Init product array
        $data['product'] = $product;
          
        // Load Single Product View
        $this->views( 'Front/single-product.php', $data );
    }

    /**
     * Add Product to cart
     */
    public function AddProduct($params)
    {
        // p_id param is exist
        if( ! isset($params['p_id']) ) redirect( 'front/categories' );
        
        // # Check product already exist or someone try to hack
        $p = $this->general_db->get( 'id,name,user_id,price,sale', 'products', 'WHERE id = '.$params['p_id'].'', 'ASSOC', true );
        if( ! $p ) redirect( 'front/categories' );
        
        // ## Check customer is signed in or not
        if( ! isset($_SESSION['id']) ) redirect( 'front/auth/register' );
        
        // ### insert into orders table [ p_id, author, c_id ] 
        $data = [
            'c_id' => $_SESSION['id'],
            'product_id' => $p['id'],
            'author' => $p['user_id'],
            'amount' => $p['sale'] ? $p['sale'] : $p['price'],
        ];
        
        $add_order = $this->cart->AddCustomerOrder($data);

        // order added successfully
        if( $add_order ){
            // Flash msg
            flash( 'order_action', 'Product '.$p['name'].' added to the cart successfully', 'success' );
            // #### return back to prev page
            redirect('front/categories');
        }else{
            flash( 'order_action', 'Faild to add Product '.$p['name'].', Please try later', 'success' );
            // #### return back to prev page
            redirect('front/categories');  
        }

    }

    /**
     * Remove Prodcut From order table
     * function using order id && user id to remove specific order
     */
    public function RemoveOrder($params)
    {
        validateUser();
        // Check if o_id && p_id keys exist in request queries
        if( ! isset($params['o_id']) || ! isset($params['p_id']) ) redirect( 'front/categories' );
        /**
         * Oreder Exists
         * Check if user exist && has orders in order table or some hacks happing
         */
        $result = $this->cart->OrderExist( $params['o_id'], $params['p_id'] );
        if( $result && $result['status'] == 0 ):
            // delete order from order table
            $condition = "WHERE order_id = ".$params['o_id']." AND product_id = ".$params['p_id']." AND status = '0' ";
            $delete = $this->general_db->remove( 'orders', $condition );
            // If success to delete the order
            if( $delete > 0 ){
                // Flash success msg
                flash( 'order_action', 'Product Deleted successfully', 'success' );
                // redirect back to prev page
                redirect('front/categories');
            }
            // If Faild to delete the order
            else{
                // Flash faild msg
                flash( 'order_action', 'Faild to Deleted order, Plaese try later', 'danger' );
                // redirect back to prev page
                redirect('front/categories');
            }
        /**
         * order not found
         *  something weird happing or someone try to hack
         */
        else:
            flash( 'order_action', 'Order Not Found', 'danger' );
            // redirect back to prev page
            redirect('front/categories');
        endif;
    }

}