<?php ob_start(); ?>
<div class="tab-content jump">
    <div id="shop-1" class="tab-pane active">
        <div class="row">
            <?php foreach( $data as $product ): ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="single-product-wrap mb-35">
                        <div class="product-img product-img-zoom mb-15">
                            <a href="product-details.html">
                                <img src="<?php echo get_img('products/' . $product['image']); ?>" alt="" />
                            </a>
                            <?php if( $product['sale'] != 0  ): ?>
                            <span class="pro-badge left bg-red">- <?php echo ceil( ( ( $product['price'] - $product['sale'] ) / $product['price'] ) * 100 ) . ' %'; ?></span>
                            <?php endif; ?>
                            <div class="product-action-2 tooltip-style-2">
                                <button title="Wishlist"><i class="icon-heart"></i></button>
                                <button title="Quick View" data-toggle="modal" data-target="#exampleModal"><i class="icon-size-fullscreen icons"></i></button>
                                <button title="Compare"><i class="icon-refresh"></i></button>
                            </div>
                        </div>
                        <div class="product-content-wrap-2 text-center">
                            <div class="product-rating-wrap">
                                <div class="product-rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                </div>
                                <span>(5)</span>
                            </div>
                            <h3><a href="product-details.html"><?php echo $product['name']; ?></a></h3>
                            <div class="product-price-2">
                                <?php if( $product['sale'] != 0  ): ?>
                                <span class="new-price"><?php echo $product['sale']; ?></span>
                                <span class="old-price"><?php echo $product['price']; ?></span>
                                <?php else: ?>
                                <span class="new-price"><?php echo $product['price']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="product-content-wrap-2 product-content-position text-center">
                            <div class="product-rating-wrap">
                                <div class="product-rating">
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                </div>
                                <span>(5)</span>
                            </div>
                            <h3><a href="product-details.html"><?php echo $product['name']; ?></a></h3>
                            <div class="product-price-2">
                                <?php if( $product['sale'] != 0  ): ?>
                                <span class="new-price"><?php echo $product['sale']; ?></span>
                                <span class="old-price"><?php echo $product['price']; ?></span>
                                <?php else: ?>
                                <span class="new-price"><?php echo $product['price']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="pro-add-to-cart">
                                <a href="<?php echo URL . 'front/shop/add_product?p_id='. $product['id']; ?>">Add To Cart</a>
                                <!-- <button title="Add to Cart">Add To Cart</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
