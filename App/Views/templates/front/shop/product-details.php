<?php ob_start(); ?>
<pre>
<?php
// print_r($data['product']);
?>
</pre>

<div class="product-details-area pt-120 pb-115">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-tab">
                    <div class="pro-dec-big-img-slider">
                        <div class="easyzoom-style">
                            <div class="easyzoom easyzoom--overlay">
                                <a href="<?php echo get_img( 'products/' . $data['product']['image'] ); ?>">
                                    <img src="<?php echo get_img( 'products/' . $data['product']['image'] ); ?>" alt="" />
                                </a>
                            </div>
                            <a class="easyzoom-pop-up img-popup" href="<?php echo get_img( 'products/' . $data['product']['image'] ); ?>"><i class="icon-size-fullscreen"></i></a>
                        </div>
                        <?php for ($i=0; $i < count($data['product']['gallery']) ; $i++): ?>
                            <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="<?php echo get_img( 'products/' . $data['product']['gallery'][$i] ); ?>">
                                        <img src="<?php echo get_img( 'products/' . $data['product']['gallery'][$i] ); ?>"/>
                                    </a>
                                </div>
                                <a class="easyzoom-pop-up img-popup" href="<?php echo get_img( 'products/' . $data['product']['gallery'][$i] ); ?>"><i class="icon-size-fullscreen"></i></a>
                            </div>
                        <?php endfor; ?>
                        
                    </div>
                    <div class="product-dec-slider-small product-dec-small-style1">
                        <div class="product-dec-small active">
                            <img src="<?php echo get_img( 'products/' . $data['product']['image'] ); ?>" alt="" />
                        </div>
                        <?php for ($i=0; $i < count($data['product']['gallery']) ; $i++):  ?>
                            <div class="product-dec-small active">
                                <img src="<?php echo get_img( 'products/' . $data['product']['gallery'][$i] ); ?>" alt="" />
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product-details-content pro-details-content-mrg">
                    <h2>Simple Black T-Shirt</h2>
                    <div class="product-ratting-review-wrap">
                        <div class="product-ratting-digit-wrap">
                            <div class="product-ratting">
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                                <i class="icon_star"></i>
                            </div>
                            <div class="product-digit">
                                <span>5.0</span>
                            </div>
                        </div>
                        <div class="product-review-order">
                            <span>62 Reviews</span>
                            <span>242 orders</span>
                        </div>
                    </div>
                    <p>Seamlessly predominate enterprise metrics without performance based process improvements.</p>
                    <div class="pro-details-price">
                        <?php if( $data['product']['sale'] != 0  ): ?>
                        <span class="new-price"><?php echo $data['product']['sale']; ?></span>
                        <span class="old-price"><?php echo $data['product']['price']; ?></span>
                            <?php else: ?>
                        <span class="new-price"><?php echo $data['product']['price']; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="pro-details-color-wrap">
                        <span>Color:</span>
                        <div class="pro-details-color-content">
                            <ul>
                                <li><a class="dolly" href="#">dolly</a></li>
                                <li><a class="white" href="#">white</a></li>
                                <li><a class="azalea" href="#">azalea</a></li>
                                <li><a class="peach-orange" href="#">Orange</a></li>
                                <li><a class="mona-lisa active" href="#">lisa</a></li>
                                <li><a class="cupid" href="#">cupid</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="pro-details-size">
                        <span>Size:</span>
                        <div class="pro-details-size-content">
                            <ul>
                                <?php for( $i = 0; $i < count($data['product']['size']); $i++ ): ?>
                                    <li><a href="#"><?php echo strtolower($data['product']['size'][$i]); ?></a></li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="pro-details-quality">
                        <span>Quantity:</span>
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                        </div>
                    </div>
                    <div class="product-details-meta">
                        <ul>
                            <li><span>Categories:</span> 
                                <a href="<?php echo URL . 'front/categories?cat_id=' . $data['product']['id']; ?>"><?php echo GetCatName( intval($data['product']['cat_id']) ); ?></a>
                            </li>
                            <li><span>Tag: </span> 
                                <a href="#">Fashion,</a>
                                <a href="#">Mentone</a> , 
                                <a href="#">Texas</a>
                            </li>
                        </ul>
                    </div>
                    <div class="pro-details-action-wrap">
                        <div class="pro-details-add-to-cart">
                            <a title="Add to Cart" href="#">Add To Cart </a>
                        </div>
                        <div class="pro-details-action">
                            <a title="Add to Wishlist" href="#"><i class="icon-heart"></i></a>
                            <a title="Add to Compare" href="#"><i class="icon-refresh"></i></a>
                            <a class="social" title="Social" href="#"><i class="icon-share"></i></a>
                            <div class="product-dec-social">
                                <a class="facebook" title="Facebook" href="#"><i class="icon-social-facebook"></i></a>
                                <a class="twitter" title="Twitter" href="#"><i class="icon-social-twitter"></i></a>
                                <a class="instagram" title="Instagram" href="#"><i class="icon-social-instagram"></i></a>
                                <a class="pinterest" title="Pinterest" href="#"><i class="icon-social-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
