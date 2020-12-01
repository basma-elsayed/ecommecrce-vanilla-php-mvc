<?php
/**
 * All Categories View
 */

get_front_file("header");
?>
<!-- Start breadcrumb -->
<div class="breadcrumbs">
    <?php get_front_file("shop/breadcrumb") ?>
</div>
<!-- End breadcrumb -->
<!-- Start Categories Body -->
<div class="shop-area pt-120 pb-120">
    <div class="container">
        
        <div class="row flex-row-reverse">

            <!-- Start Products -->
            <div class="col-lg-9">

                <!-- get view-mode file  -->
                <?php get_front_file("shop/view-mode"); ?>

                <!-- get products file  -->
                <?php get_front_file("shop/products", $data['products'] ); ?>

                <!-- get pagination file  -->
                <?php get_front_file("shop/pagination"); ?>

            </div>
            <!-- End Products -->

        
            <!-- Start Sidebar -->
            <div class="col-lg-3">
                <!-- get Sidebar file  -->
                <?php get_front_file( "shop/sidebar", $data ); ?>
            </div>
            <!-- End Sidebar -->

        </div>
        

    </div>
</div>
<!-- End Categories Body -->
<?php
get_front_file("footer");