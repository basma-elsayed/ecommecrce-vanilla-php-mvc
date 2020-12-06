<?php ob_start(); ?>
<form action="#">
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
                <tr>
                    <td class="product-thumbnail">
                        <a href="#"><img src="assets/images/cart/cart-1.jpg" alt="" /></a>
                    </td>
                    <td class="product-name"><a href="#">Simple Black T-Shirt</a></td>
                    <td class="product-price-cart"><span class="amount">$260.00</span></td>
                    <td class="product-quantity pro-details-quality">
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                        </div>
                    </td>
                    <td class="product-subtotal">$110.00</td>
                    <td class="product-remove">
                        <a href="#"><i class="icon_close"></i></a>
                    </td>
                </tr>
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