<?php
/**
 * Front Categories Controller
 * [ Categories | Single Category ] page
 */
namespace Controllers\Front;
use \Models\general as GDB;

class Categories extends \Core\Controller
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
        isset($params['cat_id']) ? $this->single($params) : $this->all($params);
    }

    /**
     * All Categories
     * Display all categories && the related products
     */
    public function all($params)
    {
        if( $_SERVER['REQUEST_METHOD'] === 'GET' && isset( $params['filter'] )){
            print_r($params);
        }

        $cats       = $this->general_db->get( '*', 'categories' , '', 'ASSOC' );
        $products   = $this->general_db->get( '*', 'products' , 'WHERE status = "in_stock" ', 'ASSOC' );
        // Products array
        $data['products'] = $products;
        // Categories array
        $data['cats'] = $cats;
        $data['size'] = $this->general_db->size();

        // Load Category View
        $this->views( 'Front/categories.php', $data );
    }

    /**
     * single category
     * Display single category && the related products
     */
    public function single($params)
    {
        print_r( 'single category && the related products' );
    }

}