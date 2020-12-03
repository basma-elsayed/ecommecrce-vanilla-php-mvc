<?php
/**
 
 * Home Controller
 */
namespace Controllers\Front;
use \Models\general as GDB;

class Shop extends \Core\Controller
{
    
    public function __construct()
    {
        $this->general_db = new GDB();
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

}