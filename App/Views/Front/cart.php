<?php
/**
 * Display Cart View
 */
get_front_file("header");
?>
<!-- Start breadcrumb -->
<div class="breadcrumbs">
    <?php get_front_file("shop/breadcrumb") ?>
</div>
    <div class="cart-main-area pt-115 pb-120">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row">
                <!-- Start Cart Products -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <?php get_front_file("cart/body", $data); ?>
                </div>
                <!-- End Cart Products -->

                <!-- Start Cart Widget -->
                <div class="row">
                    <!-- Start Cart coupon Widget -->
                    <?php get_front_file("cart/coupon"); ?>
                    <!-- Start Cart tax Widget -->
                    <?php get_front_file("cart/tax"); ?>
                    <!-- Start Cart total Widget -->
                    <?php get_front_file("cart/total"); ?>
                </div>
                <!-- Start Cart Widget -->
            </div>
        </div>
    </div>
<?php
get_front_file("footer");