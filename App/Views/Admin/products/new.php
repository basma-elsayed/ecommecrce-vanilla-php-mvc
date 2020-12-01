<?php
/**
 * Add new Products
 */
get_admin_file( "header" );
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-6 mx-auto">
            <?php echo flash( 'products_actions' ); ?>
        </div>
        <!-- Page Header -->
        <div class="col-12 mt-5">
            <div class="page-header no-gutters has-tab">
                <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                    <div>
                        <h3>Add new product</h3>
                    </div>
                    
                    <div class="m-b-15 float-right">
                        <button class="btn btn-primary">
                            <i class="anticon anticon-save"></i>
                            <span>Save</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Page Header -->

        <!-- Product basic infos -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <!-- Name -->
                    <div class="form-group">
                        <label class="font-weight-semibold" for="productName">Product Name</label>
                        <input 
                            type="text" 
                            name="name"
                            value="<?php echo GetInputValue( $data['post'] , 'name' ); ?>"
                            class="form-control <?php echo error_class( $data['post'], 'name_err' ); ?>" 
                            id="productName" 
                            placeholder="e.g. Slim Pants" />
                            <div class="invalid-feedback"> <?php echo error_msg( $data['post'], 'name_err' );?></div>
                            <div class="valid-feedback"> <?php echo success_msg( $data['post'], 'name_success' );?> </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label class="font-weight-semibold" for="descriptionPrice">Description</label>
                        <textarea 
                            name="description"
                            class="form-control <?php echo error_class( $data['post'], 'description_err' ); ?>" 
                            id="descriptionPrice" 
                            placeholder="e.g vairty of colors..."
                            rows="8"
                            cols="10"><?php echo GetInputValue( $data['post'] , 'description' ); ?></textarea>
                            <div class="invalid-feedback"><?php echo error_msg( $data['post'], 'description_err' );?></div>
                            <div class="valid-feedback"><?php echo success_msg( $data['post'], 'description_success' );?></div>
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
                                    value="<?php echo GetInputValue( $data['post'] , 'price' ); ?>"
                                    class="form-control <?php echo error_class( $data['post'], 'price_err' ); ?>" 
                                    id="productPrice" 
                                    placeholder="$199" />
                                    <div class="invalid-feedback"><?php echo error_msg( $data['post'], 'price_err' ); ?></div>
                                    <div class="valid-feedback"><?php echo success_msg( $data['post'], 'price_success' );?></div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- Sale Price -->
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productSalePrice">Sale Price (optional)</label>
                                <input 
                                    type="number" 
                                    name="sale_price"
                                    value="<?php echo GetInputValue( $data['post'] , 'sale_price' ); ?>"
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
                        <!-- Category -->
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productCategory">Category</label>
                                <div class="select-wrapper <?php echo error_class( $data['post'], 'category_err' ); ?>">
                                    <select class="select2" name="category" id="productCategory">
                                        <?php foreach( $data['cats'] as $cat ): ?>
                                            <option value="<?php echo $cat->id; ?>"><?php echo ucwords( $cat->name ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"><?php echo error_msg( $data['post'], 'category_err' ); ?></div>
                                    <div class="valid-feedback"><?php echo success_msg( $data['post'], 'category_success' );?></div>
                                </div>
                            </div>
                        </div>
                        <!-- Size -->
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productSize">Size</label>
                                <div class="select-wrapper <?php echo error_class( $data['post'], 'size_err' ); ?>">
                                    <select class="select2" name="size[]" multiple="multiple" id="productSize">
                                        <option value="sm">sm</option>
                                        <option value="md">md</option>
                                        <option value="lg">lg</option>
                                        <option value="xl">xl</option>
                                        <option value="xxl">xxl</option>
                                    </select>
                                    <div class="invalid-feedback"><?php echo error_msg( $data['post'], 'size_err' ); ?></div>
                                    <div class="valid-feedback"><?php echo success_msg( $data['post'], 'size_success' );?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Brand && Status -->
                    <div class="form-row">
                        <!-- Brand -->
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productBrand">Brand</label>
                                <input
                                    type="text"
                                    name="brand"
                                    value="<?php echo GetInputValue( $data['post'] , 'brand' ); ?>"
                                    class="form-control <?php echo error_class( $data['post'], 'brand_err' ); ?>"
                                    id="productBrand"
                                    placeholder="Brand" />
                                    <div class="invalid-feedback"><?php echo error_msg( $data['post'], 'brand_err' ); ?></div>
                                    <div class="valid-feedback"><?php echo success_msg( $data['post'], 'brand_success' );?></div>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productStatus">Status</label>
                                <div class="select-wrapper <?php echo error_class( $data['post'], 'status_err' ); ?>">
                                    <select class="custom-select" name="status" id="productStatus">
                                        <option value="in_stock" selected>In Stock</option>
                                        <option value="outof_stock">Out of Stock</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                    <div class="invalid-feedback"><?php echo error_msg( $data['post'], 'status_err' ); ?></div>
                                    <div class="valid-feedback"><?php echo success_msg( $data['post'], 'status_success' ); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Product basic infos -->
        
        <!-- Start Product Widget -->
        <div class="col-lg-4">

            <!-- Prodcut Image -->
            <div class="card card-body">
                <h3 class="h3">Add Product Image</h3>
                <div class="form-group">
                    <input
                        class="form-control <?php echo error_class( $data['post'], 'img_err' ); ?>"
                        type="file"
                        name="product_single_image"
                        id="product_single_image" />
                    <div class="invalid-feedback"> <?php echo error_msg( $data['post'], 'img_err' );?></div>
                    <div class="valid-feedback"> <?php echo success_msg( $data['post'], 'img_success' );?> </div>
                </div>
            </div>
            <!-- Product Image -->

            <!-- Prodcut Image -->
            <div class="card card-body">
                <h3 class="h3">Product Images Gallery</h3>
                <div class="form-group">
                    <input
                        class="form-control <?php echo error_class( $data['post'], 'gallery_err' ); ?>"
                        type="file"
                        name="product_gallery[]"
                        id="product_gallery" 
                        multiple/>
                    <div class="invalid-feedback"> <?php echo error_msg( $data['post'], 'gallery_err' );?></div>
                    <div class="valid-feedback"> <?php echo success_msg( $data['post'], 'gallery_success', 'it is optional' );?> </div>
                </div>
            </div>
            <!-- Product Image -->

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
<?php
get_admin_file( "footer" );