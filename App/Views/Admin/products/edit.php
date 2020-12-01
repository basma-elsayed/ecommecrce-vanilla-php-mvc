<?php
/**
 * Edit exist products
 */
get_admin_file("header");
?>
<div class="conatiner">

    <!-- Start from -->
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
        <div class="row">
            <!-- Page Header -->
            <div class="col-lg-12 mt-5">
                <div class="page-header no-gutters has-tab">
                    <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                    <div class="m-b-15 text-left">
                            <h4>Edit <strong><?php echo $data['product']['name']; ?></strong></h4>
                            <p>Created at <strong><?php echo $data['product']['date']; ?></strong></p>
                        </div>
                    
                        <div class="media align-items-center m-b-15">
                            <?php flash( 'products_actions' ); ?>
                        </div>

                        
                        <div class="m-b-15 float-right">
                            <button class="btn btn-primary">
                                <i class="anticon anticon-save"></i>
                                <span>Update</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->
            
            <!-- Start Product basic infos -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Name -->
                        <div class="form-group">
                            <label class="font-weight-semibold" for="productName">Product Name</label>
                            <input 
                                type="text" 
                                name="name"
                                value="<?php echo $data['product']['name']; ?>"
                                class="form-control <?php echo error_class( $data['post'] , 'name_err' ); ?>" 
                                id="productName" 
                                placeholder="Product Name" />
                                <div class="invalid-feedback"> <?php echo error_msg( $data['post'] , 'name_err' );?></div>
                                <div class="valid-feedback"> <?php echo success_msg( $data['post'] , 'name_success' );?> </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label class="font-weight-semibold" for="descriptionPrice">Description</label>
                            <textarea 
                                name="description"
                                class="form-control <?php echo error_class( $data['post'] , 'description_err' ); ?>" 
                                id="descriptionPrice" 
                                rows="8"
                                cols="10"><?php echo $data['product']['description']; ?></textarea>
                                <div class="invalid-feedback"><?php echo error_msg( $data['post'] , 'description_err' );?></div>
                                <div class="valid-feedback"><?php echo success_msg( $data['post'] , 'desc_success' );?></div>
                        </div>
                        
                        <!-- Price && Sale Price -->
                        <div class="form-row">
                            <div class="col">
                                <!-- Price -->
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="productPrice">Price</label>
                                    <input 
                                        type="number" 
                                        name="price"
                                        value="<?php echo $data['product']['price']; ?>"
                                        class="form-control <?php echo error_class( $data['post'] , 'price_err' ); ?>" 
                                        id="productPrice" 
                                        placeholder="Product Price" />
                                        <div class="invalid-feedback"><?php echo error_msg( $data['post'] , 'price_err' ); ?></div>
                                        <div class="valid-feedback"><?php echo success_msg( $data['post'] , 'price_success' );?></div>
                                </div>
                            </div>

                            <div class="col">
                                <!-- Sale Price -->
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="productSalePrice">Sale Price (optional)</label>
                                        <input 
                                            type="number" 
                                            name="sale"
                                            value="<?php echo $data['product']['sale']; ?>"
                                            class="form-control <?php echo error_class( $data['post'], 'sale_price_err' ); ?>" 
                                            id="productSalePrice" 
                                            placeholder="$33" />
                                            <div class="invalid-feedback"><?php echo error_msg( $data['post'], 'sale_price_err' ); ?></div>
                                            <div class="valid-feedback"><?php echo success_msg( $data['post'], 'sale_price_success', 'it is optional' );?></div>
                                    </div>
                            </div>
                        </div>

                        <!-- Category && Size -->
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="productCategory">Category</label>
                                    <div class="select-wrapper <?php echo error_class( $data['post'] , 'category_err' ); ?>">
                                        <select class="select2" name="category" id="productCategory">
                                            <?php foreach( $data['cats'] as $cat ): ?>
                                                <option value="<?php echo $cat['id']; ?>" <?php if( $cat['id'] === $data['product']['cat_id'] ) echo 'selected'; ?>><?php echo ucwords( $cat['name'] ); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?php echo error_msg( $data['post'] , 'category_err' ); ?></div>
                                        <div class="valid-feedback"><?php echo success_msg( $data['post'] , 'category_success' );?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">

                                <div class="form-group">
                                    <label class="font-weight-semibold" for="productSize">Size</label>
                                    <div class="select-wrapper <?php echo error_class( $data['post'], 'size_err' ); ?>">
                                        <select class="select2" name="size[]" multiple="multiple" id="productSize">
                                            <?php 
                                            $sizes = [ 'sm' => 'sm', 'md' => 'md', 'lg' => 'lg', 'xl' => 'xl', 'xxl' => 'xxl' ];
                                            foreach( $sizes as $key => $val ): ?>
                                                <option value="<?php echo $key; ?>" <?php if( in_array( $val, $data['product']['size'] ) ) echo 'selected'; ?>><?php echo $key; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?php echo error_msg( $data['post'], 'size_err' ); ?></div>
                                        <div class="valid-feedback"><?php echo success_msg( $data['post'], 'size_success' );?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Brand && Status -->
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="productBrand">Brand</label>
                                    <input
                                        type="text"
                                        name="brand"
                                        value="<?php echo $data['product']['brand']; ?>"
                                        class="form-control <?php echo error_class( $data['post'] , 'brand_err' ); ?>"
                                        id="productBrand"
                                        placeholder="Brand" />
                                        <div class="invalid-feedback"><?php echo error_msg( $data['post'] , 'brand_err' ); ?></div>
                                        <div class="valid-feedback"><?php echo success_msg( $data['post'] , 'brand_success' );?></div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="productStatus">Status</label>
                                    <div class="select-wrapper <?php echo error_class( $data['post'] , 'status_err' ); ?>">
                                        <select class="custom-select" name="status" id="productStatus">
                                            <option value="in_stock" <?php if( strval($data['product']['status']) === 'in_stock' ) echo 'selected'; ?>>In Stock</option>
                                            <option value="outof_stock" <?php if( strval($data['product']['status']) === 'outof_stock' ) echo 'selected'; ?>>Out of Stock</option>
                                            <option value="pending" <?php if( strval($data['product']['status']) === 'pending' ) echo 'selected'; ?>>Pending</option>
                                        </select>
                                        <div class="invalid-feedback"><?php echo error_msg( $data['post'] , 'status_err' ); ?></div>
                                        <div class="valid-feedback"><?php echo success_msg( $data['post'] , 'status_success' ); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Product basic infos -->

            <!-- Start Product Widget -->
            <div class="col-lg-3 mx-auto">

                <!-- Prodcut Image -->
                <div class="card card-body">
                    <h3 class="h3 mb-3">Product Image</h3>
                    <div class="product-img">
                        <img class="product__img" src="<?php echo get_img( 'products/' . $data['product']['image'] ); ?>" alt="" srcset="">
                        
                        <div class="mt-3">
                            <a href="#" class="btn btn-link btn-primary">Update image</a>
                        </div>

                        <input type="hidden" name="old_primg" value="<?php echo $data['product']['image']; ?>">
                    
                    </div>
                </div>
                <!-- Product Image -->

                <?php if( !is_null( $data['product']['gallery'] ) ): ?>
                <div class="card card-body">
                    <h3 class="h3 mb-3">Product Gallery</h3>
                    <div class="row">
                    <?php for( $i = 0; $i < count($data['product']['gallery']); $i++ ): ?>
                    <!-- Start Display product gallery  -->
                    <div class="product-img col-lg-3">
                        <img class="product__img img-thumbnail" src="<?php echo get_img( 'products/' . $data['product']['gallery'][$i] ); ?>" alt="" srcset="">
                        <input type="hidden" name="old_primg" value="<?php echo $data['product']['gallery'][$i]; ?>">
                    </div>
                    <!-- End Display product gallery  -->
                    <?php endfor; ?>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="btn btn-link btn-primary">Update Gallery</a>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Start Colors & Material -->
                <div class="card">
                    <div class="card-body">
                        <!-- Colors -->
                        <div class="form-group">
                            <label class="font-weight-semibold" for="productColors">Colors</label>
                            <select class="select2" id="productColors" multiple="multiple">
                                <option value="db" selected>Dark Blue</option>
                                <option value="g" selected>Gray</option>
                                <option value="gb" selected>Gray Blue</option>
                            </select>
                        </div>

                        <!-- Material -->
                        <div class="form-group">
                            <label class="font-weight-semibold" for="productMaterial">Material</label>
                            <select class="select2" id="productMaterial" multiple="multiple">
                                <option value="polyester" selected>Polyester</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- End Colors & Material -->

            </div>
            <!-- End Product Widget -->

        </div>
    </form>
    <!-- End form -->
</div>
<?php
get_admin_file("footer");