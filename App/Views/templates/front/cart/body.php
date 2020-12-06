<?php ob_start(); ?>
<?php if( GetCartProducts() ): ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
    <div class="table-content table-responsive cart-table-content">
        <table>
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Until Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach( GetCartProducts() as $index ): ?>
                <tr>
                    <td class="product-thumbnail">
                        <a href="#" class="ml-4"><img width="140" height="140" src="<?php echo get_img('products/' . $index['image']); ?>" alt="" /></a>
                    </td>
                    <td class="product-name"><a href="#"><?php echo $index['name']; ?></a></td>
                    <td class="product-price-cart"><span class="amount"><?php echo $index['price']; ?></span></td>
                    <td class="product-quantity pro-details-quality">
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="<?php echo $index['quantity']; ?>" />
                        </div>
                    </td>
                    <td class="product-subtotal"><?php echo GetCartProductPrice($index['price'], $index['sale']); ?></td>
                    <td class="product-remove">
                        <a href="<?php echo URL . 'front/shop/remove_order?o_id='. $index['order_id']. '&p_id='.$index['id']; ?>"><i class="icon_close"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="cart-shiping-update-wrapper">
                <div class="cart-shiping-update">
                    <a href="#">Continue Shopping</a>
                </div>
                <div class="cart-clear">
                    <button>Update Cart</button>
                    <a href="#">Clear Cart</a>
                </div>
            </div>
        </div>
    </div>
</form>
<?php endif; ?>