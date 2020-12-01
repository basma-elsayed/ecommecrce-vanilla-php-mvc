<?php
/**
 * Router
 * Analyze URI && Load Controller 
 */
namespace Core;
class Router 
{
    public $routing = [];
    public $queryParams = [];
    public $CurrentController;
    
    public $dirName;
    public $controller;
    public $method;

    /**
     * Analyze URI
     * init main Propreties
     */
    public function __construct()
    {
        
        
        /**
         * Routing...
         * Get URI
         * Collect Routing into array
         */
        $uri                = $_SERVER['QUERY_STRING'];
        // $uri                = $_GET['url'];
        $this->routing      = explode( '/', $uri );
        $this->dirName      = ucwords($this->routing[0]);
        $this->controller   = ucwords($this->routing[1]);
        $this->method       = isset( $this->routing[2] ) ? $this->routing[2] : 'index';
        // print_r($this->routing);

        /**
         * QUERIES...
         * Get Queries
         * Collect Queries into array
         */
        $query              = $_SERVER['REQUEST_URI'];
        $query              = parse_url($query, PHP_URL_QUERY);
        $query              = parse_str( $query , $queries );
        $this->queryParams  = $queries;
        // print_r($queries);
    }

    /**
     * Store Contrllers
     */
    public function StroreControllers()
    {
        return [
            'Admin' => [
                'Products'      => \Controllers\Admin\Products::class,
                'Profile'       => \Controllers\Admin\Profile::class,
                'Categories'    => \Controllers\Admin\Categories::class,
            ],

            'Front' => [
                'Auth'          => \Controllers\Front\Auth::class,
                'Shop'          => \Controllers\Front\Shop::class,
                'Categories'    => \Controllers\Front\Categories::class
            ],
        ];
    }

    /**
     * Dir exsits
     */
    public function DirExist ()
    {
        // dir 
        $dir = dirname(__DIR__) . '/Controllers/' . $this->dirName;
        // Dir Exists
        if( ! is_dir( $dir ) ) return false;

        return true;
    }

    /**
     * Controller exsits
     */
    public function ControllerExist ()
    {
        $controller_file = $this->dirName . '/' . $this->controller  . '.php';
        // Controller Exists
        if( ! file_exists( dirname(__DIR__) . '/Controllers/' . $controller_file ) ){
            return false;
        }
        return true;
    }


    /**
     * Load Controller
     * make sure dir && controller is exist
     * instantiat the Controllers
     */
    public function LoadController()
    {
        if( ! $this->DirExist() ) {
            // Load 404 page
            echo 'Dir Not Exist';
            return;
        }

        if( ! $this->ControllerExist() ) {
            // Load 404 page
            echo 'Controller Not Exist';
            return;
        }

        // Controllers array
        $controllers = $this->StroreControllers();
        // Call the Controller
        $class = $controllers[$this->dirName][$this->controller];

        // instantiat the Controller object
        $class = new $class;
        
        // Convert to CamelCase
        if( preg_match( '/([a-z]+)_([a-z]+)/', $this->method, $output_array ) ){
            
            $this->method = str_replace( '_', ' ', $this->method );
            $this->method = ucwords($this->method);
            $this->method = str_replace( ' ', '', $this->method );
        }

        // Call the method
        if( ! method_exists( $class, $this->method ) && ! is_callable( array($class, $this->method) ) ) {
            // Load 404 page
            echo 'Method Not Exist or is not Callable';
            return;
        }

        $method = $this->method;
        $class->$method($this->queryParams);
    }

}