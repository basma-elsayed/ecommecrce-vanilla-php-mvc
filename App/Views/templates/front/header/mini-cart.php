<?php ob_start(); ?>
<div class="sidebar-cart-active">
    <div class="sidebar-cart-all">
        <a class="cart-close" href="#"><i class="icon_close"></i></a>
        <?php if( GetCartProducts() ): ?>
        <div class="cart-content">
            <h3>Shopping Cart</h3>
            <ul>
                <?php foreach( GetCartProducts() as $index): ?>
                <li class="single-product-cart">
                    <div class="cart-img">
                        <a href="#"><img src="<?php echo get_img( 'products/'. $index['image'] ) ?>" alt="" /></a>
                    </div>
                    <div class="cart-title">
                        <h4><a href="#"><?php echo $index['name'];  ?></a></h4>
                        <span><?php echo $index['quantity']; ?> × </span>

                        <?php echo GetCartProductPrice($index['price'], $index['sale']); ?>
                    </div>
                    <div class="cart-delete">
                        <a href="<?php echo URL . 'front/shop/remove_order?o_id='. $index['order_id']. '&p_id='.$index['id']; ?>">×</a>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="cart-total">
                <h4>Subtotal: <span><?php echo GetCartTotal(); ?></span></h4>
            </div>
            <div class="cart-checkout-btn">
                <a class="btn-hover cart-btn-style" href="<?php echo URL . 'front/cart' ?>">view cart</a>
                <a class="no-mrg btn-hover cart-btn-style" href="<?php echo URL . 'front/checkout' ?>">checkout</a>
            </div>
        </div>
        <?php else: ?>
            <h3 class="mb-3 text-center"> Cart is Empty </h3>
            <a class="btn btn-success btn-block" href="<?php echo URL . 'front/shop' ?>">Shop Now</a>
        <?php endif; ?>
    </div>
</div>