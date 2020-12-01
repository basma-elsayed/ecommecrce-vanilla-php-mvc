<?php
/**
 * Index
 * Front Controller
 * 
 */
require dirname(__DIR__) . '/App/vendor/autoload.php';

require_once dirname(__DIR__) . '/App/bootstrap.php';

// Load Router
$router = new Core\Router;
$router->LoadController();