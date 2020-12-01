<?php
/**
 * Single Product Page
 */
get_front_file("header");
?>
<!-- Start breadcrumb -->
<div class="breadcrumbs">
    <?php get_front_file("shop/breadcrumb") ?>
</div>
<!-- Start Single Product Body -->

    <!-- get product details file  -->
    <?php get_front_file("shop/product-details", $data); ?>

    <!-- get description review file  -->
    <?php get_front_file("shop/description-review"); ?>

    <!-- get related product file  -->
    <?php get_front_file("shop/related-product"); ?>

<!-- End Single Product Body -->

<?php
get_front_file("footer");