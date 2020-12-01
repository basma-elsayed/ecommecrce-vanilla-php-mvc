<?php
/**
 * 
 * Create new Category
 */
get_admin_file( "header" );
?>

<div class="container">

    <div class="row">
        <div class="col-lg-8">
            <h4 class="h4 font-weight-bold mb-3">Create new category</h4>
        </div>

        <div class="col-lg-8">
            <?php flash('category_action'); ?>
            
        </div>
        <div class="col-lg-8">
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                
                <div class="card">
                    <div class="card-body">

                        <!-- Category name -->
                        <div class="form-group">
                            <label class="font-weight-semibold" for="categoryname">Category Name</label>
                            <input 
                                type="text"
                                class="form-control <?php echo error_class( $data, 'name_err' ) ;?>"
                                name="name"
                                id="categoryname"
                                placeholder="Category Name"
                                value="<?php echo GetInputValue( $data, 'name' ) ;?>" />
                                <div class="invalid-feedback"> <?php echo error_msg( $data, 'name_err' ) ;?></div>
                                <div class="valid-feedback"><?php echo success_msg($data, 'name_success' ); ?></div>
                        </div>
                        <!-- end Category name -->

                        <!-- Category decription -->
                        <div class="form-group">
                            <textarea 
                                class="form-control <?php echo error_class( $data, 'description_err' ) ;?>" 
                                name="description" 
                                id="" 
                                cols="10" 
                                rows="10"
                                placeholder="Category Decription"><?php echo GetInputValue( $data, 'description' ) ;?></textarea>
                            <div class="invalid-feedback"><?php echo error_msg($data, 'description_err' ); ?></div>
                            <div class="valid-feedback"><?php echo success_msg($data, 'description_success' ); ?></div>
                        </div>
                        <!-- end Category decription -->

                        <!-- Category Visiblity -->
                        <div class="form-group border p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="m-l-15">
                                        <h5 class="font-weight-semibold m-b-0">Make products related to this category visible</h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input 
                                            name="visbility" 
                                            value="1" 
                                            type="checkbox" 
                                            id="visbility" 
                                            checked />
                                        <label for="visbility"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Category Visiblity -->

                        <!-- Category Allow comments -->
                        <div class="form-group border p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="m-l-15">
                                        <h5 class="font-weight-semibold m-b-0">Allow Comments to this category</h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input 
                                            name="allow_comments" 
                                            value="1" 
                                            type="checkbox" 
                                            id="allow_comments" 
                                            checked />
                                        <label for="allow_comments"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Category Allow comment -->

                        <!-- Category Allow Ads -->
                        <div class="form-group border p-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="m-l-15">
                                        <h5 class="font-weight-semibold m-b-0">Allow Ads to this category</h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="switch m-t-5 m-l-10">
                                        <input
                                            name="allow_ads"
                                            value="1" 
                                            type="checkbox" 
                                            id="allow_ads" 
                                            checked />
                                        <label for="allow_ads"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Category Allow Ads -->

                        <!-- Submit -->
                        <div class="no-gutters has-tab">
                            <div class="d-md-flex m-b-15 align-items-center justify-content-end">
                                <div class="m-b-15">
                                    <button class="btn btn-primary">
                                        <i class="anticon anticon-save"></i>
                                        <span>Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Submit -->
                            
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

<?php
get_admin_file( "footer" );