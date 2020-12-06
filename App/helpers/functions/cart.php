<?php
/**
 * All Cart Functions 
 * Display cart total | product count etc..
 */
// Require Cart Class
use \Classes\Cart;
$cart_handler = new cart();

/**
 * Display Cart total
 * Function uses ( user id ) stored in ( session array ) to get cart total
 */
function GetCartTotal()
{
    global $cart_handler;
    // Return user cart total
    return $cart_handler->GetCartTotal();
    // return $cart_handler->GetCartTotal();
}

/**
 * Display Cart Count
 * Function uses ( user id ) stored in ( session array ) to get cart count
 */
function GetCartCount()
{
    global $cart_handler;
    // Return user products count
    return $cart_handler->GetCartCount();
}

/**
 * Display Cart Prodcuts
 * Function uses ( user id ) stored in ( session array ) to Display cart Prodcuts
 */
function GetCartProducts()
{
    global $cart_handler;
    // Return user cart Prodcuts in cart
    return $cart_handler->GetCartProducts();
}

/**
 * Get Product price
 * Funtion Return price markup with the current price 
 * Return [ sale + old price ] or [ reguler price ]
 */
function GetProductPrice($price , $sale)
{
    $html = '';

    if( $sale != 0  ):
        $html .= "<span class='new-price'> ".$sale." </span>";
        $html .= "<span class='old-price'> ".$price." </span>";
    else:
        $html .= "<span class='new-price'> ".$price." </span>";
    endif;

    return $html;
}

/**
 * Get Cart Product price
 * Funtion Return price markup with the current price 
 * Return [ sale ] or [ reguler price ]
 */
function GetCartProductPrice($price , $sale)
{
    $html = '';
    
    if( $sale != 0  ):
        $html .= "<span> ".$sale." </span>";
    else:
        $html .= "<span> ".$price." </span>";
    endif;

    return $html;
}